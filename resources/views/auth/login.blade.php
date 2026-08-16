<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login SBM</title>
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
            padding: 24px;
            background: radial-gradient(circle at top right, rgba(248,255,246,0.95), transparent 24%), linear-gradient(135deg, #f6f8f3 0%, #dee6d9 100%);
            font-family: 'Inter', sans-serif;
            color: #2f3c34;
        }
        .login-card {
            width: min(480px, 100%);
            padding: 0 8px;
        }
        .brand-header {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
            margin-bottom: 24px;
        }
        .brand-mark {
            width: 62px;
            height: 62px;
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
            font-size: 2.1rem;
            letter-spacing: .05em;
            line-height: 1.05;
        }
        .brand-copy p {
            margin: 4px 0 0;
            color: #5d675f;
            font-size: 0.96rem;
        }
        .login-panel {
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 24px 64px rgba(24,58,30,0.15);
            margin-top: 18px;
        }
        .login-panel .card-body {
            padding: 42px 32px;
        }
        .login-panel h3 {
            margin-bottom: 18px;
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
        }
        .login-panel p { color: #6a766c; margin-bottom: 24px; }
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
        .form-check-input:checked {
            background-color: var(--sbm-hijau);
            border-color: var(--sbm-hijau);
        }
        .btn-sbm {
            width: 100%;
            background: linear-gradient(135deg, var(--sbm-hijau), #4f9752);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 14px 16px;
            font-weight: 700;
            letter-spacing: 0.03em;
            box-shadow: 0 16px 26px rgba(46,125,50,0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-sbm:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 30px rgba(46,125,50,0.24);
        }
        .login-footer {
            margin-top: 18px;
            text-align: center;
            color: #7d887f;
            font-size: 0.92rem;
        }
        @media (max-width: 600px) {
            .brand-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .brand-copy h1 { font-size: 1.6rem; }
            .login-panel .card-body { padding: 28px 20px; }
            .login-footer { font-size: 0.88rem; }
        }
        .alert-danger {
            border-radius: 16px;
            background: #fdecea;
            border: 1px solid #f5c2c7;
            color: #842029;
        }
        .alert-info {
            border-radius: 16px;
            border: 1px solid #bee3f8;
            background: #e0f2fe;
            color: #0c5460;
        }
        @media (max-width: 576px) {
            body { padding: 16px; }
            .login-card { width: 100%; }
            .brand-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .brand-copy h1 { font-size: 1.8rem; }
            .login-panel .card-body { padding: 28px 22px; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand-header">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 12 12 3 21 12"></polyline>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"></path>
                </svg>
            </div>
                <div class="brand-copy">
                    <h1>{{ ($adminLogin ?? false) ? 'Login Admin SBM' : 'Login Pembeli SBM' }}</h1>
                    <p>{{ ($adminLogin ?? false) ? 'Masuk dengan akun admin untuk mengelola dashboard SBM.' : 'Masuk dengan akun pembeli untuk menyelesaikan pengajuan survei.' }}</p>
        </div>
        </div>

        <div class="login-panel">
            <div class="card-body">
                <h3>{{ ($adminLogin ?? false) ? 'Login Admin SBM' : 'Login Pembeli' }}</h3>

                @if(session('info'))
                    <div class="alert alert-info mb-4">{{ session('info') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ ($adminLogin ?? false) ? route('admin.login.attempt') : route('login.attempt') }}" autocomplete="off">
                    @csrf
                    @if(!($adminLogin ?? false))
                        <input type="hidden" name="token" value="{{ $token ?? '' }}">
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="current-password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-sbm">Masuk Sekarang</button>
                </form>

            </div>
        </div>

        <p class="login-footer">Gunakan akun admin untuk mengakses area admin SBM.</p>
    </div>
</body>
</html>
