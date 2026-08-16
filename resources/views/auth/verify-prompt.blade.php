<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan Survei</title>
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
        .verify-card {
            width: min(520px, 100%);
            padding: 0 8px;
        }
        .brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }
        .brand-mark {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--sbm-hijau), #4da35b);
            display: grid;
            place-items: center;
            box-shadow: 0 18px 30px rgba(46,125,50,0.2);
        }
        .brand-mark svg { width: 28px; height: 28px; color: #fff; }
        .brand-copy h1 {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            line-height: 1.05;
        }
        .brand-copy p {
            margin: 4px 0 0;
            color: #5d675f;
            font-size: 0.96rem;
        }
        .verify-panel {
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 24px 64px rgba(24,58,30,0.15);
        }
        .verify-panel .card-body {
            padding: 40px 34px;
        }
        .verify-panel h3 {
            margin-bottom: 18px;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
        }
        .verify-panel p { color: #6a766c; margin-bottom: 22px; }
        .btn-sbm {
            background: linear-gradient(135deg, var(--sbm-hijau), #4f9752);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: 0 16px 26px rgba(46,125,50,0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-sbm:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 30px rgba(46,125,50,0.24);
        }
        .btn-outline-sbm {
            border-radius: 999px;
            border: 1px solid var(--sbm-hijau);
            color: var(--sbm-hijau);
            background: transparent;
            padding: 12px 20px;
            text-decoration: none;
        }
        .btn-outline-sbm:hover {
            background: rgba(46,125,50,0.08);
            text-decoration: none;
        }
        .verify-footer {
            margin-top: 18px;
            color: #7d887f;
            font-size: 0.95rem;
        }
        .alert-info {
            border-radius: 16px;
            border: 1px solid #bee3f8;
            background: #e0f2fe;
            color: #0c5460;
        }
        @media (max-width: 576px) {
            .verify-card { width: 100%; }
            .brand-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .brand-copy h1 { font-size: 1.6rem; }
            .verify-panel .card-body { padding: 28px 20px; }
        }
    </style>
</head>
<body>
    <div class="verify-card">
        <div class="brand-header">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 12 12 3 21 12"></polyline>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"></path>
                </svg>
            </div>
            <div class="brand-copy">
                <h1>Verifikasi Pengajuan</h1>
                <p>Lengkapi proses dengan memilih login atau daftar terlebih dahulu.</p>
            </div>
        </div>
        <div class="verify-panel">
            <div class="card-body">
                <h3>Verifikasi Pengajuan Survei</h3>
                <p>Terima kasih telah mengisi formulir pengajuan survei. Untuk menyelesaikan pengajuan, silakan login atau buat akun baru.</p>

                @if(session('info'))
                    <div class="alert alert-info mb-4">{{ session('info') }}</div>
                @endif

                <p><strong>Token pengajuan:</strong> {{ $token ?? '-' }}</p>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-3">
                    <a href="/login?token={{ $token }}" class="btn-sbm">Login</a>
                    <a href="/register?token={{ $token }}" class="btn-outline-sbm">Daftar</a>
                    <a href="/" class="btn btn-link">Kembali ke Beranda</a>
                </div>

                <p class="verify-footer">Jika Anda mengalami masalah, hubungi tim kami.</p>
            </div>
        </div>
    </div>
</body>
</html>
