<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Danny\'s Duck Farm') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-serif-display:400,400i|dm-sans:300,400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

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

            /* ── Auth Container ── */
            .auth-container {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 73px);
                padding: 2rem;
            }
            .auth-card {
                width: 100%;
                max-width: 420px;
                background: rgba(30,41,59,0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 12px;
                padding: 2.5rem;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            }
            .auth-card h2 {
                font-family: 'DM Serif Display', serif;
                font-size: 1.875rem;
                margin-bottom: 0.5rem;
                color: var(--slate-50);
            }
            .auth-card p {
                color: var(--slate-400);
                margin-bottom: 2rem;
                font-size: 0.875rem;
            }
            .auth-input {
                width: 100%;
                background: rgba(15,23,42,0.5);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 8px;
                padding: 0.75rem 1rem;
                color: var(--slate-100);
                font-size: 0.875rem;
                transition: all 0.2s;
            }
            .auth-input::placeholder {
                color: var(--slate-500);
            }
            .auth-input:focus {
                outline: none;
                border-color: var(--emerald-500);
                background: rgba(15,23,42,0.7);
                box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
            }
            .auth-label {
                display: block;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: var(--slate-300);
                margin-bottom: 0.5rem;
            }
            .auth-group {
                margin-bottom: 1.25rem;
            }
            .btn-primary {
                width: 100%;
                background: linear-gradient(135deg, var(--emerald-500), var(--emerald-600));
                border: none;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                font-size: 0.875rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, var(--emerald-600), var(--emerald-700));
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(16,185,129,0.3);
            }
            .auth-link {
                color: var(--emerald-400);
                text-decoration: none;
                font-size: 0.875rem;
                transition: color 0.2s;
            }
            .auth-link:hover {
                color: var(--emerald-300);
            }
            .auth-footer {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid rgba(255,255,255,0.08);
                color: var(--slate-400);
                font-size: 0.875rem;
            }
            .auth-error {
                color: #f87171;
                font-size: 0.75rem;
                margin-top: 0.5rem;
            }
            .auth-checkbox {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1.25rem;
            }
            .auth-checkbox input {
                width: 16px;
                height: 16px;
                cursor: pointer;
                accent-color: var(--emerald-500);
            }
            .auth-checkbox label {
                cursor: pointer;
                color: var(--slate-400);
                font-size: 0.875rem;
            }
            .auth-actions {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-top: 1.5rem;
            }
            .auth-actions-left {
                flex: 1;
            }
            .auth-actions-right {
                flex: 1;
                text-align: right;
            }

            @media (max-width: 640px) {
                nav {
                    padding: 1rem 1.5rem;
                }
                .auth-card {
                    padding: 1.5rem;
                }
                .auth-card h2 {
                    font-size: 1.5rem;
                }
                .auth-actions {
                    flex-direction: column;
                    gap: 1rem;
                }
                .auth-actions-left,
                .auth-actions-right {
                    width: 100%;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        <div class="bg-scene"></div>
        <div class="grain"></div>

        <div class="wrapper">
            <nav>
                <div class="nav-brand">
                    <span class="nav-duck">🦆</span>
                    <span class="nav-title">Danny's Duck Farm</span>
                </div>
                <div class="nav-actions">
                    <a href="/" class="btn-ghost">Back to Home</a>
                </div>
            </nav>

            <div class="auth-container">
                <div class="auth-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
