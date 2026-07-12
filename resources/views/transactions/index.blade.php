<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Transactions — BudgetWise</title>
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
            --amber:       #C07B2A;
            --amber-light: #FDF3E3;
            --red:         #C0392B;
            --red-light:   #FDECEA;
            --red-soft:    #E07B6A;
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
        .btn-solid { background: var(--green); color: #fff; box-shadow: 0 2px 8px rgba(45,106,79,0.25); }
        .btn-solid:hover { background: #245c42; transform: translateY(-1px); }

        /* PAGE */
        .page { max-width: 1100px; margin: 0 auto; padding: 108px 52px 60px; }

        .page-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 32px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 400; letter-spacing: -0.03em;
        }
        .page-subtitle { font-size: 0.875rem; color: var(--text-3); margin-top: 4px; font-weight: 300; }

        .btn-add {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: #fff;
            text-decoration: none; font-size: 0.875rem; font-weight: 500;
            padding: 11px 22px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(45,106,79,0.25);
            transition: all 0.15s;
        }
        .btn-add:hover { background: #245c42; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(45,106,79,0.3); }
        .btn-add svg { width: 15px; height: 15px; stroke: #fff; }

        /* ALERT */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            background: var(--green-light); border: 1px solid #b7dfc8;
            color: var(--green); border-radius: 10px;
            padding: 12px 16px; margin-bottom: 24px;
            font-size: 0.875rem; font-weight: 500;
        }
        .alert-success svg { width: 16px; height: 16px; stroke: var(--green); flex-shrink: 0; }

        /* TABLE CARD */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: var(--bg-2); border-bottom: 1px solid var(--border); }
        thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 0.72rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: var(--text-3);
        }

        tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--bg); }

        tbody td { padding: 16px 20px; font-size: 0.875rem; color: var(--text-2); vertical-align: middle; }
        tbody td:first-child { color: var(--text); font-weight: 500; }

        /* TYPE BADGE */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 999px;
            font-size: 0.72rem; font-weight: 500; text-transform: capitalize;
        }
        .badge-income  { background: var(--green-light); color: var(--green); }
        .badge-expense { background: var(--amber-light); color: var(--amber); }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        /* AMOUNT */
        .amount-income  { color: var(--green);    font-weight: 500; font-family: 'Playfair Display', serif; }
        .amount-expense { color: var(--red-soft); font-weight: 500; font-family: 'Playfair Display', serif; }

        /* CATEGORY PILL */
        .category-pill {
            display: inline-block;
            background: var(--bg-2); border: 1px solid var(--border);
            color: var(--text-2); font-size: 0.72rem;
            padding: 3px 10px; border-radius: 999px;
        }

        /* ACTIONS */
        .actions { display: flex; align-items: center; gap: 8px; }

        .btn-edit {
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; font-size: 0.78rem; font-weight: 500;
            color: var(--green); background: var(--green-light);
            padding: 6px 12px; border-radius: 7px; transition: all 0.15s;
            border: 1px solid #b7dfc8;
        }
        .btn-edit:hover { background: #c3e6cf; }
        .btn-edit svg { width: 12px; height: 12px; stroke: var(--green); }

        .btn-delete {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.78rem; font-weight: 500;
            color: var(--red); background: var(--red-light);
            padding: 6px 12px; border-radius: 7px; transition: all 0.15s;
            border: 1px solid #f5c6c2; cursor: pointer;
            font-family: inherit;
        }
        .btn-delete:hover { background: #fad4d1; }
        .btn-delete svg { width: 12px; height: 12px; stroke: var(--red); }

        /* EMPTY STATE */
        .empty-state {
            text-align: center; padding: 64px 24px;
        }
        .empty-icon {
            width: 56px; height: 56px; background: var(--bg-2);
            border-radius: 14px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .empty-icon svg { width: 26px; height: 26px; stroke: var(--text-3); }
        .empty-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: var(--text); margin-bottom: 8px; }
        .empty-desc  { font-size: 0.875rem; color: var(--text-3); font-weight: 300; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page { animation: fadeUp 0.4s ease both; }

        @media (max-width: 768px) {
            nav { padding: 16px 20px; }
            .page { padding: 90px 20px 40px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            thead th:nth-child(3), tbody td:nth-child(3),
            thead th:nth-child(4), tbody td:nth-child(4) { display: none; }
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
        <a href="{{ route('transactions.create') }}" class="btn-solid">+ New Transaction</a>
    </div>
</nav>

<div class="page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">My Transactions</h1>
            <p class="page-subtitle">Track and manage all your income &amp; expenses</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Add Transaction
        </a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->title }}</td>
                    <td>
                        <span class="{{ $transaction->type === 'income' ? 'amount-income' : 'amount-expense' }}">
                            {{ $transaction->type === 'income' ? '+' : '−' }}RM {{ number_format($transaction->amount, 2) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $transaction->type }}">
                            <span class="badge-dot"></span>
                            {{ $transaction->type }}
                        </span>
                    </td>
                    <td><span class="category-pill">{{ $transaction->category }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this transaction?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75"/>
                                </svg>
                            </div>
                            <p class="empty-title">No transactions yet</p>
                            <p class="empty-desc">Add your first transaction to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>