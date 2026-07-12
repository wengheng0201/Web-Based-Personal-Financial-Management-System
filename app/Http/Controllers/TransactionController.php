<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'amount'   => 'required|numeric|min:0',
            'type'     => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'date'     => 'required|date',
        ]);

        Transaction::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'amount'      => $request->amount,
            'type'        => $request->type,
            'category'    => $request->category,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction added!');
    }

    public function edit(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);

        $request->validate([
            'title'    => 'required|string|max:255',
            'amount'   => 'required|numeric|min:0',
            'type'     => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'date'     => 'required|date',
        ]);

        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted!');
    }
}