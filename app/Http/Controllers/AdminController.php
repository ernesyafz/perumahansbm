<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Cluster;
use App\Models\Status;
use App\Models\SurveySubmission;
use App\Models\User;
use App\Models\PendingSurveySubmission;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Status::count() == 0) {
            Status::insert([
                ['name' => 'Tersedia', 'badge_class' => 'bg-success text-white', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Terbatas', 'badge_class' => 'bg-warning text-dark', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Habis', 'badge_class' => 'bg-danger text-white', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        $clusters = Cluster::with('status')->get();
        $statuses = Status::all();
        $agent = Agent::first();
        $surveySubmissions = SurveySubmission::latest()->get();
        $pendingSurveyCount = SurveySubmission::where('status', 'pending')->count();

        return view('admin.dashboard', compact('clusters', 'statuses', 'agent', 'surveySubmissions', 'pendingSurveyCount'));
    }

    public function storeCluster(Request $request)
    {
        $data = $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'land_area' => 'required|integer|min:0',
            'building_area' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0|max:20',
            'bathrooms' => 'required|integer|min:0|max:20',
            'carport' => 'required|integer|min:0|max:10',
            'description' => 'required|string',
            'feature_summary' => 'nullable|string',
            'image' => 'required|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('clusters', 'public');
        }

        Cluster::create($data);

        return back()->with('success', 'Cluster berhasil ditambahkan.');
    }

    public function editCluster(Cluster $cluster)
    {
        $statuses = Status::all();
        $agent = Agent::first();

        return view('admin.cluster-edit', compact('cluster', 'statuses', 'agent'));
    }

    public function updateCluster(Request $request, Cluster $cluster)
    {
        $data = $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'land_area' => 'required|integer|min:0',
            'building_area' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0|max:20',
            'bathrooms' => 'required|integer|min:0|max:20',
            'carport' => 'required|integer|min:0|max:10',
            'description' => 'required|string',
            'feature_summary' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('clusters', 'public');
        }

        $cluster->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Cluster berhasil diperbarui.');
    }

    public function destroyCluster(Cluster $cluster)
    {
        if ($cluster->image_url && Storage::disk('public')->exists($cluster->image_url)) {
            Storage::disk('public')->delete($cluster->image_url);
        }

        $cluster->delete();

        return back()->with('success', 'Cluster berhasil dihapus.');
    }

    public function showSurveySubmission(SurveySubmission $submission)
    {
        $submission->load('processor');

        return view('admin.survey-submission-show', compact('submission'));
    }

    public function storeSurveySubmission(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string',
            'preferred_schedule' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Simple honeypot anti-spam: if honeypot field is filled, treat as bot
        if ($request->filled('hp_name')) {
            return back()->withErrors(['hp' => 'Deteksi spam: formulir tidak dikirim.'])->withInput();
        }

        // Timestamp check: ensure form wasn't submitted too quickly (>= 3 seconds)
        // This is only enforced for the pending verification flow that includes a timestamp.
        $ts = intval($request->input('ts', 0));
        if ($ts > 0) {
            $age = now()->timestamp - $ts;
            if ($age < 3) {
                return back()->withErrors(['ts' => 'Formulir dikirim terlalu cepat.']);
            }
        }

        $data['status'] = 'pending';

        // Jika request berasal dari submit publik langsung, simpan segera ke tabel utama.
        // Jika request berasal dari alur pending setelah pengunjung mengisi form anonim,
        // simpan hanya record pending lalu lanjut ke proses login/register.
        $isPendingFlow = $request->has('ts') || $request->has('hp_name');

        if (!$isPendingFlow) {
            $data['submitted_at'] = now();
            $data['verified_at'] = now();

            if (auth()->check() && auth()->user()->role !== 'admin') {
                $data['user_id'] = auth()->id();
                $submission = SurveySubmission::create($data);

                Log::info('Created survey submission', [
                    'email' => $data['email'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'submission_id' => $submission->id,
                    'ip' => request()->ip(),
                ]);

                return back()->with('success', 'Pengajuan survei berhasil dikirim. Tim kami akan menghubungi Anda segera.');
            }

            $submission = SurveySubmission::create($data);

            Log::info('Created direct survey submission', [
                'submission_id' => $submission->id,
                'email' => $data['email'] ?? null,
                'ip' => $request->ip(),
            ]);

            return back()->with('success', 'Pengajuan survei berhasil dikirim. Tim kami akan menghubungi Anda segera.');
        }

        $token = \Illuminate\Support\Str::random(40);
        $pending = PendingSurveySubmission::create([
            'token' => $token,
            'payload' => $data,
            'created_at' => now(),
        ]);

        Log::info('Created pending survey submission', [
            'pending_id' => $pending?->id,
            'token' => $token,
            'email' => $data['email'] ?? null,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('auth.verify.prompt', ['token' => $token])
            ->with('info', 'Terima kasih, langkah selanjutnya: silakan login atau buat akun untuk menyelesaikan pengajuan.');
    }

    public function processSurveySubmission(Request $request, SurveySubmission $submission)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected,rescheduled',
            'admin_note' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
        ]);

        if (!empty($data['scheduled_at'])) {
            $scheduledAt = Carbon::parse($data['scheduled_at'])->format('Y-m-d H:i:s');
            $data['scheduled_at'] = $scheduledAt;

            $conflict = SurveySubmission::whereNotIn('id', [$submission->id])
                ->whereNotNull('scheduled_at')
                ->where('scheduled_at', $scheduledAt)
                ->exists();

            if ($conflict) {
                return back()->withErrors([
                    'scheduled_at' => 'Jadwal survei ini sudah digunakan oleh pengajuan lain.',
                ]);
            }
        }

        $data['processed_by'] = auth()->id();
        $data['processed_at'] = now();

        $submission->update($data);

        return redirect()->route('admin.survey-submissions.show', $submission)
            ->with('success', 'Pengajuan survei berhasil diproses.');
    }

    public function destroySurveySubmission(SurveySubmission $submission)
    {
        $submissionId = $submission->id;
        $submission->delete();

        Log::info('Deleted survey submission', [
            'submission_id' => $submissionId,
            'deleted_by' => auth()->id(),
            'email' => $submission->email ?? null,
            'ip' => request()->ip(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Pengajuan survei berhasil dihapus.');
    }

    /**
     * Show confirmation for a saved survey submission to its owner.
     */
    public function showConfirmation(SurveySubmission $submission)
    {
        if (!auth()->check() || auth()->id() !== $submission->user_id) {
            abort(403);
        }

        return view('survey.confirmation', compact('submission'));
    }

    public function updateAgent(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'schedule' => 'nullable|string|max:255',
            'promo' => 'nullable|string|max:255',
            'map_link' => 'nullable|url',
        ]);

        Agent::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Data agen berhasil diperbarui.');
    }
}