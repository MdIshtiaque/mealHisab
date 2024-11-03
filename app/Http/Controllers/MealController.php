<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_count' => 'required|numeric|min:0|max:5',
        ]);

        Meal::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'date' => Carbon::today(),
            ],
            [
                'meal_count' => $validated['meal_count'],
            ]
        );

        return back()->with('success', 'Meal count updated successfully');
    }

    public function updateHistory(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'meal_count' => 'required|numeric|min:0|max:5',
        ]);

        Meal::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'date' => Carbon::parse($validated['date']),
            ],
            [
                'meal_count' => $validated['meal_count'],
            ]
        );

        return back()->with('success', 'Meal history updated successfully');
    }
}
