<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembeli SBM</title>
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
        .register-card {
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
        .register-panel {
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 24px 64px rgba(24,58,30,0.15);
        }
        .register-panel .card-body {
            padding: 40px 34px;
        }
        .register-panel h3 {
            margin-bottom: 18px;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
        }
        .register-panel p { color: #6a766c; margin-bottom: 22px; }
        .form-label { font-weight: 600; color: #374136; }
        .form-control {
            border-radius: 16px;
            border: 1px solid #dee6db;
            background: #f7faf5;
            padding: 14px 16px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-control:focus {
            border-color: rgba(46,125,50,0.45);
            box-shadow: 0 0 0 0.15rem rgba(46,125,50,0.14);
        }
        .btn-sbm {
            width: 100%;
            background: linear-gradient(135deg, var(--sbm-hijau), #4f9752);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 14px 16px;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: 0 16px 26px rgba(46,125,50,0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-sbm:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 30px rgba(46,125,50,0.24);
        }
        .login-link {
            color: var(--sbm-hijau);
            text-decoration: none;
            font-weight: 600;
        }
        .login-link:hover { text-decoration: underline; }
        .alert-danger {
            border-radius: 16px;
            background: #fdecea;
            border: 1px solid #f5c2c7;
            color: #842029;
        }
        @media (max-width: 576px) {
            .register-card { width: 100%; }
            .brand-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .brand-copy h1 { font-size: 1.6rem; }
            .register-panel .card-body { padding: 28px 20px; }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="brand-header">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 12 12 3 21 12"></polyline>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"></path>
                </svg>
            </div>
            <div class="brand-copy">
                <h1>Daftar Pembeli SBM</h1>
                <p>Untuk menyelesaikan pengajuan survei, buat akun pembeli terlebih dahulu.</p>
            </div>
        </div>
        <div class="register-panel">
            <div class="card-body">
                <h3>Buat Akun Pembeli</h3>

                @if($errors->any())
                    <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token ?? '' }}">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" autocomplete="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                    </div>
                    <button type="submit" class="btn-sbm">Daftar dan Selesaikan Pengajuan</button>
                </form>

                <p class="mt-3">Sudah punya akun? <a class="login-link" href="/login?token={{ $token ?? '' }}">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
