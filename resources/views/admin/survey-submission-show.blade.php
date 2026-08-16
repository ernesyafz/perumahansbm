<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan Survei - SBM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h1 class="h3 mb-1">Detail Pengajuan Survei</h1>
                <p class="text-muted mb-0">Lihat informasi lengkap dan proses pengajuan survei.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                <form method="POST" action="{{ route('admin.survey-submissions.destroy', $submission) }}" onsubmit="return confirm('Hapus pengajuan survei ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Pengajuan</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Informasi Calon Pembeli</h5>
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Nama</dt>
                            <dd class="col-sm-8">{{ $submission->name }}</dd>
                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8">{{ $submission->email }}</dd>
                            <dt class="col-sm-4">Telepon</dt>
                            <dd class="col-sm-8">{{ $submission->phone }}</dd>
                            <dt class="col-sm-4">Alamat</dt>
                            <dd class="col-sm-8">{{ $submission->address ?? '-' }}</dd>
                            <dt class="col-sm-4">Jadwal Pilihan</dt>
                            <dd class="col-sm-8">{{ $submission->preferred_schedule ?? '-' }}</dd>
                            <dt class="col-sm-4">Catatan Pengaju</dt>
                            <dd class="col-sm-8">{{ $submission->notes ?? '-' }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Proses Pengajuan</h5>
                        <form method="POST" action="{{ route('admin.survey-submissions.process', $submission) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $submission->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $submission->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $submission->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="rescheduled" {{ $submission->status === 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan Admin</label>
                                <textarea name="admin_note" class="form-control" rows="4">{{ old('admin_note', $submission->admin_note) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jadwal Survei</label>
                                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at', optional($submission->scheduled_at)->format('Y-m-d\TH:i')) }}">
                            </div>
                            <button type="submit" class="btn btn-sbm w-100" style="background-color: #C85A17; color: white;">Simpan Proses</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Riwayat Pemrosesan</h5>
                <ul class="mb-0">
                    <li>Status saat ini: <strong>{{ ucfirst($submission->status) }}</strong></li>
                    @if($submission->processed_by)
                        <li>Diproses oleh: <strong>{{ $submission->processor?->name ?? 'Admin' }}</strong></li>
                    @endif
                    @if($submission->processed_at)
                        <li>Waktu pemrosesan: <strong>{{ $submission->processed_at->format('d M Y H:i') }}</strong></li>
                    @endif
                    @if($submission->scheduled_at)
                        <li>Jadwal survei: <strong>{{ $submission->scheduled_at->format('d M Y H:i') }}</strong></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
