<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Transaction — BudgetWise</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,400i,600&family=epilogue:300,400,500&display=swap" rel="stylesheet"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #F4F1EB;
            --bg-2:        #EDE9E0;
            --surface:     #FFFFFF;
            --border:      #DDD9CF;
            --text:        #1C1A15;
            --text-2:      #6B6654;
            --text-3:      #9E9884;
            --green:       #2D6A4F;
            --green-light: #D8EDDF;
            --green-mid:   #52B788;
            --red:         #C0392B;
            --red-light:   #FDECEA;
        }

        html { font-family: 'Epilogue', sans-serif; -webkit-font-smoothing: antialiased; }
        body { background: var(--bg); color: var(--text); min-height: 100vh; }

        /* NAV */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 52px;
            background: rgba(244,241,235,0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--text); }
        .brand-icon { width: 34px; height: 34px; background: var(--green); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .brand-icon svg { width: 18px; height: 18px; stroke: #fff; }
        .brand-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 600; letter-spacing: -0.02em; }
        .nav-right { display: flex; align-items: center; gap: 8px; }
        .nav-right a {
            text-decoration: none; font-size: 0.8125rem; font-weight: 500;
            padding: 8px 18px; border-radius: 8px; transition: all 0.15s;
        }
        .btn-ghost { color: var(--text-2); }
        .btn-ghost:hover { background: var(--bg-2); color: var(--text); }

        /* PAGE */
        .page { max-width: 640px; margin: 0 auto; padding: 108px 24px 60px; animation: fadeUp 0.4s ease both; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none; font-size: 0.8rem; color: var(--text-3);
            margin-bottom: 28px; transition: color 0.15s;
        }
        .back-link:hover { color: var(--text); }
        .back-link svg { width: 14px; height: 14px; stroke: currentColor; }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem; font-weight: 400; letter-spacing: -0.03em;
            margin-bottom: 6px;
        }
        .page-subtitle { font-size: 0.875rem; color: var(--text-3); font-weight: 300; margin-bottom: 32px; }

        /* ERRORS */
        .error-box {
            background: var(--red-light); border: 1px solid #f5c6c2;
            border-radius: 10px; padding: 14px 16px; margin-bottom: 24px;
        }
        .error-box ul { list-style: none; }
        .error-box li { font-size: 0.8rem; color: var(--red); padding: 2px 0; display: flex; align-items: center; gap: 6px; }
        .error-box li::before { content: '•'; }

        /* FORM CARD */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.78rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--text-3);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--bg);
            color: var(--text);
            font-family: 'Epilogue', sans-serif;
            font-size: 0.9rem;
            font-weight: 400;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--green-mid);
            box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
            background: var(--surface);
        }
        textarea { resize: vertical; min-height: 90px; }
        select { cursor: pointer; }

        /* TYPE TOGGLE */
        .type-toggle { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .type-toggle input[type="radio"] { display: none; }
        .type-label {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            padding: 11px; border-radius: 9px; cursor: pointer;
            border: 1px solid var(--border); background: var(--bg);
            font-size: 0.875rem; font-weight: 500; color: var(--text-2);
            transition: all 0.15s;
        }
        .type-label svg { width: 15px; height: 15px; stroke: currentColor; }
        .type-toggle input[value="income"]:checked  + .type-label { background: var(--green-light); border-color: #b7dfc8; color: var(--green); }
        .type-toggle input[value="expense"]:checked + .type-label { background: #FDF3E3; border-color: #f0d9b5; color: #C07B2A; }

        /* DIVIDER */
        .form-divider { border: none; border-top: 1px solid var(--border); margin: 24px 0; }

        /* SUBMIT */
        .form-actions { display: flex; gap: 12px; justify-content: flex-end; }

        .btn-cancel {
            display: inline-flex; align-items: center;
            text-decoration: none; font-size: 0.875rem; font-weight: 500;
            color: var(--text-2); padding: 11px 22px; border-radius: 10px;
            border: 1px solid var(--border); transition: all 0.15s;
        }
        .btn-cancel:hover { border-color: var(--text-3); color: var(--text); }

        .btn-submit {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: #fff;
            border: none; font-family: 'Epilogue', sans-serif;
            font-size: 0.875rem; font-weight: 500;
            padding: 11px 26px; border-radius: 10px; cursor: pointer;
            box-shadow: 0 2px 10px rgba(45,106,79,0.25);
            transition: all 0.15s;
        }
        .btn-submit:hover { background: #245c42; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(45,106,79,0.3); }
        .btn-submit svg { width: 15px; height: 15px; stroke: #fff; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            nav { padding: 16px 20px; }
            .page { padding: 90px 16px 40px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-card { padding: 24px 20px; }
        }
    </style>
</head>
<body>

{{-- NAV --}}
<nav>
    <a href="/" class="brand">
        <div class="brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <span class="brand-name">BudgetWise</span>
    </a>
    <div class="nav-right">
        <a href="{{ url('/dashboard') }}" class="btn-ghost">Dashboard</a>
    </div>
</nav>

<div class="page">

    <a href="{{ route('transactions.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Back to Transactions
    </a>

    <h1 class="page-title">Add Transaction</h1>
    <p class="page-subtitle">Record a new income or expense entry</p>

    @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <div class="form-grid">

                {{-- TYPE --}}
                <div class="form-group full">
                    <label>Type</label>
                    <div class="type-toggle">
                        <input type="radio" name="type" id="type-income" value="income" {{ old('type') == 'income' ? 'checked' : '' }}>
                        <label for="type-income" class="type-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"/>
                            </svg>
                            Income
                        </label>
                        <input type="radio" name="type" id="type-expense" value="expense" {{ old('type') == 'expense' ? 'checked' : '' }}>
                        <label for="type-expense" class="type-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75"/>
                            </svg>
                            Expense
                        </label>
                    </div>
                </div>

                {{-- TITLE --}}
                <div class="form-group full">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Monthly Salary">
                </div>

                {{-- AMOUNT --}}
                <div class="form-group">
                    <label for="amount">Amount (RM)</label>
                    <input type="number" id="amount" step="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00">
                </div>

                {{-- DATE --}}
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}">
                </div>

                {{-- CATEGORY --}}
                <div class="form-group full">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="e.g. Food, Transport, Salary">
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group full">
                    <label for="description">Description <span style="font-size:0.7rem;color:var(--text-3);text-transform:none;letter-spacing:0">(optional)</span></label>
                    <textarea id="description" name="description" placeholder="Any extra notes...">{{ old('description') }}</textarea>
                </div>

            </div>

            <hr class="form-divider">

            <div class="form-actions">
                <a href="{{ route('transactions.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Save Transaction
                </button>
            </div>
        </form>
    </div>

</div>
</body>
</html>