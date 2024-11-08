<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use App\Models\Expense;
use App\Models\Balance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    private function ensureMonthlyBalance()
    {
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        // Get or create current month's balance records for all users
        User::chunk(100, function ($users) use ($currentMonth, $currentYear) {
            foreach ($users as $user) {
                $balance = Balance::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'month' => $currentMonth,
                        'year' => $currentYear,
                    ]
                );

                // If this is a new month and previous balance isn't set
                if ($balance->wasRecentlyCreated) {
                    // Get previous month's balance
                    $previousDate = Carbon::create($currentYear, $currentMonth, 1)->subMonth();
                    $previousBalance = Balance::where('user_id', $user->id)
                        ->where('month', $previousDate->month)
                        ->where('year', $previousDate->year)
                        ->first();

                    if ($previousBalance) {
                        $balance->update([
                            'previous_balance' => $previousBalance->current_balance,
                            'current_balance' => $previousBalance->current_balance
                        ]);
                    }
                }
            }
        });
    }

    public function index()
    {
        $this->ensureMonthlyBalance();

        $currentMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();

        // Get all users
        $users = User::all();
        $totalUsers = $users->count();

        // Get total meals today
        $totalMealsToday = Meal::whereDate('date', $today)->sum('meal_count');

        // Get total monthly expenses
        $totalMonthlyExpenses = Expense::whereMonth('date', $currentMonth)->sum('amount');

        // Get total monthly meals
        $totalMonthlyMeals = Meal::whereMonth('date', $currentMonth)->sum('meal_count');

        // Calculate per meal cost
        $perMealCost = $totalMonthlyMeals > 0 ? $totalMonthlyExpenses / $totalMonthlyMeals : 0;

        // Get members overview with all necessary calculations
        $membersOverview = DB::table('users')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                DB::raw('COALESCE(today_meals.meal_count, 0) as todays_meals'),
                DB::raw('COALESCE(monthly_meals.total_meals, 0) as monthly_meals'),
                DB::raw('COALESCE(monthly_expenses.total_expenses, 0) as expenses_added'),
                DB::raw('COALESCE(balances.previous_balance, 0) as previous_balance'),
                DB::raw("(COALESCE(balances.previous_balance, 0) + COALESCE(monthly_expenses.total_expenses, 0) - (COALESCE(monthly_meals.total_meals, 0) * {$perMealCost})) as balance")
            ])
            ->leftJoin(
                DB::raw("(SELECT user_id, meal_count FROM meals WHERE date = '{$today->toDateString()}') as today_meals"),
                'users.id',
                '=',
                'today_meals.user_id'
            )
            ->leftJoin(
                DB::raw("(
                    SELECT user_id, SUM(meal_count) as total_meals
                    FROM meals
                    WHERE MONTH(date) = MONTH(CURRENT_DATE)
                    GROUP BY user_id
                ) as monthly_meals"),
                'users.id',
                '=',
                'monthly_meals.user_id'
            )
            ->leftJoin(
                DB::raw("(
                    SELECT user_id, SUM(amount) as total_expenses
                    FROM expenses
                    WHERE MONTH(date) = MONTH(CURRENT_DATE)
                    GROUP BY user_id
                ) as monthly_expenses"),
                'users.id',
                '=',
                'monthly_expenses.user_id'
            )
            ->leftJoin(
                'balances',
                function ($join) use ($currentMonth) {
                    $join->on('users.id', '=', 'balances.user_id')
                        ->where('balances.month', '=', $currentMonth->month)
                        ->where('balances.year', '=', $currentMonth->year);
                }
            )
            ->get();

        // Update balances for the current month
        foreach ($membersOverview as $member) {
            Balance::updateOrCreate(
                [
                    'user_id' => $member->id,
                    'month' => $currentMonth->month,
                    'year' => $currentMonth->year,
                ],
                [
                    'total_meals' => $member->monthly_meals,
                    'total_expenses' => $member->expenses_added,
                    'current_balance' => $member->balance
                ]
            );
        }

        // Get today's meal for current user
        $todayMeal = Meal::where('user_id', Auth::id())
            ->whereDate('date', $today)
            ->first();

        // Get meal history for all users
        $mealHistory = Meal::with('user')
            ->whereMonth('date', $currentMonth)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date');

        // Get recent expenses with user details
        $recentExpenses = Expense::with('user')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Calculate monthly statistics
        $monthlyStats = [
            'total_meals' => $totalMonthlyMeals,
            'total_expenses' => $totalMonthlyExpenses,
            'per_meal_cost' => $perMealCost,
            'start_date' => $currentMonth->format('M d, Y'),
            'end_date' => $currentMonth->copy()->endOfMonth()->format('M d, Y'),
        ];

        // Get expense categories summary
        $expenseCategories = Expense::whereMonth('date', $currentMonth)
            ->select('description', DB::raw('SUM(amount) as total'))
            ->groupBy('description')
            ->orderBy('total', 'desc')
            ->get();

        // Get daily meal trends
        $dailyMealTrends = Meal::whereMonth('date', $currentMonth)
            ->select('date', DB::raw('SUM(meal_count) as total_meals'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get meal history for current user
        $userMealHistory = Meal::where('user_id', Auth::id())
            ->whereMonth('date', $currentMonth)
            ->orderBy('date', 'desc')
            ->get();

        // Get meal data for the current month
        $monthlyMealData = Meal::with('user')
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->get()
            ->groupBy(function ($meal) {
                return $meal->date->format('Y-m-d');
            });

        return view('dashboard', compact(
            'totalUsers',
            'totalMealsToday',
            'totalMonthlyExpenses',
            'perMealCost',
            'membersOverview',
            'todayMeal',
            'mealHistory',
            'userMealHistory',
            'recentExpenses',
            'monthlyStats',
            'expenseCategories',
            'dailyMealTrends',
            'users',
            'monthlyMealData'
        ));
    }

    // Add this new method for API calls
    public function getMealsByMonth($year, $month)
    {
        $meals = Meal::with('user')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy(function ($meal) {
                return $meal->date->format('Y-m-d');
            });

        return response()->json($meals);
    }
}
