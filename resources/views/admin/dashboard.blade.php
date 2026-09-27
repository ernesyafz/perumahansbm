<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SBM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sbm-hijau: #2E7D32;
            --sbm-hijau-dark: #21592a;
            --sbm-oren: #C85A17;
            --sbm-peach: #F4A261;
            --sbm-bg: #F8FAF8;
            --sbm-surface: #F4F7F5;
            --sbm-line: #E7ECE8;
            --sbm-alert: #C0392B;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--sbm-surface);
            font-family: 'Inter', sans-serif;
            color: #24322a;
        }

        h1, h2, h3, h4, h5, .font-display {
            font-family: 'Playfair Display', serif;
        }

        .text-hijau { color: var(--sbm-hijau) !important; }
        .text-oren { color: var(--sbm-oren) !important; }
        .bg-hijau { background-color: var(--sbm-hijau) !important; }
        .bg-oren { background-color: var(--sbm-oren) !important; }

        .eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.4px;
            color: var(--sbm-oren);
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .eyebrow::before {
            content: '';
            width: 22px;
            height: 2px;
            background: var(--sbm-oren);
            display: inline-block;
        }

        /* ============ Sidebar ============ */
        .admin-sidebar {
            background: #ffffff;
            border-right: 1px solid var(--sbm-line);
            min-height: 100vh;
            padding: 28px 22px;
        }
        .sidebar-brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            margin-bottom: 6px;
            text-decoration: none;
        }
        .sidebar-brand .sbm-roof {
            margin-bottom: 2px;
        }
        .sidebar-brand .sbm-text {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 1.7rem;
            letter-spacing: 2px;
            line-height: 1;
            color: #1f2a22;
        }
        .sidebar-brand .sbm-desc {
            font-size: 0.58rem;
            letter-spacing: 1.8px;
            color: #8a938c;
            font-weight: 700;
        }
        .sidebar-tagline {
            font-size: 0.78rem;
            color: #8a938c;
            margin: 4px 0 26px 0;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--sbm-line);
        }

        .admin-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4b564e;
            font-weight: 500;
            font-size: 0.92rem;
            padding: 11px 14px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: 0.2s;
        }
        .admin-nav .nav-link i { font-size: 1.05rem; color: #8a938c; transition: 0.2s; }
        .admin-nav .nav-link:hover { background: #EFF5F0; color: var(--sbm-hijau-dark); }
        .admin-nav .nav-link:hover i { color: var(--sbm-hijau); }
        .admin-nav .nav-link.active {
            background: linear-gradient(135deg, var(--sbm-hijau) 0%, #3a9a40 100%);
            color: #fff;
            box-shadow: 0 8px 16px rgba(46, 125, 50, 0.22);
        }
        .admin-nav .nav-link.active i { color: #fff; }

        .sidebar-card {
            background: var(--sbm-bg);
            border: 1px solid var(--sbm-line);
            border-radius: 14px;
            padding: 16px;
        }
        .sidebar-card h6 { font-weight: 700; font-size: 0.85rem; }

        .btn-outline-brand {
            border: 1px solid var(--sbm-line);
            color: #45514a;
            background: #fff;
            font-weight: 500;
            font-size: 0.85rem;
        }
        .btn-outline-brand:hover { background: #eef3ef; color: var(--sbm-hijau-dark); }

        .btn-logout-soft {
            background: #FBEAEA;
            color: var(--sbm-alert);
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .btn-logout-soft:hover { background: #F4D6D6; color: #8f251b; }

        /* ============ Topbar (mobile) ============ */
        .admin-topbar-mobile {
            background: #fff;
            border-bottom: 1px solid var(--sbm-line);
            padding: 14px 18px;
        }

        /* ============ Main content ============ */
        .admin-main { padding: 32px clamp(18px, 3vw, 44px); }

        .page-heading h1 { font-size: 1.9rem; font-weight: 900; color: #1f2a22; margin-bottom: 4px; }
        .page-heading p { color: #6d7871; margin-bottom: 0; }

        .btn-sbm {
            background: linear-gradient(135deg, var(--sbm-oren) 0%, #bc5a1d 100%);
            color: white;
            border: none;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 14px;
            transition: transform 0.24s ease, box-shadow 0.24s ease;
            box-shadow: 0 14px 26px rgba(200, 90, 23, 0.2);
        }
        .btn-sbm:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 18px 30px rgba(200, 90, 23, 0.28);
        }

        .page-heading {
            background: linear-gradient(180deg, rgba(255,255,255,0.92), rgba(246,249,246,0.92));
            border: 1px solid rgba(230,236,231,0.9);
            border-radius: 24px;
            padding: 24px 26px;
            box-shadow: 0 20px 48px rgba(21, 44, 28, 0.06);
        }
        .page-heading h1 { margin-bottom: 8px; }
        .page-heading p { margin-bottom: 0; }

        /* ============ Stat cards ============ */
        .stat-card {
            background: #fff;
            border: 1px solid rgba(231,235,232,0.85);
            border-radius: 18px;
            padding: 22px 24px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 18px 36px rgba(31, 42, 34, 0.08); }
        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .stat-value { font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 900; line-height: 1; margin-bottom: 4px; color: #1f2a22; }
        .stat-label { font-size: 0.78rem; color: #75807a; font-weight: 500; }

        /* ============ Cards / Sections ============ */
        .panel-card {
            background: #fff;
            border: 1px solid rgba(231,235,232,0.92);
            border-radius: 22px;
            box-shadow: 0 16px 34px rgba(31, 42, 34, 0.06);
        }
        .panel-card .card-body { padding: 28px; }
        .panel-title { font-weight: 800; font-size: 1.08rem; color: #1f2a22; margin-bottom: 2px; }
        .panel-subtitle { color: #75807a; font-size: 0.85rem; }

        .panel-icon-badge {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: #E8F5E9;
            color: var(--sbm-hijau);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* ============ Table ============ */
        .table-sbm thead th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #8a938c;
            font-weight: 700;
            border-bottom: 1px solid var(--sbm-line);
            background: transparent;
            padding-bottom: 12px;
        }
        .table-sbm td {
            vertical-align: middle;
            border-bottom: 1px solid #eef2ee;
            padding-top: 16px;
            padding-bottom: 16px;
            font-size: 0.92rem;
        }
        .table-sbm tbody tr:hover { background: #f7faf6; }
        .table-sbm tr:last-child td { border-bottom: none; }

        .avatar-initial {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #E8F5E9;
            color: var(--sbm-hijau-dark);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .cluster-thumb {
            width: 52px; height: 52px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            background: #eef1ee;
        }

        .badge-pill-soft {
            font-weight: 600;
            font-size: 0.72rem;
            padding: 6px 12px;
            border-radius: 999px;
        }
        .badge.bg-success { background-color: #E4F4E6 !important; color: #1e7d34 !important; }
        .badge.bg-danger  { background-color: #FBE7E5 !important; color: #b8362a !important; }
        .badge.bg-warning { background-color: #FFF3D6 !important; color: #92660a !important; }
        .badge.bg-info    { background-color: #E1F1F8 !important; color: #1c6e8c !important; }

        .btn-icon-sm {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--sbm-line);
            background: #fff;
            color: #4b564e;
            transition: 0.2s;
        }
        .btn-icon-sm:hover { background: #EFF5F0; color: var(--sbm-hijau-dark); }
        .btn-icon-sm.danger:hover { background: #FBE7E5; color: var(--sbm-alert); border-color: #f3cfcb; }

        .empty-state {
            text-align: center;
            padding: 46px 20px;
            color: #8a938c;
        }
        .empty-state i { font-size: 1.8rem; color: #c7cfc9; margin-bottom: 10px; display: block; }

        /* ============ Forms ============ */
        .form-section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--sbm-hijau-dark);
            margin: 22px 0 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-section-label:first-child { margin-top: 0; }
        .form-section-label i { font-size: 0.9rem; }

        .form-label { font-size: 0.85rem; font-weight: 600; color: #3f4a43; margin-bottom: 6px; }
        .form-control, .form-select, textarea.form-control {
            border: 1px solid #dfe5e0;
            border-radius: 10px;
            padding: 10px 13px;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--sbm-hijau);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.12);
        }
        .form-control.is-invalid,
        .form-select.is-invalid,
        textarea.form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.08);
        }
        .form-control.is-invalid::placeholder,
        textarea.form-control.is-invalid::placeholder {
            color: rgba(220, 53, 69, 0.75);
        }
        .invalid-feedback {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            margin-top: 0.45rem;
        }

        .divider-soft { border-top: 1px solid var(--sbm-line); margin: 26px 0; }

        @media (max-width: 991.98px) {
            .admin-main { padding: 24px 16px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">

            <!-- ============ TOPBAR MOBILE ============ -->
            <div class="col-12 d-lg-none admin-topbar-mobile d-flex align-items-center justify-content-between">
                <a class="sidebar-brand flex-row align-items-center gap-2" href="#" style="flex-direction: row;">
                    <svg width="34" height="11" viewBox="0 0 54 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <polyline points="2,15 27,2 52,15" stroke="url(#sbmRoofGradMobile)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        <defs>
                            <linearGradient id="sbmRoofGradMobile" x1="2" y1="0" x2="52" y2="0" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#2E7D32"></stop>
                                <stop offset="1" stop-color="#C85A17"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="sbm-text" style="font-size:1.3rem;">SBM</span>
                </a>
                <button class="btn btn-outline-brand rounded-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar">
                    <i class="bi bi-list"></i> Menu
                </button>
            </div>

            <!-- ============ SIDEBAR ============ -->
            <aside class="col-lg-3 xl-col-2 offcanvas-lg offcanvas-start admin-sidebar" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
                <div class="d-flex align-items-center justify-content-between d-lg-none mb-3">
                    <span class="fw-bold" id="adminSidebarLabel">Menu</span>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebar"></button>
                </div>

                <a href="/" class="sidebar-brand">
                    <svg class="sbm-roof" width="46" height="14" viewBox="0 0 54 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <polyline points="2,15 27,2 52,15" stroke="url(#sbmRoofGradSidebar)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        <defs>
                            <linearGradient id="sbmRoofGradSidebar" x1="2" y1="0" x2="52" y2="0" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#2E7D32"></stop>
                                <stop offset="1" stop-color="#C85A17"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="sbm-text"><span class="text-hijau">S</span><span class="text-oren">B</span><span class="text-hijau">M</span></span>
                    <span class="sbm-desc">SWARGA BOEMI MADANI</span>
                </a>
                <p class="sidebar-tagline">Panel admin &middot; kelola konten landing page penjualan rumah.</p>

                <nav class="nav flex-column admin-nav mb-4">
                    <a href="#clusters" class="nav-link active"><i class="bi bi-grid-3x3-gap-fill"></i> Kelola Cluster</a>
                    <a href="#add-cluster" class="nav-link"><i class="bi bi-plus-square"></i> Tambah Cluster</a>
                    <a href="#agent" class="nav-link"><i class="bi bi-person-vcard"></i> Data Agen</a>
                    <a href="#surveys" class="nav-link"><i class="bi bi-clipboard2-check"></i> Pengajuan Survei</a>
                </nav>

                <div class="sidebar-card mb-3">
                    <h6 class="text-hijau"><i class="bi bi-lightning-charge-fill me-1"></i> Aksi Cepat</h6>
                    <a href="/" class="btn btn-outline-brand w-100 mb-2 rounded-3"><i class="bi bi-box-arrow-up-right me-1"></i> Lihat Frontend</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout-soft w-100 rounded-3"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                    </form>
                </div>

                <div class="sidebar-card">
                    <h6 class="text-oren"><i class="bi bi-info-circle-fill me-1"></i> Info</h6>
                    <p class="small text-muted mb-0">Pastikan semua data cluster dan kontak agen diisi sebelum membagikan link ini ke calon pembeli.</p>
                </div>
            </aside>

            <!-- ============ MAIN CONTENT ============ -->
            <main class="col-lg-9 admin-main">

                <div class="page-heading d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                    <div>
                        <div class="eyebrow">Admin Panel</div>
                        <h1>Dashboard Admin SBM</h1>
                        <p>Sistem manajemen konten untuk landing page penjualan rumah.</p>
                    </div>
                    <a href="#add-cluster" class="btn btn-sbm"><i class="bi bi-plus-lg me-1"></i> Tambah Cluster</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- ============ STAT CARDS ============ -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:#E8F5E9; color: var(--sbm-hijau);"><i class="bi bi-houses-fill"></i></div>
                            <div>
                                <p class="stat-value">{{ $clusters->count() }}</p>
                                <p class="stat-label mb-0">Total Unit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:#FBEDE1; color: var(--sbm-oren);"><i class="bi bi-house-check-fill"></i></div>
                            <div>
                                <p class="stat-value">{{ $clusters->where('status.name', 'Tersedia')->count() }}</p>
                                <p class="stat-label mb-0">Unit Tersedia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:#FDF2E3; color: #b8860b;"><i class="bi bi-tags-fill"></i></div>
                            <div>
                                <p class="stat-value">{{ $clusters->pluck('type')->unique()->count() }}</p>
                                <p class="stat-label mb-0">Tipe Rumah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:#FBE7E5; color: var(--sbm-alert);"><i class="bi bi-hourglass-split"></i></div>
                            <div>
                                <p class="stat-value">{{ $pendingSurveyCount ?? 0 }}</p>
                                <p class="stat-label mb-0">Survei Pending</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ SURVEY SUBMISSIONS ============ -->
                <section id="surveys" class="mb-4">
                    <div class="panel-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="panel-icon-badge" style="background:#FBE7E5; color: var(--sbm-alert);"><i class="bi bi-clipboard2-check"></i></div>
                                    <div>
                                        <p class="panel-title mb-0">Pengajuan Survei Baru</p>
                                        <p class="panel-subtitle mb-0">Ada {{ $pendingSurveyCount ?? 0 }} pengajuan yang menunggu diproses.</p>
                                    </div>
                                </div>
                                <span class="badge bg-danger badge-pill-soft">{{ $pendingSurveyCount ?? 0 }} Pending</span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sbm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kontak</th>
                                            <th>Jadwal Pilihan</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($surveySubmissions) && count($surveySubmissions) > 0)
                                            @foreach($surveySubmissions as $submission)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="avatar-initial">{{ strtoupper(substr($submission->name, 0, 1)) }}</div>
                                                            <span class="fw-semibold">{{ $submission->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $submission->email }}<br><small class="text-muted">{{ $submission->phone }}</small></td>
                                                    <td>{{ $submission->preferred_schedule ?? '-' }}</td>
                                                    <td>
                                                        @php
                                                            $statusLabel = match ($submission->status) {
                                                                'approved' => ['label' => 'Approved', 'class' => 'bg-success'],
                                                                'rejected' => ['label' => 'Rejected', 'class' => 'bg-danger'],
                                                                'rescheduled' => ['label' => 'Rescheduled', 'class' => 'bg-info text-dark'],
                                                                default => ['label' => 'Pending', 'class' => 'bg-warning text-dark'],
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $statusLabel['class'] }} badge-pill-soft">{{ $statusLabel['label'] }}</span>
                                                    </td>
                                                    <td class="text-muted">{{ \Illuminate\Support\Str::limit($submission->notes, 80) }}</td>
                                                    <td class="text-end">
                                                        <div class="d-inline-flex gap-2">
                                                            <a href="{{ route('admin.survey-submissions.show', $submission) }}" class="btn-icon-sm" title="Lihat detail"><i class="bi bi-eye"></i></a>
                                                            <form method="POST" action="{{ route('admin.survey-submissions.destroy', $submission) }}" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-icon-sm danger" title="Hapus pengajuan" onclick="return confirm('Hapus pengajuan survei ini?')">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    <div class="empty-state">
                                                        <i class="bi bi-inbox"></i>
                                                        Belum ada pengajuan survei.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ============ CLUSTER LIST ============ -->
                <section id="clusters" class="mb-4">
                    <div class="panel-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="panel-icon-badge"><i class="bi bi-grid-3x3-gap-fill"></i></div>
                                <div>
                                    <p class="panel-title mb-0">Daftar Cluster</p>
                                    <p class="panel-subtitle mb-0">Semua unit yang akan ditampilkan di halaman utama.</p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sbm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Tipe</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clusters as $cluster)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <!-- KODE INI SUDAH DIREVISI AGAR MEMBACA DARI STORAGE -->
                                                        <img src="{{ $cluster->image_url ? asset('storage/' . $cluster->image_url) : 'https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=100&q=80' }}" class="cluster-thumb" alt="{{ $cluster->name }}">
                                                        <span class="fw-semibold">{{ $cluster->name }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $cluster->type }}</td>
                                                <td>Rp {{ number_format($cluster->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge bg-light text-dark border badge-pill-soft">
                                                        {{ $cluster->status->name }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-inline-flex gap-2">
                                                        <a href="{{ route('admin.clusters.edit', $cluster) }}" class="btn-icon-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                                        <form method="POST" action="{{ route('admin.clusters.destroy', $cluster) }}" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-icon-sm danger" title="Hapus" onclick="return confirm('Hapus cluster ini?')"><i class="bi bi-trash3"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="empty-state">
                                                        <i class="bi bi-house-slash"></i>
                                                        Belum ada data cluster. Silakan tambahkan cluster baru di bawah.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ============ ADD CLUSTER FORM ============ -->
                <section id="add-cluster" class="mb-4">
                    <div class="panel-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="panel-icon-badge" style="background:#FBEDE1; color: var(--sbm-oren);"><i class="bi bi-plus-square"></i></div>
                                <div>
                                    <p class="panel-title mb-0">Tambah Cluster Baru</p>
                                    <p class="panel-subtitle mb-0">Lengkapi detail unit yang akan tampil di halaman utama.</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.clusters.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf

                                <div class="form-section-label"><i class="bi bi-card-heading"></i> Informasi Dasar</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="cluster-name">Nama Cluster</label>
                                        <input type="text" id="cluster-name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ketikkan nama cluster" required>
                                        @error('name')
                                            <div class="invalid-feedback d-block">Ketikkan nama cluster terlebih dahulu.</div>
                                        @else
                                            <div class="invalid-feedback">Nama Cluster wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="cluster-type">Tipe</label>
                                        <input type="text" id="cluster-type" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" placeholder="Contoh: Type 36/72" required>
                                        @error('type')
                                            <div class="invalid-feedback d-block">Masukkan tipe cluster dengan benar.</div>
                                        @else
                                            <div class="invalid-feedback">Tipe cluster wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-price">Harga</label>
                                        <input type="number" id="cluster-price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" min="0" step="1000" placeholder="Masukkan harga" required>
                                        @error('price')
                                            <div class="invalid-feedback d-block">Harga harus berupa angka yang valid.</div>
                                        @else
                                            <div class="invalid-feedback">Harga harus berupa angka yang valid.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-land-area">Luas Tanah (m²)</label>
                                        <input type="number" id="cluster-land-area" name="land_area" class="form-control @error('land_area') is-invalid @enderror" value="{{ old('land_area') }}" min="1" step="1" placeholder="Contoh: 72" required>
                                        @error('land_area')
                                            <div class="invalid-feedback d-block">Luas tanah harus lebih dari 0.</div>
                                        @else
                                            <div class="invalid-feedback">Luas tanah wajib diisi dan harus lebih dari 0.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-building-area">Luas Bangunan (m²)</label>
                                        <input type="number" id="cluster-building-area" name="building_area" class="form-control @error('building_area') is-invalid @enderror" value="{{ old('building_area') }}" min="1" step="1" placeholder="Contoh: 36" required>
                                        @error('building_area')
                                            <div class="invalid-feedback d-block">Luas bangunan harus lebih dari 0.</div>
                                        @else
                                            <div class="invalid-feedback">Luas bangunan wajib diisi dan harus lebih dari 0.</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-section-label"><i class="bi bi-rulers"></i> Spesifikasi Tambahan</div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-bedrooms">Kamar Tidur</label>
                                        <input type="number" id="cluster-bedrooms" name="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror" value="{{ old('bedrooms') }}" min="0" step="1" placeholder="Contoh: 2" required>
                                        @error('bedrooms')
                                            <div class="invalid-feedback d-block">Jumlah kamar tidur harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Jumlah kamar tidur wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-bathrooms">Kamar Mandi</label>
                                        <input type="number" id="cluster-bathrooms" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}" min="0" step="1" placeholder="Contoh: 2" required>
                                        @error('bathrooms')
                                            <div class="invalid-feedback d-block">Jumlah kamar mandi harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Jumlah kamar mandi wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="cluster-carport">Carport</label>
                                        <input type="number" id="cluster-carport" name="carport" class="form-control @error('carport') is-invalid @enderror" value="{{ old('carport', 1) }}" min="0" step="1" placeholder="Contoh: 1" required>
                                        @error('carport')
                                            <div class="invalid-feedback d-block">Jumlah carport harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Jumlah carport wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="cluster-status">Status</label>
                                        <select id="cluster-status" name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                                            <option value="" disabled {{ old('status_id') == '' ? 'selected' : '' }}>-- Pilih Status --</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                                    {{ ucfirst($status->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Silakan pilih status cluster.</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-section-label"><i class="bi bi-image"></i> Media &amp; Deskripsi</div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="cluster-image">Upload Gambar Cluster</label>
                                        <input type="file" id="cluster-image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback d-block">Silakan pilih gambar cluster yang valid.</div>
                                        @else
                                            <div class="invalid-feedback">Silakan pilih gambar cluster.</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="cluster-description">Deskripsi</label>
                                        <textarea id="cluster-description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Jelaskan keunggulan cluster, lokasi, dan fasilitasnya" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback d-block">Deskripsi cluster wajib diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Deskripsi cluster wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="cluster-feature-summary">Ringkasan Fitur</label>
                                        <textarea id="cluster-feature-summary" name="feature_summary" class="form-control @error('feature_summary') is-invalid @enderror" rows="2">{{ old('feature_summary') }}</textarea>
                                        @error('feature_summary')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="divider-soft"></div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sbm"><i class="bi bi-check2-circle me-1"></i> Simpan Cluster</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <!-- ============ AGENT DATA FORM ============ -->
                <section id="agent">
                    <div class="panel-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="panel-icon-badge" style="background:#E8F5E9; color: var(--sbm-hijau);"><i class="bi bi-person-vcard"></i></div>
                                <div>
                                    <p class="panel-title mb-0">Data Agen</p>
                                    <p class="panel-subtitle mb-0">Kontak yang tampil di halaman utama untuk calon pembeli.</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.agent.update') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-3 mt-1">
                                    <div class="col-12">
                                        <label class="form-label" for="agent-name">Nama Agen</label>
                                        <input type="text" id="agent-name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', optional($agent)->name) }}" placeholder="Ketikkan nama agen" required>
                                        @error('name')
                                            <div class="invalid-feedback d-block">Ketikkan nama agen terlebih dahulu.</div>
                                        @else
                                            <div class="invalid-feedback">Nama Agen wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-phone">Telepon</label>
                                        <input type="text" id="agent-phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', optional($agent)->phone) }}" placeholder="Contoh: 0812-3456-7890" required>
                                        @error('phone')
                                            <div class="invalid-feedback d-block">Nomor telepon harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Nomor telepon wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-whatsapp">WhatsApp</label>
                                        <input type="text" id="agent-whatsapp" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', optional($agent)->whatsapp) }}" placeholder="Contoh: 0812-3456-7890" required>
                                        @error('whatsapp')
                                            <div class="invalid-feedback d-block">Nomor WhatsApp harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Nomor WhatsApp wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-email">Email</label>
                                        <input type="email" id="agent-email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', optional($agent)->email) }}" placeholder="contoh@email.com" required>
                                        @error('email')
                                            <div class="invalid-feedback d-block">Email harus diisi dengan format yang benar.</div>
                                        @else
                                            <div class="invalid-feedback">Email harus diisi dengan format yang valid.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-map-link">Link Maps</label>
                                        <input type="url" id="agent-map-link" name="map_link" class="form-control @error('map_link') is-invalid @enderror" value="{{ old('map_link', optional($agent)->map_link) }}">
                                        @error('map_link')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Link maps harus berupa URL yang valid.</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="agent-address">Alamat</label>
                                        <textarea id="agent-address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Ketikkan alamat kantor atau lokasi agen" required>{{ old('address', optional($agent)->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback d-block">Alamat agen harus diisi.</div>
                                        @else
                                            <div class="invalid-feedback">Alamat agen wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-schedule">Jadwal Kunjungan</label>
                                        <input type="text" id="agent-schedule" name="schedule" class="form-control @error('schedule') is-invalid @enderror" value="{{ old('schedule', optional($agent)->schedule) }}">
                                        @error('schedule')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Jadwal kunjungan tidak valid.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agent-promo">Promo</label>
                                        <input type="text" id="agent-promo" name="promo" class="form-control @error('promo') is-invalid @enderror" value="{{ old('promo', optional($agent)->promo) }}">
                                        @error('promo')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Promo tidak valid.</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="divider-soft"></div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sbm"><i class="bi bi-check2-circle me-1"></i> Simpan Agen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bootstrap 5 form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(function (form) {
                if (form.querySelector('.is-invalid')) {
                    form.classList.add('was-validated');
                }

                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Highlight active sidebar link based on scroll position
            const navLinks = document.querySelectorAll('.admin-nav .nav-link');
            const sections = document.querySelectorAll('main section[id]');

            function updateActiveNav() {
                const scrollPosition = window.scrollY + 160;
                let current = sections[0]?.id;
                sections.forEach(section => {
                    if (section.offsetTop <= scrollPosition) {
                        current = section.id;
                    }
                });
                navLinks.forEach(link => {
                    link.classList.toggle('active', link.getAttribute('href') === `#${current}`);
                });
            }

            window.addEventListener('scroll', updateActiveNav);
            updateActiveNav();

            // Close mobile offcanvas after clicking a nav link
            const offcanvasEl = document.getElementById('adminSidebar');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    const instance = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    if (instance) instance.hide();
                });
            });
        });
    </script>
</body>
</html>