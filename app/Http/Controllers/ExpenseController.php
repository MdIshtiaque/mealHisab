<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Expense::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'description' => $validated['description'],
            'date' => Carbon::parse($validated['date']),
        ]);

        return back()->with('success', 'Expense added successfully');
    }
}
