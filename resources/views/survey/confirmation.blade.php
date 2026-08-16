<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pengajuan Survei</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --sbm-hijau: #2E7D32; --sbm-oren: #C85A17; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, rgba(248,255,246,0.95), transparent 24%), linear-gradient(135deg, #f6f8f3 0%, #dee6d9 100%);
            font-family: 'Inter', sans-serif;
            color: #2f3c34;
            padding: 20px;
        }
        .confirmation-card {
            width: min(780px, 100%);
            padding: 0 8px;
        }
        .confirmation-panel {
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 24px 64px rgba(24,58,30,0.15);
        }
        .confirmation-panel .card-body {
            padding: 40px 36px;
        }
        .confirmation-panel h3 {
            margin-bottom: 14px;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
        }
        .confirmation-panel p {
            color: #6a766c;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .details-list dt {
            font-weight: 700;
            color: #374136;
        }
        .details-list dd {
            margin-bottom: 0.85rem;
            color: #53655c;
        }
        .badge-reference {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(46,125,50,0.1);
            color: var(--sbm-hijau);
            font-weight: 700;
        }
        .btn-sbm {
            background: linear-gradient(135deg, var(--sbm-hijau), #4f9752);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: 0 16px 26px rgba(46,125,50,0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-sbm:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 30px rgba(46,125,50,0.24);
        }
        .btn-outline-secondary {
            border-radius: 999px;
            padding: 12px 22px;
        }
        .confirmation-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }
        @media (max-width: 576px) {
            .confirmation-panel .card-body { padding: 28px 20px; }
            .confirmation-panel h3 { font-size: 1.7rem; }
            .confirmation-actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="confirmation-card">
        <div class="confirmation-panel">
            <div class="card-body">
                <h3>Konfirmasi Pengajuan Survei</h3>
                <p>Terima kasih, pengajuan survei Anda telah berhasil disimpan. Tim kami akan memprosesnya segera.</p>

                <div class="badge-reference mb-4">SBM-SURV-{{ str_pad($submission->id, 6, '0', STR_PAD_LEFT) }}</div>

                <dl class="row details-list">
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8">{{ $submission->name }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $submission->email }}</dd>

                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8">{{ $submission->phone }}</dd>

                    <dt class="col-sm-4">Jadwal Pilihan</dt>
                    <dd class="col-sm-8">{{ $submission->preferred_schedule ?? '-' }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst($submission->status) }}</dd>

                    <dt class="col-sm-4">Waktu Pengajuan</dt>
                    <dd class="col-sm-8">{{ $submission->submitted_at ?? $submission->created_at }}</dd>
                </dl>

                <div class="confirmation-actions">
                    <a href="/" class="btn-sbm">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>