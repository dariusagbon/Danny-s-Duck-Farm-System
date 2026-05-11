<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Danny's Duck Farm — Farm Management System</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-serif-display:400,400i|dm-sans:300,400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --emerald-400: #34d399;
                --emerald-500: #10b981;
                --emerald-600: #059669;
                --emerald-700: #047857;
                --slate-50:  #f8fafc;
                --slate-100: #f1f5f9;
                --slate-200: #e2e8f0;
                --slate-300: #cbd5e1;
                --slate-400: #94a3b8;
                --slate-500: #64748b;
                --slate-700: #334155;
                --slate-800: #1e293b;
                --slate-900: #0f172a;
                --slate-950: #020617;
            }

            html { scroll-behavior: smooth; }

            body {
                font-family: 'DM Sans', sans-serif;
                background-color: var(--slate-950);
                color: var(--slate-100);
                min-height: 100vh;
                overflow-x: hidden;
            }

            /* ── Background ── */
            .bg-scene {
                position: fixed;
                inset: 0;
                z-index: 0;
                pointer-events: none;
                overflow: hidden;
            }
            .bg-scene::before {
                content: '';
                position: absolute;
                top: -20%;
                left: -10%;
                width: 70%;
                height: 70%;
                background: radial-gradient(ellipse at center, rgba(16,185,129,0.13) 0%, transparent 65%);
                animation: drift 18s ease-in-out infinite alternate;
            }
            .bg-scene::after {
                content: '';
                position: absolute;
                bottom: -10%;
                right: -10%;
                width: 55%;
                height: 55%;
                background: radial-gradient(ellipse at center, rgba(5,150,105,0.09) 0%, transparent 60%);
                animation: drift 22s ease-in-out infinite alternate-reverse;
            }
            .grain {
                position: fixed;
                inset: 0;
                z-index: 1;
                pointer-events: none;
                opacity: 0.035;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
                background-size: 128px 128px;
            }

            @keyframes drift {
                from { transform: translate(0, 0) scale(1); }
                to   { transform: translate(3%, 4%) scale(1.06); }
            }

            /* ── Layout ── */
            .wrapper {
                position: relative;
                z-index: 2;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* ── Nav ── */
            nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1.5rem 2.5rem;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                backdrop-filter: blur(8px);
                position: sticky;
                top: 0;
                z-index: 10;
                background: rgba(2,6,23,0.6);
            }
            .nav-brand {
                display: flex;
                align-items: center;
                gap: 0.625rem;
            }
            .nav-duck {
                font-size: 1.5rem;
                line-height: 1;
                filter: drop-shadow(0 0 8px rgba(52,211,153,0.5));
            }
            .nav-title {
                font-family: 'DM Serif Display', serif;
                font-size: 1.125rem;
                color: var(--slate-50);
                letter-spacing: -0.01em;
            }
            .nav-actions {
                display: flex;
                gap: 0.75rem;
                align-items: center;
            }
            .btn-ghost {
                padding: 0.5rem 1.125rem;
                border-radius: 999px;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--slate-300);
                text-decoration: none;
                border: 1px solid rgba(255,255,255,0.1);
                transition: all 0.2s;
            }
            .btn-ghost:hover {
                border-color: rgba(255,255,255,0.22);
                color: var(--slate-50);
                background: rgba(255,255,255,0.05);
            }
            .btn-primary {
                padding: 0.5rem 1.25rem;
                border-radius: 999px;
                font-size: 0.875rem;
                font-weight: 600;
                color: #fff;
                text-decoration: none;
                background: var(--emerald-600);
                border: 1px solid var(--emerald-500);
                transition: all 0.2s;
                box-shadow: 0 0 20px rgba(16,185,129,0.25);
            }
            .btn-primary:hover {
                background: var(--emerald-500);
                box-shadow: 0 0 28px rgba(16,185,129,0.4);
                transform: translateY(-1px);
            }

            /* ── Hero ── */
            .hero {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 6rem 1.5rem 5rem;
                gap: 2rem;
            }
            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.375rem 1rem;
                border-radius: 999px;
                border: 1px solid rgba(52,211,153,0.3);
                background: rgba(52,211,153,0.07);
                font-size: 0.8125rem;
                font-weight: 500;
                color: var(--emerald-400);
                letter-spacing: 0.04em;
                text-transform: uppercase;
                animation: fadeUp 0.6s ease both;
            }
            .hero-badge-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--emerald-400);
                animation: pulse 2s ease-in-out infinite;
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: 0.5; transform: scale(0.75); }
            }

            .hero-heading {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2.8rem, 7vw, 5.5rem);
                line-height: 1.05;
                letter-spacing: -0.025em;
                color: var(--slate-50);
                max-width: 15ch;
                animation: fadeUp 0.6s 0.1s ease both;
            }
            .hero-heading em {
                font-style: italic;
                color: var(--emerald-400);
                display: block;
            }
            .hero-sub {
                font-size: 1.125rem;
                color: var(--slate-400);
                max-width: 42ch;
                line-height: 1.7;
                font-weight: 300;
                animation: fadeUp 0.6s 0.2s ease both;
            }
            .hero-cta {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
                animation: fadeUp 0.6s 0.3s ease both;
            }
            .btn-hero {
                padding: 0.875rem 2rem;
                border-radius: 999px;
                font-size: 1rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.22s;
            }
            .btn-hero-primary {
                background: var(--emerald-600);
                color: #fff;
                border: 1px solid var(--emerald-500);
                box-shadow: 0 0 32px rgba(16,185,129,0.3), 0 4px 16px rgba(0,0,0,0.3);
            }
            .btn-hero-primary:hover {
                background: var(--emerald-500);
                box-shadow: 0 0 48px rgba(16,185,129,0.45), 0 4px 20px rgba(0,0,0,0.3);
                transform: translateY(-2px);
            }
            .btn-hero-secondary {
                background: rgba(255,255,255,0.05);
                color: var(--slate-200);
                border: 1px solid rgba(255,255,255,0.1);
            }
            .btn-hero-secondary:hover {
                background: rgba(255,255,255,0.09);
                border-color: rgba(255,255,255,0.2);
                transform: translateY(-2px);
            }

            /* ── Stats strip ── */
            .stats-strip {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0;
                border-top: 1px solid rgba(255,255,255,0.06);
                border-bottom: 1px solid rgba(255,255,255,0.06);
                background: rgba(255,255,255,0.02);
                animation: fadeUp 0.6s 0.4s ease both;
            }
            .stat-item {
                padding: 1.75rem 3rem;
                text-align: center;
                border-right: 1px solid rgba(255,255,255,0.06);
                flex: 1;
                min-width: 160px;
            }
            .stat-item:last-child { border-right: none; }
            .stat-value {
                font-family: 'DM Serif Display', serif;
                font-size: 2rem;
                color: var(--emerald-400);
                line-height: 1;
            }
            .stat-label {
                margin-top: 0.375rem;
                font-size: 0.8125rem;
                color: var(--slate-500);
                font-weight: 500;
                letter-spacing: 0.05em;
                text-transform: uppercase;
            }

            /* ── Features ── */
            .features {
                padding: 6rem 1.5rem;
                max-width: 72rem;
                margin: 0 auto;
                width: 100%;
            }
            .section-label {
                text-align: center;
                font-size: 0.8rem;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--emerald-400);
                font-weight: 600;
                margin-bottom: 1rem;
                animation: fadeUp 0.6s ease both;
            }
            .section-heading {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(1.8rem, 4vw, 3rem);
                text-align: center;
                color: var(--slate-50);
                letter-spacing: -0.02em;
                margin-bottom: 0.75rem;
            }
            .section-sub {
                text-align: center;
                color: var(--slate-400);
                font-size: 1.0625rem;
                margin-bottom: 3.5rem;
                font-weight: 300;
                max-width: 50ch;
                margin-left: auto;
                margin-right: auto;
            }
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.25rem;
            }
            .feature-card {
                background: rgba(255,255,255,0.03);
                border: 1px solid rgba(255,255,255,0.07);
                border-radius: 1.25rem;
                padding: 2rem;
                transition: all 0.25s;
                position: relative;
                overflow: hidden;
            }
            .feature-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(52,211,153,0.4), transparent);
                opacity: 0;
                transition: opacity 0.3s;
            }
            .feature-card:hover {
                border-color: rgba(52,211,153,0.2);
                background: rgba(16,185,129,0.04);
                transform: translateY(-3px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            }
            .feature-card:hover::before { opacity: 1; }
            .feature-icon {
                font-size: 1.75rem;
                margin-bottom: 1rem;
                display: block;
            }
            .feature-title {
                font-family: 'DM Serif Display', serif;
                font-size: 1.2rem;
                color: var(--slate-50);
                margin-bottom: 0.625rem;
                letter-spacing: -0.01em;
            }
            .feature-desc {
                font-size: 0.9375rem;
                color: var(--slate-400);
                line-height: 1.65;
                font-weight: 300;
            }

            /* ── How it works ── */
            .how-section {
                padding: 5rem 1.5rem;
                border-top: 1px solid rgba(255,255,255,0.06);
                background: rgba(255,255,255,0.015);
            }
            .how-inner {
                max-width: 56rem;
                margin: 0 auto;
            }
            .steps {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
                margin-top: 3.5rem;
                position: relative;
            }
            .step {
                text-align: center;
            }
            .step-num {
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                border: 1px solid rgba(52,211,153,0.35);
                background: rgba(52,211,153,0.08);
                color: var(--emerald-400);
                font-family: 'DM Serif Display', serif;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.25rem;
            }
            .step-title {
                font-weight: 600;
                font-size: 1rem;
                color: var(--slate-100);
                margin-bottom: 0.5rem;
            }
            .step-desc {
                font-size: 0.9rem;
                color: var(--slate-500);
                line-height: 1.6;
                font-weight: 300;
            }

            /* ── CTA Banner ── */
            .cta-banner {
                padding: 5rem 1.5rem;
                text-align: center;
                border-top: 1px solid rgba(255,255,255,0.06);
            }
            .cta-inner {
                max-width: 42rem;
                margin: 0 auto;
            }
            .cta-heading {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                color: var(--slate-50);
                letter-spacing: -0.02em;
                margin-bottom: 1rem;
            }
            .cta-heading em {
                font-style: italic;
                color: var(--emerald-400);
            }
            .cta-sub {
                font-size: 1rem;
                color: var(--slate-400);
                margin-bottom: 2rem;
                font-weight: 300;
                line-height: 1.7;
            }

            /* ── Footer ── */
            footer {
                padding: 1.75rem 2.5rem;
                border-top: 1px solid rgba(255,255,255,0.06);
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
            }
            .footer-brand {
                font-family: 'DM Serif Display', serif;
                font-size: 0.9375rem;
                color: var(--slate-500);
            }
            .footer-copy {
                font-size: 0.8125rem;
                color: var(--slate-600);
            }

            /* ── Animations ── */
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* ── Responsive ── */
            @media (max-width: 640px) {
                nav { padding: 1.25rem 1.25rem; }
                .nav-title { display: none; }
                .stat-item { padding: 1.5rem 1.5rem; min-width: 130px; }
                .features { padding: 4rem 1rem; }
                footer { flex-direction: column; text-align: center; }
            }
        </style>
    </head>
    <body>
        <div class="bg-scene"></div>
        <div class="grain"></div>

        <div class="wrapper">
            <!-- Nav -->
            <nav>
                <div class="nav-brand">
                    <span class="nav-duck">🦆</span>
                    <span class="nav-title">Danny's Duck Farm</span>
                </div>
                <div class="nav-actions">
                    <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
                </div>
            </nav>

            <!-- Hero -->
            <section class="hero">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Farm Management System
                </div>

                <h1 class="hero-heading">
                    Run your farm
                    <em>smarter.</em>
                </h1>

                <p class="hero-sub">
                    A complete operations platform for Danny's Duck Farm — track egg production, manage feed inventory, record sales, and monitor your farm's financial health in real time.
                </p>

                <div class="hero-cta">
                    <a href="{{ url('/dashboard') }}" class="btn-hero btn-hero-primary">Open Dashboard →</a>
                    <a href="#features" class="btn-hero btn-hero-secondary">See Features</a>
                </div>
            </section>

            <!-- Stats strip -->
            <div class="stats-strip">
                <div class="stat-item">
                    <div class="stat-value">🥚</div>
                    <div class="stat-label">Egg Production</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">📦</div>
                    <div class="stat-label">Inventory Tracking</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">📈</div>
                    <div class="stat-label">Sales Analytics</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">🌾</div>
                    <div class="stat-label">Feed Management</div>
                </div>
            </div>

            <!-- Features -->
            <section class="features" id="features">
                <p class="section-label">What's included</p>
                <h2 class="section-heading">Everything your farm needs</h2>
                <p class="section-sub">From daily production logs to long-term revenue trends, every tool is built for duck farm operations.</p>

                <div class="features-grid">
                    <div class="feature-card">
                        <span class="feature-icon">🥚</span>
                        <h3 class="feature-title">Egg Production Tracking</h3>
                        <p class="feature-desc">Log every egg batch, monitor stock levels, and get instant visibility into your available egg inventory ready for orders.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">🌾</span>
                        <h3 class="feature-title">Feed Inventory Control</h3>
                        <p class="feature-desc">Track all feed supplies, set reorder thresholds, and receive low-stock alerts before you run out — keeping your flock fed without interruption.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">💰</span>
                        <h3 class="feature-title">Sales Record Management</h3>
                        <p class="feature-desc">Record every sale by egg type, quantity, and price. Search transaction history and keep a complete audit trail of all revenue.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">📊</span>
                        <h3 class="feature-title">Financial Analytics</h3>
                        <p class="feature-desc">Visualize net income trends over the last six months, monitor daily sales performance, and understand your farm's profitability at a glance.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">⚠️</span>
                        <h3 class="feature-title">Low Stock Alerts</h3>
                        <p class="feature-desc">Automated alerts surface any egg or feed items falling below their minimum stock levels so you can act before supply runs out.</p>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">📋</span>
                        <h3 class="feature-title">Inventory Logs</h3>
                        <p class="feature-desc">A detailed activity log of every inventory change — a complete history of what came in, what went out, and when.</p>
                    </div>
                </div>
            </section>

            <!-- How it works -->
            <section class="how-section">
                <div class="how-inner">
                    <p class="section-label">How it works</p>
                    <h2 class="section-heading">Simple daily workflow</h2>
                    <p class="section-sub">Designed to be fast — spend less time on paperwork and more time on the farm.</p>

                    <div class="steps">
                        <div class="step">
                            <div class="step-num">1</div>
                            <div class="step-title">Log Production</div>
                            <p class="step-desc">Record each egg batch as it comes in to keep stock counts accurate and up to date.</p>
                        </div>
                        <div class="step">
                            <div class="step-num">2</div>
                            <div class="step-title">Record Sales</div>
                            <p class="step-desc">Add each sale with egg type, quantity, and price — inventory updates automatically.</p>
                        </div>
                        <div class="step">
                            <div class="step-num">3</div>
                            <div class="step-title">Monitor Feed</div>
                            <p class="step-desc">Check feed levels, get alerts when supplies run low, and log new deliveries with ease.</p>
                        </div>
                        <div class="step">
                            <div class="step-num">4</div>
                            <div class="step-title">Review Analytics</div>
                            <p class="step-desc">Open the dashboard to see your net income trend, daily performance, and farm health at a glance.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Banner -->
            <section class="cta-banner">
                <div class="cta-inner">
                    <h2 class="cta-heading">Ready to manage your farm <em>better?</em></h2>
                    <p class="cta-sub">Open the dashboard now to manage duck production, feed consumption, and farm records instantly.</p>
                    <a href="{{ url('/dashboard') }}" class="btn-hero btn-hero-primary">Open Dashboard →</a>
                </div>
            </section>

            <!-- Footer -->
            <footer>
                <div class="footer-brand">🦆 Danny's Duck Farm</div>
                <div class="footer-copy">Farm Management System &mdash; All rights reserved.</div>
            </footer>
        </div>
    </body>
</html>