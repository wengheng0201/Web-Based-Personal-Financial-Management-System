<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BudgetWise — Personal Finance, Simplified</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,400i,600&family=epilogue:300,400,500&display=swap" rel="stylesheet"/>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:           #F4F1EB;
            --bg-2:         #EDE9E0;
            --surface:      #FFFFFF;
            --border:       #DDD9CF;
            --text:         #1C1A15;
            --text-2:       #6B6654;
            --text-3:       #9E9884;
            --green:        #2D6A4F;
            --green-light:  #D8EDDF;
            --green-mid:    #52B788;
            --amber:        #C07B2A;
            --amber-light:  #FDF3E3;
            --red-soft:     #E07B6A;
        }

        html { font-family: 'Epilogue', sans-serif; -webkit-font-smoothing: antialiased; scroll-behavior: smooth; }
        body { background: var(--bg); color: var(--text); min-height: 100vh; overflow-x: hidden; }

        /* ── NAVBAR ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 200;
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 52px;
            background: rgba(244, 241, 235, 0.88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; color: var(--text);
        }

        .brand-icon {
            width: 34px; height: 34px; background: var(--green);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
        }

        .brand-icon svg { width: 18px; height: 18px; stroke: #fff; }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; font-weight: 600;
            letter-spacing: -0.02em;
        }

        .nav-right { display: flex; align-items: center; gap: 8px; }

        .nav-right a {
            text-decoration: none; font-size: 0.8125rem; font-weight: 500;
            padding: 8px 18px; border-radius: 8px;
            transition: all 0.15s; letter-spacing: 0.01em;
        }

        .btn-ghost { color: var(--text-2); }
        .btn-ghost:hover { background: var(--bg-2); color: var(--text); }

        .btn-solid {
            background: var(--green); color: #fff;
            box-shadow: 0 2px 8px rgba(45,106,79,0.25);
        }
        .btn-solid:hover { background: #245c42; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(45,106,79,0.3); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: grid; grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 64px;
            padding: 120px 52px 80px;
            max-width: 1200px; margin: 0 auto;
        }

        .hero-left { animation: fadeUp 0.6s ease both; }

        .badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--green-light); color: var(--green);
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 5px 12px; border-radius: 999px;
            margin-bottom: 28px;
        }

        .badge-dot { width: 6px; height: 6px; background: var(--green-mid); border-radius: 50%; }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.6rem, 4.5vw, 4rem);
            font-weight: 400; line-height: 1.1; letter-spacing: -0.03em;
            color: var(--text); margin-bottom: 24px;
        }

        .hero-title .accent { color: var(--green); font-style: italic; }

        .hero-desc {
            font-size: 1rem; font-weight: 300; line-height: 1.8;
            color: var(--text-2); max-width: 44ch; margin-bottom: 40px;
        }

        .hero-cta { display: flex; gap: 12px; flex-wrap: wrap; }

        .cta-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: #fff;
            text-decoration: none; font-size: 0.9rem; font-weight: 500;
            padding: 13px 26px; border-radius: 10px;
            box-shadow: 0 3px 12px rgba(45,106,79,0.3);
            transition: all 0.15s;
        }
        .cta-primary:hover { background: #245c42; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(45,106,79,0.35); }
        .cta-primary svg { width: 15px; height: 15px; stroke: #fff; transition: transform 0.15s; }
        .cta-primary:hover svg { transform: translateX(3px); }

        .cta-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            text-decoration: none; font-size: 0.9rem; font-weight: 500;
            color: var(--text-2); padding: 13px 26px; border-radius: 10px;
            border: 1px solid var(--border); transition: all 0.15s;
        }
        .cta-secondary:hover { border-color: var(--text-3); color: var(--text); transform: translateY(-2px); }

        .hero-note {
            margin-top: 20px; font-size: 0.78rem; color: var(--text-3);
            display: flex; align-items: center; gap: 6px;
        }
        .hero-note svg { width: 13px; height: 13px; stroke: var(--green-mid); }

        /* ── DASHBOARD MOCKUP ── */
        .hero-right {
            animation: fadeUp 0.6s 0.15s ease both;
            position: relative;
        }

        .mockup-card {
            background: var(--surface);
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 60px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .mockup-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .mockup-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem; font-weight: 600; color: var(--text);
        }

        .mockup-month { font-size: 0.75rem; color: var(--text-3); font-weight: 400; }

        .mockup-body { padding: 22px; }

        .balance-row { display: flex; gap: 12px; margin-bottom: 22px; }

        .balance-card {
            flex: 1; padding: 16px; border-radius: 12px;
            border: 1px solid var(--border);
        }

        .balance-card.income  { background: var(--green-light); border-color: #b7dfc8; }
        .balance-card.expense { background: var(--amber-light);  border-color: #f0d9b5; }

        .balance-label  { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.07em; color: var(--text-3); margin-bottom: 6px; }
        .balance-amount { font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 600; letter-spacing: -0.02em; }
        .balance-card.income  .balance-amount { color: var(--green); }
        .balance-card.expense .balance-amount { color: var(--amber); }
        .balance-change { font-size: 0.7rem; margin-top: 4px; color: var(--text-3); }

        .chart-section { margin-bottom: 22px; }
        .chart-label   { font-size: 0.72rem; font-weight: 500; color: var(--text-2); margin-bottom: 12px; }
        .bars { display: flex; align-items: flex-end; gap: 6px; height: 64px; }
        .bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; height: 100%; justify-content: flex-end; }
        .bar { width: 100%; border-radius: 4px 4px 0 0; background: var(--green-light); border: 1px solid #b7dfc8; }
        .bar.active { background: var(--green); border-color: var(--green); }
        .bar-month { font-size: 0.6rem; color: var(--text-3); }

        .expense-list { display: flex; flex-direction: column; gap: 10px; }
        .expense-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 10px;
            background: var(--bg); border: 1px solid var(--border);
        }
        .exp-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .exp-name  { font-size: 0.8rem; font-weight: 500; color: var(--text); }
        .exp-cat   { font-size: 0.7rem; color: var(--text-3); }
        .exp-amount { margin-left: auto; font-size: 0.82rem; font-weight: 500; }
        .exp-amount.out { color: var(--red-soft); }
        .exp-amount.in  { color: var(--green); }

        .floating-pill {
            position: absolute; bottom: -16px; left: -20px;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 10px 16px;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            animation: float 3s ease-in-out infinite;
        }
        .pill-icon { font-size: 1.2rem; }
        .pill-text-top    { font-size: 0.7rem; color: var(--text-3); }
        .pill-text-bottom { font-size: 0.85rem; font-weight: 600; color: var(--green); font-family: 'Playfair Display', serif; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            nav { padding: 16px 24px; }
            .hero { grid-template-columns: 1fr; padding: 100px 24px 60px; gap: 48px; }
            .hero-right { display: none; }

        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav>
    <a href="/" class="brand">
        <div class="brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <span class="brand-name">BudgetWise</span>
    </a>

    @if (Route::has('login'))
        <div class="nav-right">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-solid">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-solid">Get started — free</a>
                @endif
            @endauth
        </div>
    @endif
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-left">
        <div class="badge">
            <span class="badge-dot"></span>
            Personal Finance
        </div>
        <h1 class="hero-title">
            Take control of your <span class="accent">spending,</span> effortlessly.
        </h1>
        <p class="hero-desc">
            BudgetWise helps you track every ringgit, understand your spending habits, and build better financial routines — all in one clean dashboard.
        </p>
        <div class="hero-cta">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="cta-primary">
                    Start budgeting free
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            @endif
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="cta-secondary">Log in</a>
            @endif
        </div>
        <p class="hero-note">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            No credit card required. Free forever for personal use.
        </p>
    </div>

    <div class="hero-right">
        <div class="mockup-card">
            <div class="mockup-header">
                <span class="mockup-title">My Budget Overview</span>
                <span class="mockup-month">March 2026</span>
            </div>
            <div class="mockup-body">
                <div class="balance-row">
                    <div class="balance-card income">
                        <div class="balance-label">Income</div>
                        <div class="balance-amount">RM 5,400</div>
                        <div class="balance-change">↑ 8% vs last month</div>
                    </div>
                    <div class="balance-card expense">
                        <div class="balance-label">Expenses</div>
                        <div class="balance-amount">RM 3,120</div>
                        <div class="balance-change">↓ 4% vs last month</div>
                    </div>
                </div>

                <div class="chart-section">
                    <div class="chart-label">Monthly spending</div>
                    <div class="bars">
                        <div class="bar-wrap"><div class="bar" style="height:55%"></div><span class="bar-month">Oct</span></div>
                        <div class="bar-wrap"><div class="bar" style="height:70%"></div><span class="bar-month">Nov</span></div>
                        <div class="bar-wrap"><div class="bar" style="height:48%"></div><span class="bar-month">Dec</span></div>
                        <div class="bar-wrap"><div class="bar" style="height:80%"></div><span class="bar-month">Jan</span></div>
                        <div class="bar-wrap"><div class="bar" style="height:63%"></div><span class="bar-month">Feb</span></div>
                        <div class="bar-wrap"><div class="bar active" style="height:58%"></div><span class="bar-month">Mar</span></div>
                    </div>
                </div>

                <div class="expense-list">
                    <div class="expense-item">
                        <div class="exp-icon" style="background:#FEF3C7">🛒</div>
                        <div><div class="exp-name">Groceries</div><div class="exp-cat">Food &amp; Dining</div></div>
                        <div class="exp-amount out">−RM 280</div>
                    </div>
                    <div class="expense-item">
                        <div class="exp-icon" style="background:#DBEAFE">🚌</div>
                        <div><div class="exp-name">Transport</div><div class="exp-cat">Commute</div></div>
                        <div class="exp-amount out">−RM 95</div>
                    </div>
                    <div class="expense-item">
                        <div class="exp-icon" style="background:#D8EDDF">💼</div>
                        <div><div class="exp-name">Salary</div><div class="exp-cat">Income</div></div>
                        <div class="exp-amount in">+RM 5,400</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="floating-pill">
            <span class="pill-icon">💰</span>
            <div>
                <div class="pill-text-top">Saved this month</div>
                <div class="pill-text-bottom">RM 2,280</div>
            </div>
        </div>
    </div>
</section>

</body>
</html>