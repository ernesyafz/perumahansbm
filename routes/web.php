<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Agent;
use App\Models\Cluster;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
    try {
        // Kata kunci pencarian dari ?search=... di URL
        $search = $request->query('search');

        // $clusters = SEMUA unit, TIDAK difilter.
        // Tetap dipakai apa adanya untuk: statistik hero (Total Unit / Unit Tersedia / Tipe Rumah),
        // section Ketersediaan, semua modal detail, dan data chatbot JS.
        $clusters = Cluster::with('status')->get();

        // $filteredClusters = HANYA untuk grid "Pilihan Hunian" yang bisa di-search.
        $filteredClusters = Cluster::with('status')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $agent = Agent::first();
    } catch (\Throwable $e) {
        $clusters = collect();
        $filteredClusters = collect();
        $agent = null;
        $search = null;
        report($e);
    }

    return view('welcome', compact('clusters', 'filteredClusters', 'agent', 'search'));
});

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.attempt');
// Public (buyer) auth routes used for completing pending survey submissions
Route::get('/login', [AuthController::class, 'showPublicLogin'])->name('login');
Route::post('/login', [AuthController::class, 'publicLogin'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/survey-submissions', [AdminController::class, 'storeSurveySubmission'])
    ->middleware('throttle:5,1')
    ->name('survey-submissions.store');

// Prompt page to ask users to login/register to complete a pending survey submission
Route::get('/auth/verify', function (\Illuminate\Http\Request $request) {
    $token = $request->query('token');
    return view('auth.verify-prompt', compact('token'));
})->name('auth.verify.prompt');

// Complete the pending submission after successful auth
Route::get('/auth/verify/complete', [\App\Http\Controllers\AuthController::class, 'completePendingSubmission'])->name('auth.verify.complete');

// Confirmation page for saved survey submissions (owner only)
Route::get('/survey/confirmation/{submission}', [\App\Http\Controllers\AdminController::class, 'showConfirmation'])
    ->name('survey.confirmation')
    ->middleware('auth');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/survey-submissions/{submission}', [AdminController::class, 'showSurveySubmission'])->name('admin.survey-submissions.show');
    Route::delete('/admin/survey-submissions/{submission}', [AdminController::class, 'destroySurveySubmission'])->name('admin.survey-submissions.destroy');
    Route::post('/admin/survey-submissions/{submission}/process', [AdminController::class, 'processSurveySubmission'])->name('admin.survey-submissions.process');
    Route::post('/admin/clusters', [AdminController::class, 'storeCluster'])->name('admin.clusters.store');
    Route::get('/admin/clusters/{cluster}/edit', [AdminController::class, 'editCluster'])->name('admin.clusters.edit');
    Route::put('/admin/clusters/{cluster}', [AdminController::class, 'updateCluster'])->name('admin.clusters.update');
    Route::delete('/admin/clusters/{cluster}', [AdminController::class, 'destroyCluster'])->name('admin.clusters.destroy');
    Route::post('/admin/agent', [AdminController::class, 'updateAgent'])->name('admin.agent.update');
});