<x-app-layout>
    <style>
        /* ── BudgetWise Dashboard Styles ── */
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
            --red-soft:    #E07B6A;
            --blue:        #4A6FA5;
            --blue-light:  #E8F0FE;
        }

        .bw-wrap {
            font-family: 'Epilogue', 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            padding: 36px 48px 60px;
        }

        /* ── PAGE HEADER ── */
        .bw-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .bw-greeting {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-3);
            margin-bottom: 6px;
        }

        .bw-page-title {
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: -0.03em;
            color: var(--text);
        }

        .bw-btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: #fff;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 11px 22px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(45,106,79,0.25);
            transition: all 0.15s;
        }
        .bw-btn-add:hover {
            background: #245c42;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(45,106,79,0.3);
            color: #fff;
            text-decoration: none;
        }

        /* ── SUMMARY CARDS ── */
        .bw-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .bw-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px 26px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .bw-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.07);
        }

        .bw-card-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 14px;
        }

        .bw-card-icon {
            width: 30px; height: 30px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .bw-card-icon svg { width: 15px; height: 15px; stroke: currentColor; }

        .bw-card-icon.income  { background: var(--green-light); color: var(--green); }
        .bw-card-icon.expense { background: var(--amber-light); color: var(--amber); }
        .bw-card-icon.balance { background: var(--blue-light);  color: var(--blue);  }

        .bw-card-label.income  { color: var(--green); }
        .bw-card-label.expense { color: var(--amber); }
        .bw-card-label.balance { color: var(--blue);  }

        .bw-card-amount {
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 1.85rem;
            font-weight: 600;
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 8px;
        }

        .bw-card-amount.income  { color: var(--green); }
        .bw-card-amount.expense { color: var(--amber); }
        .bw-card-amount.balance { color: var(--blue);  }
        .bw-card-amount.negative { color: var(--red-soft); }

        .bw-card-sub {
            font-size: 0.78rem;
            color: var(--text-3);
            font-weight: 300;
        }

        /* ── RECENT TRANSACTIONS ── */
        .bw-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .bw-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            background: var(--bg);
        }

        .bw-section-title {
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .bw-view-all {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--green);
            transition: gap 0.15s;
        }
        .bw-view-all:hover { gap: 8px; color: var(--green); text-decoration: none; }
        .bw-view-all svg { width: 13px; height: 13px; stroke: currentColor; }

        /* TABLE */
        .bw-table { width: 100%; border-collapse: collapse; }

        .bw-table thead { background: var(--bg-2); }
        .bw-table thead th {
            padding: 12px 24px;
            text-align: left;
            font-size: 0.72rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-3);
        }
        .bw-table thead th:last-child { text-align: right; }

        .bw-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }
        .bw-table tbody tr:last-child { border-bottom: none; }
        .bw-table tbody tr:hover { background: var(--bg); }

        .bw-table tbody td {
            padding: 15px 24px;
            font-size: 0.875rem;
            color: var(--text-2);
            vertical-align: middle;
        }
        .bw-table tbody td:first-child { color: var(--text); font-weight: 500; }
        .bw-table tbody td:last-child { text-align: right; }

        .bw-category-pill {
            display: inline-block;
            background: var(--bg-2);
            border: 1px solid var(--border);
            color: var(--text-2);
            font-size: 0.72rem;
            padding: 3px 10px;
            border-radius: 999px;
        }

        .bw-amount-income  {
            color: var(--green);
            font-weight: 600;
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 0.95rem;
        }
        .bw-amount-expense {
            color: var(--red-soft);
            font-weight: 600;
            font-family: 'Playfair Display', 'Georgia', serif;
            font-size: 0.95rem;
        }

        /* EMPTY STATE */
        .bw-empty {
            text-align: center;
            padding: 52px 24px;
        }
        .bw-empty-icon {
            width: 52px; height: 52px;
            background: var(--bg-2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
        }
        .bw-empty-icon svg { width: 24px; height: 24px; stroke: var(--text-3); }
        .bw-empty-title { font-family: 'Playfair Display', serif; font-size: 1rem; color: var(--text); margin-bottom: 6px; }
        .bw-empty-desc  { font-size: 0.8rem; color: var(--text-3); font-weight: 300; }

        /* ANIMATIONS */
        @keyframes bwFadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .bw-wrap { animation: bwFadeUp 0.4s ease both; }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .bw-wrap { padding: 24px 20px 48px; }
            .bw-cards { grid-template-columns: 1fr; }
            .bw-page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        }
    </style>

    {{-- Load fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,400i,600&family=epilogue:300,400,500&display=swap" rel="stylesheet"/>

    <div class="bw-wrap">

        {{-- ── PAGE HEADER ── --}}
        <div class="bw-page-header">
            <div>
                <p class="bw-greeting">Overview</p>
                <h1 class="bw-page-title">My Dashboard</h1>
            </div>
            <a href="{{ route('transactions.create') }}" class="bw-btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" style="width:15px;height:15px;stroke:#fff">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Add Transaction
            </a>
        </div>

        {{-- ── SUMMARY CARDS ── --}}
        <div class="bw-cards">

            {{-- Income --}}
            <div class="bw-card">
                <div class="bw-card-label income">
                    <div class="bw-card-icon income">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"/>
                        </svg>
                    </div>
                    Total Income
                </div>
                <div class="bw-card-amount income">RM {{ number_format($totalIncome, 2) }}</div>
                <div class="bw-card-sub">All recorded income</div>
            </div>

            {{-- Expenses --}}
            <div class="bw-card">
                <div class="bw-card-label expense">
                    <div class="bw-card-icon expense">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75"/>
                        </svg>
                    </div>
                    Total Expenses
                </div>
                <div class="bw-card-amount expense">RM {{ number_format($totalExpense, 2) }}</div>
                <div class="bw-card-sub">All recorded expenses</div>
            </div>

            {{-- Net Balance --}}
            <div class="bw-card">
                <div class="bw-card-label balance">
                    <div class="bw-card-icon balance">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    Net Balance
                </div>
                @php $balance = $totalIncome - $totalExpense; @endphp
                <div class="bw-card-amount {{ $balance >= 0 ? 'balance' : 'negative' }}">
                    RM {{ number_format($balance, 2) }}
                </div>
                <div class="bw-card-sub">{{ $balance >= 0 ? 'You\'re in the green 🎉' : 'Expenses exceed income' }}</div>
            </div>

        </div>

        {{-- ── RECENT TRANSACTIONS ── --}}
        <div class="bw-section">

            <div class="bw-section-header">
                <span class="bw-section-title">Recent Transactions</span>
                <a href="{{ route('transactions.index') }}" class="bw-view-all">
                    View all
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

            @if($recentTransactions->isEmpty())
                <div class="bw-empty">
                    <div class="bw-empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75"/>
                        </svg>
                    </div>
                    <p class="bw-empty-title">No transactions yet</p>
                    <p class="bw-empty-desc">Add your first transaction to see it here.</p>
                </div>
            @else
                <table class="bw-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->title }}</td>
                            <td><span class="bw-category-pill">{{ $transaction->category }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                            <td>
                                <span class="{{ $transaction->type == 'income' ? 'bw-amount-income' : 'bw-amount-expense' }}">
                                    {{ $transaction->type == 'income' ? '+' : '−' }} RM {{ number_format($transaction->amount, 2) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>

    </div>

</x-app-layout>