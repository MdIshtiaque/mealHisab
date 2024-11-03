@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50/50">
    <!-- Mobile Header -->
    <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-3">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-primary-700">Meal Manager</h1>
            <button class="p-2 rounded-lg hover:bg-gray-100" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
        <div class="flex justify-around p-2">
            <a href="#daily-meal" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"></path>
                </svg>
                <span class="text-xs mt-1">Daily Meal</span>
            </a>
            <a href="#meal-history" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs mt-1">History</span>
            </a>
            <a href="#monthly-balance" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs mt-1">Balance</span>
            </a>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <nav class="hidden lg:block fixed top-0 left-0 h-full w-72 bg-white shadow-lg">
        <div class="flex flex-col h-full">
            <div class="p-6 bg-gradient-to-br from-primary-600 to-secondary-600">
                <h1 class="text-2xl font-bold text-white">Meal Manager</h1>
                <p class="text-primary-100 mt-2">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex-1 px-4 py-6">
                <div class="space-y-1">
                    <a href="#daily-meal" class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"></path>
                        </svg>
                        Daily Meal Input
                    </a>
                    <a href="#meal-history" class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Meal History
                    </a>
                    <a href="#monthly-balance" class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Monthly Balance
                    </a>
                </div>
            </div>
            <div class="p-4 border-t border-gray-200">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-700 rounded-xl hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen pb-16 lg:pb-0">
        <!-- Stats Overview -->
        <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-lg border border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-white font-medium">Total Users</h3>
                            <span class="p-2 bg-white/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-white mt-4">{{ $totalUsers }}</p>
                        <p class="text-primary-100 mt-2">active members</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-lg border border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-white font-medium">Total Meals Today</h3>
                            <span class="p-2 bg-white/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2z"></path>
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-white mt-4">{{ $totalMealsToday }}</p>
                        <p class="text-primary-100 mt-2">meals recorded</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-lg border border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-white font-medium">Monthly Expenses</h3>
                            <span class="p-2 bg-white/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path>
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-white mt-4">৳{{ number_format($totalMonthlyExpenses, 2) }}</p>
                        <p class="text-primary-100 mt-2">total expenses</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-lg border border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-white font-medium">Per Meal Cost</h3>
                            <span class="p-2 bg-white/20 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01"></path>
                                </svg>
                            </span>
                        </div>
                        <p class="text-3xl font-bold text-white mt-4">৳{{ number_format($perMealCost, 2) }}</p>
                        <p class="text-primary-100 mt-2">current rate</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            <!-- Members Overview -->
            <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Members Overview</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Today's Meals</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Meals</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expenses Added</th>
                                @if(Auth::check())
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Your Balance</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($membersOverview as $member)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                                <span class="text-primary-700 font-medium">{{ substr($member->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $member->todays_meals }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $member->monthly_meals }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ৳{{ number_format($member->expenses_added, 2) }}
                                </td>
                                @if(Auth::check() && Auth::id() === $member->id)
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($member->balance >= 0)
                                            <span class="text-green-600 font-medium">৳{{ number_format($member->balance, 2) }}</span>
                                        @else
                                            <span class="text-red-600 font-medium">-৳{{ number_format(abs($member->balance), 2) }}</span>
                                        @endif
                                    </td>
                                @elseif(Auth::check())
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-gray-400">Hidden</span>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Add a personal balance card for the logged-in user -->
            @if(Auth::check())
            <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Your Balance Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Your Monthly Meals</h3>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $membersOverview->where('id', Auth::id())->first()->monthly_meals ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Your Expenses Added</h3>
                        <p class="text-2xl font-bold text-gray-900">
                            ৳{{ number_format($membersOverview->where('id', Auth::id())->first()->expenses_added ?? 0, 2) }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Your Current Balance</h3>
                        @php
                            $userBalance = $membersOverview->where('id', Auth::id())->first()->balance ?? 0;
                        @endphp
                        <p class="text-2xl font-bold {{ $userBalance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $userBalance >= 0 ? '৳' : '-৳' }}{{ number_format(abs($userBalance), 2) }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            {{ $userBalance >= 0 ? 'You have credit' : 'You need to add money' }}
                        </p>
                    </div>
                </div>
            </section>
            @endif

            <!-- Daily Meal Input Section -->
            <section id="daily-meal" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Today's Meal Input</h2>
                    <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm">
                        Your Meals: {{ $todayMeal->meal_count ?? '0' }}
                    </span>
                </div>
                <form action="{{ route('meals.store') }}" method="POST" class="max-w-md">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Number of Meals</label>
                            <div class="flex items-center space-x-4">
                                <input type="number"
                                       name="meal_count"
                                       min="0"
                                       max="5"
                                       step="0.5"
                                       class="flex-1 rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                       value="{{ $todayMeal->meal_count ?? '' }}"
                                       placeholder="Enter your meal count">
                                <button type="submit"
                                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                                    Save
                                </button>
                            </div>
                        </div>
                        @if ($errors->has('meal_count'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('meal_count') }}</p>
                        @endif
                    </div>
                </form>
            </section>

            <!-- Meal History Section -->
            <section id="meal-history" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Your Meal History</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <form action="{{ route('meals.history') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                                    <input type="date"
                                           name="date"
                                           class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                           max="{{ date('Y-m-d') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meals</label>
                                    <input type="number"
                                           name="meal_count"
                                           min="0"
                                           max="5"
                                           step="0.5"
                                           class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                </div>
                            </div>
                            <button type="submit"
                                    class="w-full px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                                Update History
                            </button>
                        </form>
                    </div>
                    <div class="overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meals</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($userMealHistory as $meal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $meal->date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $meal->meal_count }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Monthly Balance Section -->
            <section id="monthly-balance" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Monthly Balance</h2>
                    <span class="p-2 bg-primary-50 text-primary-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                                <input type="number" name="amount" step="0.01"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" rows="3"
                                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" name="date"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Add Expense
                            </button>
                        </form>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium mb-4">Recent Expenses</h3>
                        <div class="space-y-4">
                            @foreach($recentExpenses as $expense)
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium">৳{{ number_format($expense->amount, 2) }}</p>
                                    <p class="text-sm text-gray-500">{{ $expense->description }}</p>
                                </div>
                                <p class="text-sm text-gray-500">{{ $expense->date->format('M d, Y') }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
