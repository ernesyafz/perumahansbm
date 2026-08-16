<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWARGA BOEMI MADANI - SBM</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================================
           DESIGN TOKENS & ANIMATIONS (UI MODERN)
           ============================================================ */
        html { scroll-behavior: smooth; }

        :root {
            --sbm-hijau: #2E7D32;
            --sbm-hijau-dark: #17421A;
            --sbm-hijau-light: #E1F0E2;
            --sbm-oren: #C85A17;
            --sbm-oren-light: #FBE6D2;
            --sbm-peach: #F4A261;
            --sbm-peach-light: #FDF0E4;
            --sbm-bg: #F8FAF8;
            --sbm-ink: #182119;
            --sbm-line: #E4EAE4;

            --shadow-soft: 0 20px 44px rgba(23, 66, 26, 0.08);
            --shadow-lift: 0 30px 60px rgba(23, 66, 26, 0.16);
            --shadow-glow-hijau: 0 20px 40px rgba(46, 125, 50, 0.25);
            --shadow-glow-oren: 0 20px 40px rgba(200, 90, 23, 0.25);
            
            --radius-xl: 30px;
            --radius-lg: 24px;
            --radius-md: 18px;
            --radius-sm: 12px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--sbm-bg);
            /* Pola titik-titik modern di background */
            background-image: radial-gradient(var(--sbm-line) 1px, transparent 1px);
            background-size: 28px 28px;
            font-family: 'Inter', sans-serif;
            color: var(--sbm-ink);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-display { font-family: 'Playfair Display', serif; }

        .text-hijau { color: var(--sbm-hijau) !important; }
        .text-oren { color: var(--sbm-oren) !important; }
        .bg-hijau { background-color: var(--sbm-hijau) !important; }
        .bg-oren { background-color: var(--sbm-oren) !important; }

        @keyframes morph {
            0%, 100% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
            34% { border-radius: 70% 30% 50% 50% / 30% 30% 70% 70%; }
            67% { border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%; }
        }

        @keyframes floatAnim {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes fadeUp { 
            from { opacity: 0; transform: translateY(30px); } 
            to { opacity: 1; transform: none; } 
        }

        /* ============================================================
           SCROLL REVEAL
           ============================================================ */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity .9s var(--ease), transform .9s var(--ease);
            transition-delay: var(--d, 0ms);
        }
        .reveal.is-visible { opacity: 1; transform: none; }

        /* ============================================================
           EYEBROW LABEL
           ============================================================ */
        .eyebrow {
            font-size: 0.8rem; font-weight: 800; letter-spacing: 3px;
            text-transform: uppercase; display: inline-flex; align-items: center; gap: 12px;
            margin-bottom: 16px;
        }
        .eyebrow::before {
            content: ''; width: 40px; height: 3px;
            background: currentColor; display: inline-block; border-radius: 3px;
        }

        /* ============================================================
           NAVBAR
           ============================================================ */
        .navbar-sbm {
            padding: 18px 0; background: rgba(248, 250, 248, 0.4);
            backdrop-filter: blur(20px) saturate(180%); -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            transition: all .4s var(--ease); z-index: 1040;
        }
        .navbar-sbm.is-scrolled {
            padding: 12px 0; background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 40px rgba(23, 66, 26, 0.08); border-bottom-color: var(--sbm-line);
        }

        .sbm-brand-container { display: flex; flex-direction: column; align-items: center; text-decoration: none; line-height: 1; }
        .sbm-roof { margin-bottom: -4px; filter: drop-shadow(0 2px 5px rgba(46, 125, 50, 0.3)); }
        .sbm-text { font-family: 'Playfair Display', serif; font-size: 1.85rem; font-weight: 900; letter-spacing: 2.5px; line-height: 1; }
        .sbm-desc { font-size: 0.58rem; color: #6b7280; letter-spacing: 2px; margin-top: 3px; font-weight: 700; white-space: nowrap; }

        .nav-link { font-weight: 600; color: #55635B; transition: 0.3s; font-size: 0.95rem; position: relative; margin: 0 5px; }
        .nav-link::after {
            content: ''; position: absolute; left: 50%; bottom: 0; transform: translateX(-50%);
            width: 0; height: 3px; border-radius: 3px; background: var(--sbm-oren); transition: width .3s var(--ease);
        }
        .nav-link:hover, .nav-link.active { color: var(--sbm-hijau) !important; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        .btn-oren-solid {
            background: linear-gradient(270deg, var(--sbm-oren), #f57f30, var(--sbm-oren));
            background-size: 200% 200%;
            color: white; border: none; transition: 0.3s; box-shadow: var(--shadow-glow-oren);
        }
        .btn-oren-solid:hover { transform: translateY(-3px) scale(1.02); color: white; }

        /* ============================================================
           HERO SECTION
           ============================================================ */
        .hero-section {
            position: relative;
            background-image:
                radial-gradient(circle at 80% 20%, rgba(200,90,23,0.3) 0%, transparent 40%),
                radial-gradient(circle at 20% 80%, rgba(46,125,50,0.4) 0%, transparent 50%),
                linear-gradient(180deg, rgba(10,25,12,0.85), rgba(15,35,18,0.95)),
                url('https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center; background-attachment: fixed;
            color: white; padding: 180px 0 0; overflow: hidden; text-align: center;
        }
        .hero-inner { padding-bottom: 100px; position: relative; z-index: 2; }

        .hero-pill {
            display: inline-flex; align-items: center; gap: 8px; padding: 0.8rem 1.6rem;
            border-radius: 999px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(12px); font-weight: 600; font-size: 0.85rem; letter-spacing: 0.04em;
            margin-bottom: 34px; animation: fadeUp .8s var(--ease) both;
            box-shadow: 0 0 20px rgba(255,255,255,0.05);
        }
        
        .hero-title {
            font-size: clamp(2.8rem, 6vw, 5.2rem); font-weight: 900; line-height: 1.1;
            margin-bottom: 26px; letter-spacing: 0.01em; text-shadow: 0 20px 50px rgba(0,0,0,0.5);
            animation: fadeUp .9s var(--ease) .1s both;
        }
        .hero-title .highlight { color: var(--sbm-peach); }
        .text-gradient {
            background: linear-gradient(90deg, #ffe66d, #ff7a00, #ff3c78);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.18), transparent 18%),
                        radial-gradient(circle at 85% 30%, rgba(255,183,77,0.16), transparent 22%);
            pointer-events: none;
        }
        .hero-desc {
            max-width: 750px; margin: 0 auto 40px; font-size: 1.15rem; color: rgba(255,255,255,0.92);
            line-height: 1.8; animation: fadeUp .9s var(--ease) .22s both; font-weight: 300;
        }
        .hero-pill {
            display: inline-flex; align-items: center; gap: 8px; padding: 0.9rem 1.8rem;
            border-radius: 999px; background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,0.75));
            border: 1px solid rgba(255,255,255,0.55); backdrop-filter: blur(18px); font-weight: 700; font-size: 0.92rem;
            letter-spacing: 0.04em; margin-bottom: 34px; animation: fadeUp .8s var(--ease) both;
            box-shadow: 0 24px 50px rgba(0,0,0,0.12);
            color: #2a4b31;
        }
        .hero-actions { display: flex; justify-content: center; gap: 1.2rem; flex-wrap: wrap; animation: fadeUp .9s var(--ease) .34s both; }

        .btn-hero-solid, .btn-hero-outline {
            min-width: 200px; border-radius: 999px; font-weight: 700; letter-spacing: 0.03em;
            padding: 16px 34px; transition: all .3s var(--ease); position: relative; overflow: hidden;
            text-decoration: none;
        }
        .btn-hero-solid {
            background: linear-gradient(270deg, var(--sbm-hijau), #4F9A51, var(--sbm-hijau));
            background-size: 200% 200%; color: white; border: none; box-shadow: var(--shadow-glow-hijau);
        }
        .btn-hero-solid:hover { transform: translateY(-5px); box-shadow: 0 30px 60px rgba(46, 125, 50, 0.4); color: white; }
        
        .btn-hero-outline {
            background: rgba(255,255,255,0.05); color: white; border: 2px solid rgba(255,255,255,0.4);
            backdrop-filter: blur(5px);
        }
        .btn-hero-outline:hover { transform: translateY(-5px); background: #fff; color: var(--sbm-hijau-dark); border-color: #fff; box-shadow: 0 20px 40px rgba(255,255,255,0.2); }

        .hero-stats { display: flex; flex-wrap: wrap; justify-content: center; gap: 24px; margin-top: 70px; animation: fadeUp 1s var(--ease) .46s both; }
        .hero-stat-card {
            flex: 1 1 200px; max-width: 240px;
            background: linear-gradient(145deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.05) 100%);
            border: 1px solid rgba(255,255,255,0.3); backdrop-filter: blur(16px);
            border-radius: var(--radius-lg); padding: 26px 20px; text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2); transition: transform 0.3s;
        }
        .hero-stat-card:hover { transform: translateY(-10px); background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.5); }
        .stat-number { font-family: 'Playfair Display', serif; font-size: 2.8rem; color: var(--sbm-peach); margin-bottom: 4px; font-weight: 900; text-shadow: 0 5px 15px rgba(244,162,97,0.3); }
        .stat-label { font-size: 0.9rem; color: #fff; letter-spacing: 0.05em; text-transform: uppercase; font-weight: 600; margin-bottom: 0; }

        .roofline-divider { display: block; width: 100%; height: 70px; margin-top: 60px; position: relative; z-index: 2; }
        .roofline-divider path { fill: var(--sbm-bg); }

        /* ============================================================
           TENTANG KAWASAN
           ============================================================ */
        .tentang-section { position: relative; padding-top: 40px; }
        .tentang-blob { position: absolute; filter: blur(80px); z-index: 0; pointer-events: none; animation: morph 12s ease-in-out infinite, floatAnim 8s ease-in-out infinite; }
        .tentang-blob-1 { width: 400px; height: 400px; background: rgba(46,125,50,0.15); top: -50px; right: -100px; }
        .tentang-blob-2 { width: 350px; height: 350px; background: rgba(244,162,97,0.15); bottom: -100px; left: -100px; animation-delay: -4s; }
        .tentang-section .container { position: relative; z-index: 1; }

        .chip-row { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
        .info-chip {
            display: inline-flex; align-items: center; gap: 10px; padding: 10px 20px; border-radius: 999px;
            font-size: 0.85rem; font-weight: 700; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 10px 20px rgba(0,0,0,0.04);
            transition: transform 0.3s;
        }
        .info-chip:hover { transform: translateY(-3px); background: #fff; }
        .info-chip .dot { width: 10px; height: 10px; border-radius: 50%; box-shadow: 0 0 10px currentColor; }
        .info-chip.hijau { color: var(--sbm-hijau); } .info-chip.hijau .dot { background: var(--sbm-hijau); }
        .info-chip.oren { color: var(--sbm-oren); } .info-chip.oren .dot { background: var(--sbm-oren); }
        .info-chip.peach { color: #d67a33; } .info-chip.peach .dot { background: var(--sbm-peach); }

        .tentang-image-frame {
            position: relative; border-radius: var(--radius-xl); padding: 12px;
            background: linear-gradient(135deg, rgba(46,125,50,0.2) 0%, rgba(244,162,97,0.2) 100%);
            box-shadow: var(--shadow-lift);
        }
        .tentang-image-frame img { border-radius: 24px; display: block; width: 100%; transition: transform 0.5s; }
        .tentang-image-frame:hover img { transform: scale(0.98); }

        .floating-badge {
            position: absolute; background: rgba(255,255,255,0.85); backdrop-filter: blur(15px);
            padding: 16px 22px; border-radius: var(--radius-lg); box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 14px; border: 1px solid rgba(255,255,255,0.6);
            animation: floatAnim 6s ease-in-out infinite;
        }
        .floating-badge.badge-1 { top: -20px; right: -20px; animation-delay: 0s; }
        .floating-badge.badge-2 { bottom: -20px; left: -20px; animation-delay: -3s; }
        .floating-badge .icon-box {
            width: 50px; height: 50px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            background: linear-gradient(135deg, var(--bg-1), var(--bg-2)); color: white;
            box-shadow: 0 10px 20px var(--shadow-color);
        }
        .floating-badge.badge-1 .icon-box { --bg-1: var(--sbm-oren); --bg-2: #f57f30; --shadow-color: rgba(200,90,23,0.3); }
        .floating-badge.badge-2 .icon-box { --bg-1: var(--sbm-hijau); --bg-2: #4F9A51; --shadow-color: rgba(46,125,50,0.3); }

        /* ============================================================
           FITUR / KEUNGGULAN 
           ============================================================ */
        .feature-card {
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px);
            border-radius: var(--radius-lg); padding: 40px 30px; height: 100%;
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-bottom: 4px solid var(--sbm-line);
            transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative; overflow: hidden;
        }
        .feature-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, transparent 100%);
            z-index: 0; opacity: 0; transition: opacity 0.4s;
        }
        .feature-card > * { position: relative; z-index: 1; }
        
        .feature-card:hover {
            transform: translateY(-12px); border-bottom: 4px solid var(--sbm-oren);
            box-shadow: var(--shadow-glow-oren); background: #fff;
        }
        .feature-card:hover::before { opacity: 1; }
        
        .feature-icon-wrapper {
            width: 60px; height: 60px; border-radius: 18px;
            background: linear-gradient(135deg, var(--sbm-hijau-light) 0%, #fff 100%);
            box-shadow: 0 10px 20px rgba(46, 125, 50, 0.1);
            display: flex; align-items: center; justify-content: center; margin-bottom: 24px;
            color: var(--sbm-hijau); transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .feature-card:hover .feature-icon-wrapper {
            background: linear-gradient(135deg, var(--sbm-oren), #f57f30); color: white;
            transform: scale(1.15) rotate(5deg); box-shadow: 0 15px 30px rgba(200, 90, 23, 0.4);
        }

        /* ============================================================
           UNIT RUMAH
           ============================================================ */
        .unit-card {
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: var(--radius-lg); overflow: hidden;
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px);
            transition: all .4s var(--ease); height: 100%; position: relative;
        }
        .unit-card:hover { transform: translateY(-12px); box-shadow: var(--shadow-glow-hijau); border-color: var(--sbm-hijau-light); background: #fff; }
        
        .unit-card-img-wrap { position: relative; overflow: hidden; aspect-ratio: 4 / 3; }
        .unit-card-img-wrap::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.5), transparent); opacity: 0; transition: opacity 0.4s;
        }
        .unit-card:hover .unit-card-img-wrap::after { opacity: 1; }
        
        .unit-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s var(--ease); }
        .unit-card:hover .unit-card-img-wrap img { transform: scale(1.1); }
        
        .unit-type-badge {
            position: absolute; top: 16px; left: 16px; z-index: 10;
            font-weight: 800; font-size: 0.8rem;
            letter-spacing: 0.05em; text-transform: uppercase; padding: 8px 16px; border-radius: 999px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* ============================================================
           SEARCH BOX — Pilihan Hunian
           ============================================================ */
        .unit-search-form { max-width: 560px; }
        .unit-search-box {
            background: #fff;
            border-radius: 999px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--sbm-line);
            display: flex;
            align-items: center;
            padding: 6px 6px 6px 22px;
            transition: box-shadow .3s var(--ease), border-color .3s var(--ease);
        }
        .unit-search-box:focus-within {
            box-shadow: var(--shadow-glow-hijau);
            border-color: var(--sbm-hijau);
        }
        .unit-search-box svg { color: var(--sbm-ink); opacity: .45; flex-shrink: 0; }
        .unit-search-input {
            border: none; outline: none; background: transparent;
            flex: 1; padding: 12px 14px; font-size: 0.95rem; color: var(--sbm-ink);
        }
        .unit-search-btn {
            background: linear-gradient(135deg, var(--sbm-hijau), #4F9A51);
            color: #fff; border: none; font-weight: 700; font-size: 0.9rem;
            padding: 12px 26px; border-radius: 999px; flex-shrink: 0;
            transition: transform .25s var(--ease), box-shadow .25s var(--ease);
        }
        .unit-search-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 22px rgba(46,125,50,.3); color: #fff; }
        .unit-search-reset {
            font-size: 0.82rem; color: var(--sbm-oren); text-decoration: none; font-weight: 600;
            display: inline-flex; align-items: center; gap: 4px; margin-top: 12px;
        }
        .unit-search-reset:hover { text-decoration: underline; color: var(--sbm-oren); }
        .unit-search-info { font-size: 0.85rem; color: #6b7280; margin-top: 10px; }

        /* ============================================================
           KETERSEDIAAN
           ============================================================ */
        .avail-card {
            position: relative;
            background: linear-gradient(180deg, rgba(255,255,255,0.96) 0%, rgba(245,250,255,0.92) 100%);
            backdrop-filter: blur(18px);
            border-radius: var(--radius-xl); padding: 34px 30px 30px;
            min-height: 320px; height: 100%;
            border: none;
            box-shadow: 0 24px 60px rgba(99,102,241,0.12), 0 8px 18px rgba(0,0,0,0.08);
            transition: all .4s var(--ease);
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }
        .avail-card::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 24px;
            width: 72px;
            height: 6px;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(46,125,50,0.95), rgba(200,90,23,0.95));
            box-shadow: 0 10px 20px rgba(46,125,50,0.18);
        }
        .avail-card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 30px 80px rgba(46,125,50,0.18), 0 12px 24px rgba(0,0,0,0.1);
            background: linear-gradient(180deg, rgba(255,255,255,1), rgba(241,249,241,1));
        }
        .avail-card h5 {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-weight: 800;
            color: var(--sbm-hijau-dark);
            margin-bottom: 0.85rem;
            letter-spacing: 0.02em;
        }
        .avail-card p {
            color: #4b5b50;
            line-height: 1.8;
            font-size: 0.97rem;
        }
        .avail-card .badge {
            background: linear-gradient(135deg, var(--sbm-hijau), var(--sbm-oren));
            color: white;
            box-shadow: 0 12px 24px rgba(46,125,50,0.18);
        }
        .avail-card a.btn {
            background: linear-gradient(135deg, var(--sbm-hijau), #4f9a51);
            border: none;
            color: white !important;
            box-shadow: 0 14px 30px rgba(46,125,50,0.22);
        }
        .avail-card a.btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 36px rgba(46,125,50,0.28);
        }
        #ketersediaan {
            background-image: radial-gradient(circle at 90% 15%, rgba(46,125,50,0.08), transparent 20%),
                              radial-gradient(circle at 15% 70%, rgba(200,90,23,0.08), transparent 18%);
        }
        #ketersediaan .text-center h2,
        #ketersediaan .text-center p {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }
        #ketersediaan .text-center h2 {
            letter-spacing: 0.02em;
        }
        #ketersediaan .text-center p {
            color: #4b5b50;
        }

        /* ============================================================
           KONTAK & SURVEI
           ============================================================ */
        .kontak-section { position: relative; padding: 80px 0; }
        .kontak-blob { position: absolute; filter: blur(90px); z-index: 0; pointer-events: none; animation: morph 15s infinite alternate, floatAnim 10s infinite; }
        .kontak-blob-1 { width: 400px; height: 400px; background: rgba(46,125,50,0.12); top: -20px; left: -150px; }
        .kontak-blob-2 { width: 350px; height: 350px; background: rgba(244,162,97,0.12); bottom: 0px; right: -100px; animation-delay: -5s; }
        .kontak-section .container { position: relative; z-index: 1; }

        .survey-card {
            border-radius: var(--radius-xl); overflow: hidden; background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.6);
            box-shadow: 0 40px 80px rgba(0,0,0,0.08); position: relative;
        }
        .survey-card-accent { height: 8px; width: 100%; background: linear-gradient(90deg, var(--sbm-hijau), var(--sbm-peach), var(--sbm-oren)); }
        .survey-card-body { padding: 45px; }
        
        .survey-card-body .form-control, .survey-card-body textarea.form-control {
            border: 2px solid var(--sbm-line); border-radius: var(--radius-sm);
            padding: 14px 18px; font-size: 0.95rem; background: rgba(250, 252, 250, 0.8);
            transition: all .3s; font-weight: 500;
        }
        .survey-card-body .form-control:focus {
            border-color: var(--sbm-peach); background: #fff;
            box-shadow: 0 10px 20px rgba(244, 162, 97, 0.15); transform: translateY(-2px);
        }
        
        .survey-submit-btn {
            background: linear-gradient(135deg, var(--sbm-hijau) 0%, #4F9A51 100%);
            border: none; color: white; font-weight: 800; letter-spacing: 0.05em;
            padding: 16px 36px; border-radius: 999px; font-size: 1.05rem;
            box-shadow: var(--shadow-glow-hijau); transition: all .3s var(--ease);
            position: relative; overflow: hidden;
        }
        .survey-submit-btn:hover { transform: translateY(-3px); box-shadow: 0 25px 50px rgba(46, 125, 50, 0.4); color: white; }

        .contact-mini-card {
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px);
            border-radius: var(--radius-md); padding: 26px; height: 100%;
            border: 1px solid rgba(255,255,255,0.8); border-left: 5px solid var(--sbm-hijau);
            box-shadow: var(--shadow-soft); transition: all .3s var(--ease);
        }
        .contact-mini-card.accent-oren { border-left-color: var(--sbm-oren); }
        .contact-mini-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lift); background: #fff; }

        .agent-card {
            border-radius: var(--radius-xl); overflow: hidden; background: #fff;
            box-shadow: 0 30px 60px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.5);
            transition: transform 0.4s;
        }
        .agent-card:hover { transform: translateY(-10px); box-shadow: 0 40px 80px rgba(0,0,0,0.15); }
        .agent-card-header {
            background: linear-gradient(135deg, var(--sbm-hijau) 0%, #205c23 100%);
            padding: 35px 30px; color: #fff; display: flex; align-items: center; gap: 20px;
            position: relative; overflow: hidden;
        }
        .agent-card-header::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 90% 10%, rgba(255,255,255,0.15), transparent 50%);
        }
        .agent-avatar {
            width: 70px; height: 70px; border-radius: 50%;
            background: linear-gradient(135deg, var(--sbm-oren), #f57f30);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.8rem;
            flex-shrink: 0; position: relative; z-index: 1; border: 3px solid rgba(255,255,255,0.8);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .agent-card-body { padding: 35px 30px; }
        .agent-list-item { display: flex; gap: 16px; align-items: center; padding: 12px 0; border-bottom: 1px dashed var(--sbm-line); }
        .agent-list-item:last-child { border-bottom: none; }
        .agent-icon-box {
            width: 46px; height: 46px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            box-shadow: 0 8px 16px rgba(0,0,0,0.06);
        }

        /* ============================================================
           CHATBOT
           ============================================================ */
        .chatbot-button {
            position: fixed; right: 26px; bottom: 26px; width: 72px; height: 72px; border-radius: 50%;
            background: linear-gradient(135deg, #22c55e 0%, #f97316 55%, #ec4899 100%);
            color: white; border: none; box-shadow: 0 24px 60px rgba(235, 87, 87, 0.28);
            cursor: pointer; z-index: 1060; display: grid; place-items: center; padding: 0;
            transition: all .3s var(--ease); animation: floatAnim 4s ease-in-out infinite;
        }
        .chatbot-button svg { width: 1.9rem; height: 1.9rem; stroke: white; stroke-width: 2; fill: currentColor; }
        .chatbot-button:hover { transform: scale(1.08); box-shadow: 0 32px 70px rgba(235, 87, 87, 0.35); animation-play-state: paused; }

        .chatbot-panel {
            position: fixed; right: 26px; bottom: 110px; width: min(400px, calc(100% - 52px)); max-height: 600px;
            background: #fff; border-radius: 28px; box-shadow: 0 30px 80px rgba(0,0,0,0.25);
            z-index: 1050; display: none; flex-direction: column; overflow: hidden; border: 1px solid var(--sbm-line);
        }
        .chatbot-panel.open { display: flex; animation: fadeUp 0.4s var(--ease) both; }
        .chatbot-header {
            background: linear-gradient(135deg, var(--sbm-hijau) 0%, #3f8a43 100%); color: white;
            padding: 20px 24px; display: flex; align-items: center; gap: 14px;
        }
        .chatbot-header .bot-avatar {
            width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.12));
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.5);
        }
        .chatbot-header .bot-meta { flex: 1; }
        .chatbot-header strong { font-size: 1.05rem; display: block; letter-spacing: 0.02em; }
        .chatbot-header .bot-status { font-size: 0.75rem; color: rgba(255,255,255,0.9); display: flex; align-items: center; gap: 6px; }
        .chatbot-header .bot-status::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: #7ee08b; display: inline-block; box-shadow: 0 0 8px #7ee08b; }
        .chatbot-close-btn { background: rgba(255,255,255,0.1); border: none; color: white; width: 32px; height: 32px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; }
        .chatbot-close-btn:hover { background: rgba(255,255,255,0.3); transform: rotate(90deg); }

        .chatbot-body { padding: 20px; flex: 1; overflow-y: auto; background: #f4f7f4; }
        .chatbot-message { margin-bottom: 16px; display: flex; align-items: flex-end; gap: 10px; }
        .chatbot-message.user { justify-content: flex-end; }
        .chatbot-message.bot { justify-content: flex-start; }
        .chatbot-message .mini-avatar {
            width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, var(--sbm-hijau), #4F9A51); color: white;
            display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800;
        }
        .bubble { display: inline-block; max-width: 80%; padding: 14px 18px; line-height: 1.5; font-size: 0.95rem; box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
        .chatbot-message.bot .bubble { background: #fff; color: var(--sbm-ink); border-radius: 6px 20px 20px 20px; border: 1px solid var(--sbm-line); }
        .chatbot-message.user .bubble { background: linear-gradient(135deg, var(--sbm-oren), #d97024); color: #fff; border-radius: 20px 6px 20px 20px; }

        .chatbot-footer { padding: 16px 20px 20px; border-top: 1px solid var(--sbm-line); display: flex; gap: 12px; align-items: center; background: #fff; }
        .chatbot-footer input { flex: 1; border: 2px solid var(--sbm-line); border-radius: 999px; padding: 14px 20px; outline: none; background: #f9fbf9; font-size: 0.95rem; transition: 0.3s; }
        .chatbot-footer input:focus { border-color: var(--sbm-hijau); background: #fff; box-shadow: 0 5px 15px rgba(46,125,50,0.1); }
        .chatbot-footer button {
            border: none; background: linear-gradient(135deg, var(--sbm-oren), #a8460d); color: white;
            width: 48px; height: 48px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            box-shadow: 0 10px 20px rgba(200,90,23,0.2); transition: 0.3s;
        }
        .chatbot-footer button:hover { transform: scale(1.1); box-shadow: 0 15px 25px rgba(200,90,23,0.3); }

        .footer-sbm { background: linear-gradient(180deg, var(--sbm-hijau-dark) 0%, #0a1c0c 100%); color: rgba(255,255,255,0.85); padding: 70px 0 30px; position: relative; overflow: hidden; }
        .footer-brand { font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.8rem; letter-spacing: 3px; color: #fff; text-shadow: 0 0 20px rgba(255,255,255,0.2); }
        .footer-tagline { font-size: 0.95rem; color: rgba(255,255,255,0.7); max-width: 450px; margin: 15px auto 0; font-weight: 300; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.1); margin: 40px 0 25px; }
        .footer-copy { font-size: 0.85rem; color: rgba(255,255,255,0.4); letter-spacing: 0.05em; }

        @media (max-width: 992px) {
            .hero-section { padding-top: 130px; background-attachment: scroll; }
            .hero-inner { padding-bottom: 70px; }
            .hero-title { font-size: clamp(2.2rem, 7vw, 3.4rem); }
            .hero-desc { font-size: 1rem; max-width: 100%; }
            .hero-actions { flex-direction: column; gap: 0.8rem; }
            .btn-hero-solid, .btn-hero-outline { min-width: auto; width: 100%; padding: 14px 20px; }
            .hero-stats { flex-direction: column; align-items: stretch; gap: 18px; }
            .hero-stat-card { max-width: none; }
            .chip-row { flex-direction: column; align-items: stretch; gap: 12px; }
            .info-chip { justify-content: center; }
            .feature-card, .avail-card, .unit-card, .survey-card, .agent-card { border-radius: 28px; }
            .feature-card { padding: 30px 24px; }
            .unit-card { padding-bottom: 0; }
            .unit-card-img-wrap { aspect-ratio: 4 / 3; }
            .avail-card { padding: 28px 24px; min-height: auto; }
            .agent-card-header { flex-direction: column; align-items: flex-start; padding: 28px 24px; }
            .agent-card-body { padding: 28px 24px; }
            .agent-list-item { gap: 12px; }
            .chatbot-button { right: 18px; bottom: 18px; width: 60px; height: 60px; }
            .chatbot-button svg { width: 1.6rem; height: 1.6rem; }
            .chatbot-panel { right: 16px; bottom: 100px; width: calc(100% - 32px); max-height: calc(100vh - 110px); border-radius: 24px; }
            .chatbot-body { max-height: 300px; }
            .chatbot-footer { flex-direction: column; align-items: stretch; padding: 14px 16px 18px; }
            .chatbot-footer input { width: 100%; }
            .chatbot-footer button { width: 100%; border-radius: 20px; }
            .navbar-collapse { background: rgba(255,255,255,0.98); box-shadow: 0 20px 40px rgba(0,0,0,0.08); margin-top: 10px; border-radius: 22px; }
            .navbar-nav { gap: 0.5rem; }
            .nav-link { padding: 0.85rem 1rem; border-radius: 18px; }
            .navbar-toggler { border: 1px solid rgba(23,66,26,0.12); }
            .navbar-toggler-icon { filter: invert(0.2); }
            .footer-sbm { padding: 60px 0 30px; }

            .tentang-image-frame { margin: 0 10px; }
            .floating-badge { padding: 13px 18px; gap: 12px; }

            .unit-search-box { flex-wrap: wrap; padding: 14px 18px; border-radius: 22px; }
            .unit-search-input { flex-basis: 100%; padding: 8px 0; }
            .unit-search-btn { width: 100%; }
        }

        @media (max-width: 576px) {
            .navbar-sbm { padding: 12px 0; }
            .sbm-desc { display: none; }
            .hero-section { padding-top: 120px; }
            .hero-pill { padding: 0.85rem 1.4rem; font-size: 0.88rem; }
            .hero-title { font-size: clamp(1.95rem, 10vw, 2.4rem); }
            .hero-desc { line-height: 1.75; }
            .hero-actions { gap: 0.75rem; }
            .hero-stats { margin-top: 50px; }
            .feature-card, .avail-card, .unit-card, .survey-card { padding: 24px 20px; }
            .feature-icon-wrapper { width: 54px; height: 54px; }
            .unit-card-img-wrap { aspect-ratio: 16 / 10; }
            .unit-type-badge { top: 14px; left: 14px; padding: 7px 14px; }
            .avail-card::before { left: 18px; width: 60px; }
            .kontak-section { padding: 60px 0; }
            .footer-sbm { padding: 50px 0 24px; }
            .footer-brand { font-size: 1.45rem; }
            .chatbot-panel { max-height: calc(100vh - 130px); }
            .navbar-collapse { margin-top: 8px; }
            .nav-link { padding-left: 1rem; padding-right: 1rem; }

            .tentang-image-frame { margin: 0 12px; }
            .floating-badge {
                padding: 10px 14px;
                gap: 10px;
                border-radius: var(--radius-md);
            }
            .floating-badge.badge-1 { top: -12px; right: -8px; }
            .floating-badge.badge-2 { bottom: -12px; left: -8px; }
            .floating-badge .icon-box { width: 40px; height: 40px; border-radius: 12px; }
            .floating-badge strong { font-size: 0.85rem; }
            .floating-badge small { font-size: 0.66rem !important; }

            .modal-body { padding: 1.25rem !important; }
            .modal-header, .modal-footer { padding: 1.25rem !important; }
            .modal-footer { flex-direction: column; align-items: stretch; gap: 12px; }
            .modal-footer > div { text-align: center; }
            .modal-footer a.btn { width: 100%; text-align: center; }
        }

        img, svg { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <div id="top"></div>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top navbar-sbm" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand sbm-brand-container" href="#top">
                <svg class="sbm-roof" width="54" height="17" viewBox="0 0 54 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <polyline points="2,15 27,2 52,15" stroke="url(#sbmRoofGrad)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    <defs>
                        <linearGradient id="sbmRoofGrad" x1="2" y1="0" x2="52" y2="0" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#2E7D32"></stop>
                            <stop offset="1" stop-color="#C85A17"></stop>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="sbm-text"><span class="text-hijau">S</span><span class="text-oren">B</span><span class="text-hijau">M</span></div>
                <div class="sbm-desc">SWARGA BOEMI MADANI</div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#top">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#unit-rumah">Tipe Rumah</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ketersediaan">Ketersediaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <a href="#kontak" class="btn btn-oren-solid px-4 py-2 rounded-pill fw-bold mt-3 mt-lg-0 shadow-sm text-decoration-none">Ajukan Survei</a>
            </div>
        </div>
    </nav>

    <!-- ================= HERO SECTION ================= -->
    <section class="hero-section">
        <div class="container hero-inner">
            <div class="hero-pill">Promo spesial: DP mulai 5% + gratis biaya notaris</div>

            <h1 class="hero-title">
                Rumah Idaman di<br>
                <span class="text-gradient">Swarga Boemi Madani</span>
            </h1>
            <p class="hero-desc">
                Swarga Boemi Madani Residence adalah hunian idaman di Jalan Merbabu, Wero, Gombong. Kami hadir untuk menyediakan lingkungan modern, aman, dan nyaman bagi tumbuh kembang keluarga.
            </p>

            <div class="hero-actions">
                <a href="#unit-rumah" class="btn btn-hero-solid">Jelajahi Tipe Rumah &rarr;</a>
                <a href="#ketersediaan" class="btn btn-hero-outline">Cek Ketersediaan</a>
                <a href="#kontak" class="btn btn-hero-outline">Ajukan Survei</a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat-card">
                    <p class="stat-number">{{ $clusters->count() }}</p>
                    <p class="stat-label mb-0">Total Unit</p>
                </div>
                <div class="hero-stat-card">
                    <p class="stat-number">{{ $clusters->where('status.name', 'Tersedia')->count() }}</p>
                    <p class="stat-label mb-0">Unit Tersedia</p>
                </div>
                <div class="hero-stat-card">
                    <p class="stat-number">{{ $clusters->pluck('type')->unique()->count() }}</p>
                    <p class="stat-label mb-0">Tipe Rumah</p>
                </div>
            </div>
        </div>

        <svg class="roofline-divider" viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,60 L0,40 L120,10 L240,40 L360,14 L480,40 L600,10 L720,40 L840,14 L960,40 L1080,10 L1200,40 L1320,14 L1440,40 L1440,60 Z"></path>
        </svg>
    </section>

    <!-- ================= TENTANG SECTION ================= -->
    <section id="tentang" class="py-5 tentang-section">
        <div class="tentang-blob tentang-blob-1"></div>
        <div class="tentang-blob tentang-blob-2"></div>
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 pe-lg-5 reveal">
                    <h6 class="eyebrow text-oren">TENTANG KAWASAN</h6>
                    <h2 class="display-5 fw-bold text-hijau mb-4">
                        Swarga Boemi Madani Residence: <br> Smart & Comfort Living
                    </h2>
                    <p class="text-secondary mb-4" style="line-height: 1.8;">
                        Kawasan perumahan kami dirancang untuk memberikan kenyamanan dan fungsionalitas, menggabungkan kualitas bangunan unggul dengan dukungan fasilitas yang ramah keluarga.
                    </p>
                    <p class="text-secondary mb-0" style="line-height: 1.8;">
                        Dikembangkan oleh tim arsitek berpengalaman, setiap unit SBM dibangun dengan standar konstruksi tinggi, material anti-gempa, dan finishing premium yang tahan lama.
                    </p>

                    <div class="chip-row mt-4">
                        <span class="info-chip hijau"><span class="dot"></span> 4,2 Hektar Kawasan</span>
                        <span class="info-chip oren"><span class="dot"></span> Smart Home Ready</span>
                        <span class="info-chip peach"><span class="dot"></span> Green Living Concept</span>
                    </div>
                </div>

                <div class="col-lg-6 position-relative reveal" style="--d: 150ms;">
                    <div class="tentang-image-frame">
                        <img src="https://images.unsplash.com/photo-1613490908592-5d8f6c5bb020?auto=format&fit=crop&w=800&q=80" alt="Kawasan SBM">
                    </div>

                    <div class="floating-badge badge-1">
                        <div class="icon-box">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                        </div>
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.72rem;">Rating Kepuasan</small>
                            <strong class="mb-0 fs-6 text-ink">4.9 / 5.0 ⭐</strong>
                        </div>
                    </div>

                    <div class="floating-badge badge-2">
                        <div class="icon-box">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.72rem;">Sertifikasi</small>
                            <strong class="mb-0 fs-6 text-ink">SHM Pecah Per Unit</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FITUR / KEUNGGULAN ================= -->
    <section class="py-5 pb-5 position-relative bg-white">
        <div class="container py-4">
            <div class="text-center mb-5 reveal">
                <h6 class="eyebrow text-hijau justify-content-center">KEUNGGULAN</h6>
                <h2 class="fw-bold text-hijau">Mengapa Memilih SBM</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4 reveal" style="--d: 0ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Desain Modern Tropis</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Fasad kontemporer dengan sentuhan tropis, ventilasi silang optimal, dan material premium tahan cuaca.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="--d: 100ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Area Hijau &amp; Taman</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Kesejukan dari deretan pepohonan rindang di dalam perumahan yang berpadu sempurna dengan hamparan persawahan alami di sekitarnya. Udara segar setiap hari untuk Anda dan keluarga.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="--d: 200ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Keamanan Terpadu</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Sistem One Gate System dengan keamanan 24 jam penuh, serta kelengkapan Smart Lock Door pada unit rumah.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="--d: 0ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Fasilitas Lengkap</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Tersedia Minimarket, Free Shuttle Car, dan fasilitas Town Management Office untuk melayani kebutuhan warga.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="--d: 100ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Infrastruktur Digital</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Fiber optic 1 Gbps ke setiap unit, smart gate terintegrasi.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="--d: 200ms;">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-3">Lingkungan & Infrastruktur</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">Lokasi yang strategis dengan infrastruktur Jalan Utama selebar 9 meter yang melegakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= TIPE UNIT RUMAH (dengan SEARCH) ================= -->
    <section id="unit-rumah" class="py-5" style="background-color: var(--sbm-bg);">
        <div class="container py-5">
            <div class="text-center mb-4 reveal">
                <h6 class="eyebrow text-oren justify-content-center">PILIHAN HUNIAN</h6>
                <h2 class="fw-bold text-hijau">Unit Swarga Boemi Madani Residence</h2>
                <p class="text-muted">Pilih tipe rumah yang paling sesuai dengan kebutuhan Anda.</p>
            </div>

            {{-- ============= KOTAK SEARCH TIPE UNIT ============= --}}
            <div class="text-center mb-5 reveal">
                <form method="GET" action="{{ url()->current() }}#unit-rumah" class="unit-search-form mx-auto">
                    <div class="unit-search-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path stroke-linecap="round" d="M21 21l-4.3-4.3"></path>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="unit-search-input"
                            placeholder="Cari tipe unit, misal: 36/72..."
                            aria-label="Cari tipe unit"
                        >
                        <button type="submit" class="unit-search-btn">Cari</button>
                    </div>
                </form>

                @if(!empty($search))
                    <a href="{{ url()->current() }}#unit-rumah" class="unit-search-reset">
                        &times; Hapus pencarian "{{ $search }}"
                    </a>
                @else
                    <p class="unit-search-info mb-0">Contoh: ketik "36/72", "Type A", atau nama cluster.</p>
                @endif
            </div>

            <div class="row g-4">
                @forelse($filteredClusters as $cluster)
                    @php
                        $clusterImage = $cluster->image_url
                            ? (
                                Illuminate\Support\Str::startsWith($cluster->image_url, ['http://', 'https://'])
                                ? $cluster->image_url
                                : asset('storage/' . $cluster->image_url)
                              )
                            : 'https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=500&q=80';
                    @endphp
                    <div class="col-md-4 reveal" style="--d: {{ $loop->index * 60 }}ms;">
                        <div class="card unit-card">
                            <div class="unit-card-img-wrap">
                                <img src="{{ $clusterImage }}" alt="{{ $cluster->name }}">
                                <span class="badge bg-hijau unit-type-badge text-white">{{ $cluster->type }}</span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h4 class="card-title fw-bold">{{ $cluster->name }}</h4>
                                <p class="card-text text-muted small mb-3">{{ \Illuminate\Support\Str::limit($cluster->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <h5 class="fw-bold text-oren mb-0">Rp {{ number_format($cluster->price, 0, ',', '.') }}</h5>
                                    <button class="btn btn-sm text-white fw-bold px-3 py-1" style="background: var(--sbm-hijau); border-radius: 999px;" data-bs-toggle="modal" data-bs-target="#detail-{{ $cluster->id }}">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center rounded-4 py-4 border-0 shadow-sm">
                            @if(!empty($search))
                                Tidak ditemukan unit dengan kata kunci "<strong>{{ $search }}</strong>". Coba kata kunci lain, misalnya tipe atau nama cluster.
                            @else
                                Informasi unit belum tersedia saat ini. Silakan cek kembali nanti.
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= KETERSEDIAAN ================= -->
    <section id="ketersediaan" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h6 class="eyebrow text-hijau justify-content-center">STATUS UNIT</h6>
                <h2 class="fw-bold text-hijau">Ketersediaan Unit</h2>
                <p class="text-muted">Pantau terus status ketersediaan unit terbaru.</p>
            </div>

            <div class="row g-4">
                @forelse($clusters as $cluster)
                    <div class="col-md-4 reveal" style="--d: {{ $loop->index * 60 }}ms;">
                        <div class="avail-card d-flex flex-column">
                            <h5 class="fw-bold mb-3">{{ $cluster->name }}</h5>
                            <p class="text-secondary small mb-2">{{ $cluster->type }}</p>
                            <p class="mb-4">{{ \Illuminate\Support\Str::limit($cluster->feature_summary ?: $cluster->description, 110) }}</p>
                            <div class="mt-auto">
                                <span class="badge {{ $cluster->status->badge_class }} status-badge">{{ $cluster->status->name }}</span>
                                <a href="#detail-{{ $cluster->id }}" class="btn btn-sm btn-outline-success rounded-pill px-3 mt-3 d-block w-100" data-bs-toggle="modal" data-bs-target="#detail-{{ $cluster->id }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center border-0 shadow-sm rounded-4 py-4">Informasi ketersediaan unit belum tersedia saat ini. Silakan cek kembali nanti.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= KONTAK & SURVEI ================= -->
    <section id="kontak" class="py-5 kontak-section">
        <div class="kontak-blob kontak-blob-1"></div>
        <div class="kontak-blob kontak-blob-2"></div>
        <div class="container py-5">
            <div class="row align-items-start g-5">
                @php
                    $agentPhone = $agent && $agent->phone ? preg_replace('/[^0-9+]/', '', $agent->phone) : '6281320625222';
                    $agentWhatsapp = $agent && $agent->whatsapp ? preg_replace('/[^0-9]/', '', $agent->whatsapp) : '6281320625222';
                    $agentEmail = $agent && $agent->email ? $agent->email : 'info@sbm.co.id';
                    $agentAddress = $agent && $agent->address ? $agent->address : 'Jl. Merbabu, Desa Wero, Kec.Gombong, Kebumen, Jawa Tengah';
                    $agentMapLink = $agent && $agent->map_link ? $agent->map_link : 'https://maps.app.goo.gl/PXHiRyygBGqvGY3YA';
                    $agentNameDisplay = $agent && $agent->name ? $agent->name : 'Fajar Santoso';
                    $agentScheduleDisplay = $agent && $agent->schedule ? $agent->schedule : 'Senin - Sabtu, 09.00 - 17.00';
                    $agentPromoDisplay = $agent && $agent->promo ? $agent->promo : 'DP mulai 5%, gratis biaya KPR & notaris';
                    $agentPhoneDisplay = $agent && $agent->phone ? $agent->phone : '+62 813-2062-5222';
                @endphp

                <div class="col-lg-7">
                    <div class="survey-card mb-4 reveal">
                        <div class="survey-card-accent"></div>
                        <div class="survey-card-body">
                            <h5 class="fw-bold mb-2 text-hijau">Ajukan Survei Unit</h5>
                            <p class="text-muted mb-4">Isi formulir berikut untuk mengajukan survei unit langsung di lokasi perumahan SBM.</p>

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif

                            <form method="POST" action="{{ route('survey-submissions.store') }}">
                                @csrf
                                <input type="text" name="hp_name" value="" style="display:none !important; visibility:hidden;" autocomplete="off">
                                <input type="hidden" name="ts" value="{{ now()->timestamp }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-ink fw-semibold" style="font-size:0.85rem;">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-ink fw-semibold" style="font-size:0.85rem;">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-ink fw-semibold" style="font-size:0.85rem;">Nomor Telepon</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-ink fw-semibold" style="font-size:0.85rem;">Jadwal Pilihan</label>
                                        <input type="text" name="preferred_schedule" class="form-control" value="{{ old('preferred_schedule') }}" placeholder="Contoh: Sabtu, 10:00">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-ink fw-semibold" style="font-size:0.85rem;">Catatan Tambahan</label>
                                        <textarea name="notes" class="form-control" rows="3" placeholder="Ceritakan kebutuhan Anda, tipe rumah, atau pertanyaan lain.">{{ old('notes') }}</textarea>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="survey-submit-btn">Kirim Pengajuan Survei</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="reveal" style="--d: 100ms;">
                        <h6 class="eyebrow text-oren mt-2">HUBUNGI KAMI</h6>
                        <h2 class="fw-bold text-hijau">Butuh Info lebih lanjut?</h2>
                        <p class="text-secondary mb-4" style="line-height: 1.8;">Tim sales SBM siap membantu dengan informasi unit, harga, simulasi angsuran, dan jadwal kunjungan show unit.</p>
                        
                        <div class="row gy-3 mt-1">
                            <div class="col-12 col-md-6">
                                <div class="contact-mini-card">
                                    <h6 class="fw-bold mb-2 text-ink">Alamat</h6>
                                    <p class="small text-muted mb-0" style="line-height: 1.6;">{{ $agentAddress }}</p>
                                    <a href="{{ $agentMapLink }}" target="_blank" class="small text-oren d-inline-block mt-2 fw-semibold">Lihat di Maps &rarr;</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="contact-mini-card accent-oren">
                                    <h6 class="fw-bold mb-2 text-ink">Kontak</h6>
                                    <p class="small text-muted mb-1">Telepon: <a href="tel:{{ $agentPhone }}" class="text-hijau text-decoration-none">{{ $agentPhoneDisplay }}</a></p>
                                    <p class="small text-muted mb-1">WhatsApp: <a href="https://wa.me/{{ $agentWhatsapp }}" target="_blank" class="text-hijau text-decoration-none">Chat Sales</a></p>
                                    <p class="small text-muted mb-0">Email: <a href="mailto:{{ $agentEmail }}" class="text-hijau text-decoration-none">{{ $agentEmail }}</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="mailto:{{ $agentEmail }}" class="btn btn-hero-solid me-3" style="box-shadow: 0 16px 30px rgba(15,47,17,.18);">Kirim Email</a>
                            <a href="https://wa.me/{{ $agentWhatsapp }}" target="_blank" class="btn btn-hero-outline" style="color: var(--sbm-hijau); border-color: var(--sbm-hijau); background: transparent;">Hubungi WA</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 reveal" style="--d: 200ms;">
                    <div class="agent-card">
                        <div class="agent-card-header">
                            <div class="agent-avatar">{{ strtoupper(substr($agentNameDisplay, 0, 1)) }}</div>
                            <div style="position: relative; z-index: 1;">
                                <p class="fw-bold mb-0 fs-5">{{ $agentNameDisplay }}</p>
                                <p class="mb-0" style="font-size: 0.8rem; opacity: 0.9;">Sales Consultant SBM</p>
                            </div>
                        </div>
                        <div class="agent-card-body">
                            <div class="agent-list-item">
                                <div class="agent-icon-box" style="background: var(--sbm-hijau-light); color: var(--sbm-hijau);">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <strong class="d-block text-ink">Nama Sales</strong>
                                    <span class="text-muted small">{{ $agentNameDisplay }}</span>
                                </div>
                            </div>
                            <div class="agent-list-item">
                                <div class="agent-icon-box" style="background: var(--sbm-oren-light); color: var(--sbm-oren);">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <strong class="d-block text-ink">Jadwal Kunjungan</strong>
                                    <span class="text-muted small">{{ $agentScheduleDisplay }}</span>
                                </div>
                            </div>
                            <div class="agent-list-item">
                                <div class="agent-icon-box" style="background: var(--sbm-peach-light); color: #9A5A22;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <div>
                                    <strong class="d-block text-ink">Info Promo</strong>
                                    <span class="text-muted small">{{ $agentPromoDisplay }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= MODAL DETAIL UNIT ================= -->
    @foreach($clusters as $cluster)
        <div class="modal fade" id="detail-{{ $cluster->id }}" tabindex="-1" aria-labelledby="detail-{{ $cluster->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                    <div class="modal-header border-0 bg-light p-4 pb-3">
                        <div>
                            <span class="badge bg-hijau mb-2 px-3 py-2 rounded-pill">{{ $cluster->type }}</span>
                            <h5 class="modal-title fw-bold text-ink" id="detail-{{ $cluster->id }}Label">{{ $cluster->name }} - {{ $cluster->type }}</h5>
                            <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($cluster->description, 80) }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 pt-2">
                        <div class="row g-4 align-items-center">
                            @php
                                $clusterImageModal = $cluster->image_url
                                    ? (Illuminate\Support\Str::startsWith($cluster->image_url, ['http://', 'https://']) ? $cluster->image_url : asset('storage/' . $cluster->image_url))
                                    : 'https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <div class="col-md-6">
                                <img src="{{ $clusterImageModal }}" class="img-fluid rounded-4 shadow-sm" alt="{{ $cluster->name }}">
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-4 rounded-4 h-100">
                                    <h6 class="text-oren fw-bold mb-3">Spesifikasi</h6>
                                    <ul class="list-unstyled text-ink mb-4 small d-flex flex-column gap-2">
                                        <li class="d-flex justify-content-between border-bottom pb-1"><span>Luas tanah</span> <strong>{{ $cluster->land_area }} m²</strong></li>
                                        <li class="d-flex justify-content-between border-bottom pb-1"><span>Luas bangunan</span> <strong>{{ $cluster->building_area }} m²</strong></li>
                                        <li class="d-flex justify-content-between border-bottom pb-1"><span>Kamar Tidur</span> <strong>{{ $cluster->bedrooms }}</strong></li>
                                        <li class="d-flex justify-content-between border-bottom pb-1"><span>Kamar Mandi</span> <strong>{{ $cluster->bathrooms }}</strong></li>
                                        <li class="d-flex justify-content-between border-bottom pb-1"><span>Carport</span> <strong>{{ $cluster->carport }} mobil</strong></li>
                                        <li class="d-flex justify-content-between pb-1"><span>Status:</span> <strong>{{ $cluster->status->name }}</strong></li>
                                    </ul>
                                    <h6 class="text-oren fw-bold mb-2">Fitur Unggulan</h6>
                                    <p class="text-muted small" style="line-height: 1.6;">{{ $cluster->feature_summary ?: $cluster->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0 p-4 pt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block small text-muted fw-bold">Harga</span>
                            <h4 class="fw-bold text-oren mb-0">Rp {{ number_format($cluster->price, 0, ',', '.') }}</h4>
                        </div>
                        <a href="https://wa.me/{{ $agentWhatsapp }}" target="_blank" class="btn text-white fw-bold px-4 py-2 rounded-pill shadow-sm" style="background: var(--sbm-hijau);">Hubungi Sales</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- ================= CHATBOT WIDGET ================= -->
    <button class="chatbot-button" id="chatbotToggle" aria-label="Buka chatbot">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4 5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v11a3 3 0 0 1-3 3H8l-4 4V5Z" />
            <path d="M9 8h6M9 12h4" stroke="white" stroke-linecap="round" fill="none" />
            <path d="M7 16h.01M12 16h.01M17 16h.01" stroke="white" stroke-linecap="round" fill="none" />
        </svg>
    </button>
    <div class="chatbot-panel" id="chatbotPanel" role="dialog" aria-label="Chatbot informasi SBM">
        <div class="chatbot-header">
            <div class="bot-avatar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 5v2M12 17v2M5 12h2M17 12h2M7.5 7.5l1.5 1.5M15 15l1.5 1.5M7.5 16.5l1.5-1.5M15 8l1.5-1.5" />
                </svg>
            </div>
            <div class="bot-meta">
                <strong>Chatbot SBM</strong>
                <span class="bot-status">Online</span>
            </div>
            <button id="chatbotClose" class="chatbot-close-btn">×</button>
        </div>
        <div class="chatbot-body" id="chatbotBody">
            <div class="chatbot-message bot">
                <div class="mini-avatar">S</div>
                <div class="bubble">Halo! Saya asisten SBM yang siap membantu Anda. Silakan tanya tentang harga, tipe unit, ketersediaan, atau kontak agen.</div>
            </div>
        </div>
        <div class="chatbot-footer">
            <input id="chatbotInput" type="text" placeholder="Tulis pesan Anda..." aria-label="Pesan chatbot">
            <button id="chatbotSend" type="button" aria-label="Kirim pesan">
                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"></path></svg>
            </button>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="footer-sbm text-center">
        <div class="container">
            <div class="footer-brand">SWARGA BOEMI MADANI Residence</div>
            <p class="footer-tagline">Hunian modern— Smart & Comfort Living.</p>
            <div class="footer-divider"></div>
            <p class="footer-copy mb-0">&copy; {{ date('Y') }} Swarga Boemi Madani. Ernesya Fatimah Zahra.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @php
        $availableUnits = $clusters->where('status.name', 'Tersedia')->count();
        $chatAgentName = $agentNameDisplay;
        $chatAgentPhone = $agentPhoneDisplay;
        $chatAgentWhatsapp = $agentWhatsapp;
        $chatAgentEmail = $agentEmail;
        $chatAgentSchedule = $agentScheduleDisplay;
        $chatAgentPromo = $agentPromoDisplay;
        $chatAgentAddress = $agentAddress;
        $chatAgentMapLink = $agentMapLink;
    @endphp
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /* ---------- Navbar glass on scroll ---------- */
            const navbar = document.getElementById('mainNavbar');
            function updateNavbar() {
                if (window.scrollY > 40) {
                    navbar.classList.add('is-scrolled');
                } else {
                    navbar.classList.remove('is-scrolled');
                }
            }
            window.addEventListener('scroll', updateNavbar);
            updateNavbar();

            /* ---------- Scroll reveal ---------- */
            const revealEls = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
                revealEls.forEach(el => observer.observe(el));
            } else {
                revealEls.forEach(el => el.classList.add('is-visible'));
            }

            /* ---------- Navbar active link on scroll ---------- */
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            const sections = document.querySelectorAll('section[id], #top');

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(navbarCollapse).hide();
                    }
                });
            });

            function updateActiveLink() {
                const scrollPosition = window.scrollY + 140;
                navLinks.forEach(link => link.classList.remove('active'));

                let activeLink = navLinks[0];
                sections.forEach(section => {
                    const target = section.id ? section.id : 'top';
                    const link = document.querySelector(`.navbar-nav .nav-link[href="#${target}"]`);
                    if (!link) return;
                    if (section.offsetTop <= scrollPosition) {
                        activeLink = link;
                    }
                });

                if(activeLink) activeLink.classList.add('active');
            }

            window.addEventListener('scroll', updateActiveLink);
            updateActiveLink();

            /* ---------- Chatbot Logic ---------- */
            const chatbotToggle = document.getElementById('chatbotToggle');
            const chatbotPanel = document.getElementById('chatbotPanel');
            const chatbotClose = document.getElementById('chatbotClose');
            const chatbotSend = document.getElementById('chatbotSend');
            const chatbotInput = document.getElementById('chatbotInput');
            const chatbotBody = document.getElementById('chatbotBody');

            const clusterNames = [
                @foreach($clusters as $cluster)
                    "{{ addslashes($cluster->name) }}"@if(!$loop->last),@endif
                @endforeach
            ];
            const clusterPrices = [
                @foreach($clusters as $cluster)
                    { name: "{{ addslashes($cluster->name) }}", price: "{{ number_format($cluster->price, 0, ',', '.') }}" }@if(!$loop->last),@endif
                @endforeach
            ];
            const availableUnits = {{ (int) $availableUnits }};
            const agentContact = {
                name: "{{ addslashes($chatAgentName) }}",
                phone: "{{ addslashes($chatAgentPhone) }}",
                whatsapp: "{{ addslashes($chatAgentWhatsapp) }}",
                email: "{{ addslashes($chatAgentEmail) }}",
                schedule: "{{ addslashes($chatAgentSchedule) }}",
                promo: "{{ addslashes($chatAgentPromo) }}"
            };
            const agentAddress = "{{ addslashes($chatAgentAddress) }}";
            const agentMapLink = "{{ addslashes($chatAgentMapLink) }}";

            const keywordResponses = [
                { keywords: ['halo', 'hai', 'hi', 'hello', 'pagi', 'siang', 'sore', 'malam', 'assalamualaikum'], response: () => 'Halo! Saya siap membantu Anda seputar rumah SBM. Silakan tanyakan tentang harga, tipe unit, ketersediaan, atau kontak agen.' },
                { keywords: ['harga', 'price', 'biaya'], response: () => {
                    const sample = clusterPrices.slice(0, 3).map(item => `${item.name}: Rp ${item.price}`).join('\n');
                    return `Tentu! Berikut contoh harga unit yang tersedia:\n${sample}`;
                }},
                { keywords: ['unit', 'tipe', 'type'], response: () => {
                    return `Ada beberapa tipe rumah yang bisa dipilih. Silakan cek detail unit di halaman ini, atau saya bisa bantu arahkan ke agen untuk info lebih lengkap.`;
                }},
                { keywords: ['tersedia', 'availability', 'ketersediaan'], response: () => {
                    return `Saat ini ada ${availableUnits} unit yang tersedia. Kalau Anda mau, saya bisa bantu mencari unit yang paling sesuai dengan kebutuhan Anda.`;
                }},
                { keywords: ['whatsapp', 'wa', 'chat'], response: () => `Bisa, saya bantu menghubungkan Anda ke agen kami. Silakan klik: https://wa.me/${agentContact.whatsapp}` },
                { keywords: ['email', 'mail'], response: () => `Tentu, Anda bisa mengirim email ke ${agentContact.email}.` },
                { keywords: ['alamat', 'lokasi', 'maps'], response: () => `Alamat kami ada di ${agentAddress}. Anda juga bisa lihat peta di ${agentMapLink}.` },
                { keywords: ['promo', 'diskon', 'offer'], response: () => `Promo saat ini: ${agentContact.promo}` },
                { keywords: ['jadwal', 'visit', 'kunjungan'], response: () => `Jadwal kunjungan: ${agentContact.schedule}` },
                { keywords: ['sales', 'agen', 'kontak'], response: () => `Silakan hubungi ${agentContact.name}. Telepon: ${agentContact.phone}, Email: ${agentContact.email}` },
            ];

            function appendMessage(text, sender = 'bot') {
                const wrapper = document.createElement('div');
                wrapper.className = `chatbot-message ${sender}`;

                if (sender === 'bot') {
                    const avatar = document.createElement('div');
                    avatar.className = 'mini-avatar';
                    avatar.textContent = 'S';
                    wrapper.appendChild(avatar);
                }

                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                const urlPattern = /(https?:\/\/[^\s]+)/g;
                const parts = text.split(urlPattern);
                parts.forEach(part => {
                    if (urlPattern.test(part)) {
                        const link = document.createElement('a');
                        link.href = part;
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                        link.textContent = part;
                        link.style.color = 'inherit';
                        bubble.appendChild(link);
                    } else {
                        bubble.appendChild(document.createTextNode(part));
                    }
                });
                wrapper.appendChild(bubble);
                chatbotBody.appendChild(wrapper);
                chatbotBody.scrollTop = chatbotBody.scrollHeight;
            }

            function generateResponse(text) {
                const normalized = text.toLowerCase();
                for (const item of keywordResponses) {
                    if (item.keywords.some(keyword => normalized.includes(keyword))) {
                        return item.response();
                    }
                }
                const matchedCluster = clusterNames.find(name => normalized.includes(name.toLowerCase()));
                if (matchedCluster) {
                    return `Saya bisa bantu menjelaskan ${matchedCluster}. Silakan lihat detail unit di halaman ini, atau hubungi agen untuk info harga dan ketersediaan.`;
                }
                return `Saya belum yakin dengan pertanyaan itu, tetapi saya bisa bantu lanjut ke agen kami melalui WhatsApp: https://wa.me/${agentContact.whatsapp}`;
            }

            function sendChat() {
                const text = chatbotInput.value.trim();
                if (!text) return;
                appendMessage(text, 'user');
                chatbotInput.value = '';
                setTimeout(() => {
                    appendMessage(generateResponse(text), 'bot');
                }, 300);
            }

            chatbotToggle.addEventListener('click', () => {
                chatbotPanel.classList.toggle('open');
                setTimeout(() => chatbotInput.focus(), 120);
            });
            chatbotClose.addEventListener('click', () => chatbotPanel.classList.remove('open'));
            chatbotSend.addEventListener('click', sendChat);
            chatbotInput.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    sendChat();
                }
            });

            function updateChatPosition() {
                if (window.innerWidth < 768) {
                    chatbotPanel.style.bottom = '84px';
                    chatbotPanel.style.right = '12px';
                    chatbotPanel.style.width = 'calc(100% - 24px)';
                } else {
                    chatbotPanel.style.bottom = '110px';
                    chatbotPanel.style.right = '26px';
                    chatbotPanel.style.width = 'min(400px, calc(100% - 52px))';
                }
            }

            window.addEventListener('resize', updateChatPosition);
            updateChatPosition();
        });
    </script>
</body>
</html>