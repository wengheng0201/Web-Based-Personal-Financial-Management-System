<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $recentTransactions = Transaction::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalIncome', 'totalExpense', 'recentTransactions'));
    }
}