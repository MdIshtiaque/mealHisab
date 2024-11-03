@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50/50">
        <!-- Mobile Header -->
        <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-3">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-primary-700">Meal Manager</h1>
                {{-- <button class="p-2 rounded-lg hover:bg-gray-100" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button> --}}
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
            <div class="flex justify-around p-2">
                <a href="#daily-meal" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z">
                        </path>
                    </svg>
                    <span class="text-xs mt-1">Daily Meal</span>
                </a>
                <a href="#meal-history" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-xs mt-1">History</span>
                </a>
                <a href="#monthly-balance" class="flex flex-col items-center p-2 text-gray-600 hover:text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
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
                        <a href="#daily-meal"
                            class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z">
                                </path>
                            </svg>
                            Daily Meal Input
                        </a>
                        <a href="#meal-history"
                            class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Meal History
                        </a>
                        <a href="#monthly-balance"
                            class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary-50 hover:text-primary-700 transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Monthly Balance
                        </a>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-3 text-gray-700 rounded-xl hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
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
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
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
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2z"></path>
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
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-3xl font-bold text-white mt-4">৳{{ number_format($totalMonthlyExpenses, 2) }}
                            </p>
                            <p class="text-primary-100 mt-2">total expenses</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <h3 class="text-white font-medium">Per Meal Cost</h3>
                                <span class="p-2 bg-white/20 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01"></path>
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
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Today's Meals</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Monthly Meals</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Expenses Added</th>
                                    @if (Auth::check())
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Your Balance</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($membersOverview as $member)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                                        <span
                                                            class="text-primary-700 font-medium">{{ substr($member->name, 0, 2) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $member->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $member->todays_meals }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $member->monthly_meals }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ৳{{ number_format($member->expenses_added, 2) }}
                                        </td>
                                        @if (Auth::check() && Auth::user()->id === $member->id)
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($member->balance >= 0)
                                                    <span
                                                        class="text-green-600 font-medium">৳{{ number_format($member->balance, 2) }}</span>
                                                @else
                                                    <span
                                                        class="text-red-600 font-medium">-৳{{ number_format(abs($member->balance), 2) }}</span>
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
                @if (Auth::check())
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
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Previous Month Balance</h3>
                                <p
                                    class="text-2xl font-bold {{ $membersOverview->where('id', Auth::id())->first()->previous_balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $membersOverview->where('id', Auth::id())->first()->previous_balance >= 0 ? '৳' : '-৳' }}{{ number_format(abs($membersOverview->where('id', Auth::id())->first()->previous_balance), 2) }}
                                </p>
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Update the Daily Meal Input Section -->
                <section id="daily-meal" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Today's Meal Input</h2>
                            <p class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                        <span class="px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-medium">
                            Current: {{ $todayMeal->meal_count ?? '0' }} meals
                        </span>
                    </div>
                    <form action="{{ route('meals.store') }}" method="POST" class="max-w-md">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Quick Select</label>
                                <div class="grid grid-cols-5 gap-2 mb-4">
                                    @foreach ([0, 0.5, 1, 1.5, 2] as $count)
                                        <button type="button" onclick="selectMealCount('{{ $count }}')"
                                            class="meal-button py-3 rounded-xl border-2 border-gray-200 flex flex-col items-center justify-center hover:border-primary-500 focus:outline-none focus:border-primary-500 transition-all {{ ($todayMeal->meal_count ?? -1) == $count ? 'bg-primary-500 text-white border-primary-500' : '' }}">
                                            <span class="text-lg font-semibold">{{ $count }}</span>
                                            <span class="text-xs mt-1">meal{{ $count != 1 ? 's' : '' }}</span>
                                        </button>
                                    @endforeach
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="relative flex-1">
                                        <input type="number" id="meal_count" name="meal_count" min="0"
                                            max="5" step="0.5"
                                            class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 pl-12 py-3"
                                            value="{{ $todayMeal->meal_count ?? '' }}" placeholder="Custom amount">
                                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                                        <span>Save</span>
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
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
                                        <input type="date" name="date"
                                            class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                            max="{{ date('Y-m-d') }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Meals</label>
                                        <input type="number" name="meal_count" min="0" max="5"
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
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Meals</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($userMealHistory as $meal)
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
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
                                <button type="submit"
                                    class="w-full px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    Add Expense
                                </button>
                            </form>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-4">Recent Expenses</h3>
                            <div class="space-y-4">
                                @foreach ($recentExpenses as $expense)
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium">৳{{ number_format($expense->amount, 2) }}</p>
                                            <p class="text-sm text-gray-500">{{ $expense->description }}</p>
                                            <p class="text-xs text-gray-400">Added by {{ $expense->user->name }}</p>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $expense->date->format('M d, Y') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Calendar Section -->
                <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
                    <!-- Calendar Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 sm:mb-0">Meal Calendar</h2>
                        <div class="flex items-center space-x-4">
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <span class="text-lg font-medium text-gray-700">{{ now()->format('F Y') }}</span>
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Calendar Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                                        <th class="px-2 py-4 text-sm font-semibold text-gray-500 border-b border-gray-200">
                                            {{ $day }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startOfMonth = Carbon\Carbon::now()->startOfMonth();
                                    $endOfMonth = Carbon\Carbon::now()->endOfMonth();
                                    $startingDay = $startOfMonth->dayOfWeek;
                                    $daysInMonth = $startOfMonth->daysInMonth;
                                    $currentDay = 1;
                                    $totalWeeks = ceil(($daysInMonth + $startingDay) / 7);
                                @endphp

                                @for ($week = 0; $week < $totalWeeks; $week++)
                                    <tr>
                                        @for ($dayOfWeek = 0; $dayOfWeek < 7; $dayOfWeek++)
                                            @php
                                                $isValidDay =
                                                    $week * 7 + $dayOfWeek >= $startingDay &&
                                                    $currentDay <= $daysInMonth;
                                                if ($isValidDay) {
                                                    $currentDate = sprintf(
                                                        '%s-%02d',
                                                        $startOfMonth->format('Y-m'),
                                                        $currentDay,
                                                    );
                                                    $dayMeals = $monthlyMealData[$currentDate] ?? [];
                                                    $totalMeals = collect($dayMeals)->sum('meal_count');
                                                    $isToday =
                                                        $currentDay == now()->day &&
                                                        $startOfMonth->month == now()->month;
                                                }
                                            @endphp

                                            <td
                                                class="relative p-3 border border-gray-100 transition-all duration-200
                                                {{ $isValidDay ? ($isToday ? 'bg-primary-50' : 'hover:bg-gray-50') : 'bg-gray-50/50' }}">
                                                @if ($isValidDay)
                                                    <!-- Date number -->
                                                    <div class="flex items-center justify-between mb-3">
                                                        <span
                                                            class="{{ $isToday ? 'bg-primary-600 text-white' : 'text-gray-700' }}
                                                            w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium">
                                                            {{ $currentDay }}
                                                        </span>
                                                        @if (isset($totalMeals) && $totalMeals > 0)
                                                            <span
                                                                class="px-2 py-1 bg-primary-100 text-primary-700 text-xs font-medium rounded-full">
                                                                {{ $totalMeals }} meals
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <!-- Meal entries -->
                                                    <div
                                                        class="space-y-2 overflow-y-auto max-h-24 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-gray-50">
                                                        @foreach ($dayMeals as $meal)
                                                            <div
                                                                class="flex items-center gap-2 p-1.5 rounded-lg bg-white shadow-sm border border-gray-100">
                                                                <span
                                                                    class="w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-medium"
                                                                    style="background-color: {{ '#' . substr(md5($meal->user->name), 0, 6) }};">
                                                                    {{ strtoupper(substr($meal->user->name, 0, 1)) }}
                                                                </span>
                                                                <span class="text-xs text-gray-600 font-medium">
                                                                    {{ $meal->meal_count }}
                                                                    meal{{ $meal->meal_count != 1 ? 's' : '' }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @php
                                                        $currentDay++;
                                                    @endphp
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    <!-- Legend -->
                    {{-- <div class="mt-6 flex flex-wrap items-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-primary-50 border border-primary-100 rounded"></div>
                            <span>Today</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-primary-100 rounded"></div>
                            <span>Has Meals</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-gray-50 border border-gray-100 rounded"></div>
                            <span>No Meals</span>
                        </div>
                    </div> --}}
                </section>
            </div>
        </div>
    </div>
@endsection

<script>
    function selectMealCount(count) {
        // Remove active class from all buttons
        document.querySelectorAll('.meal-button').forEach(button => {
            button.classList.remove('bg-primary-500', 'text-white', 'border-primary-500');
        });

        // Add active class to selected button
        event.currentTarget.classList.add('bg-primary-500', 'text-white', 'border-primary-500');

        // Update input value
        document.getElementById('meal_count').value = count;
    }

    // Add touch feedback
    document.querySelectorAll('button, .meal-button').forEach(element => {
        element.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });

        ['touchend', 'touchcancel'].forEach(event => {
            element.addEventListener(event, function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>

<!-- Update the floating meal input section -->
<div class="lg:hidden fixed bottom-20 right-4 z-50">
    <!-- Floating Action Button -->
    <button onclick="toggleMealOptions()" id="mealToggleButton"
        class="w-16 h-16 bg-primary-600 rounded-full shadow-xl flex items-center justify-center text-white transition-transform duration-200 hover:scale-105">
        <svg class="w-8 h-8 transition-transform duration-200" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" id="toggleIcon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <span
            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center border-2 border-white">
            {{ $todayMeal->meal_count ?? '0' }}
        </span>
    </button>

    <!-- Quick Meal Options -->
    <div id="mealOptions" class="hidden absolute bottom-20 right-0 space-y-3 min-w-[120px]">
        @foreach ([3, 2, 1, 0] as $count)
            <form action="{{ route('meals.store') }}" method="POST">
                @csrf
                <input type="hidden" name="meal_count" value="{{ $count }}">
                <button type="submit"
                    class="h-12 px-5 rounded-full shadow-lg flex items-center justify-end space-x-3 w-full
                               {{ ($todayMeal->meal_count ?? -1) == $count
                                   ? 'bg-primary-600 text-white'
                                   : 'bg-white text-gray-700 hover:bg-gray-50' }}
                               transform transition-all duration-200 hover:scale-105">
                    <span class="text-lg font-semibold">{{ $count }}</span>
                    <span class="text-sm">meal{{ $count != 1 ? 's' : '' }}</span>
                </button>
            </form>
        @endforeach
    </div>
</div>

<!-- Update the script -->
<script>
    let isMealOptionsOpen = false;

    function toggleMealOptions() {
        isMealOptionsOpen = !isMealOptionsOpen;
        const optionsContainer = document.getElementById('mealOptions');
        const icon = document.getElementById('toggleIcon');
        const button = document.getElementById('mealToggleButton');

        if (isMealOptionsOpen) {
            // Show options
            optionsContainer.classList.remove('hidden');
            icon.classList.add('rotate-45');
            button.classList.add('bg-red-500');

            // Add backdrop with fade
            const backdrop = document.createElement('div');
            backdrop.id = 'mealBackdrop';
            backdrop.className = 'fixed inset-0 bg-black bg-opacity-0 z-40 transition-opacity duration-300';
            backdrop.onclick = toggleMealOptions;
            document.body.appendChild(backdrop);

            // Animate backdrop
            setTimeout(() => {
                backdrop.classList.add('bg-opacity-25');
            }, 10);

            // Animate options
            const optionButtons = document.querySelectorAll('#mealOptions form button');
            optionButtons.forEach((option, index) => {
                setTimeout(() => {
                    option.classList.add('translate-x-0');
                    option.classList.remove('translate-x-12');
                }, index * 50);
            });

        } else {
            // Hide options
            icon.classList.remove('rotate-45');
            button.classList.remove('bg-red-500');

            // Animate options out
            const optionButtons = document.querySelectorAll('#mealOptions form button');
            optionButtons.forEach((option, index) => {
                setTimeout(() => {
                    option.classList.remove('translate-x-0');
                    option.classList.add('translate-x-12');
                }, index * 50);
            });

            // Fade out backdrop
            const backdrop = document.getElementById('mealBackdrop');
            if (backdrop) {
                backdrop.classList.remove('bg-opacity-25');
                setTimeout(() => backdrop.remove(), 300);
            }

            // Hide options container after animation
            setTimeout(() => {
                optionsContainer.classList.add('hidden');
            }, 300);
        }
    }

    // Add smooth close on scroll
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > lastScroll && isMealOptionsOpen) {
            toggleMealOptions();
        }
        lastScroll = currentScroll;
    });

    // Add haptic feedback
    document.querySelectorAll('#mealOptions button').forEach(button => {
        button.addEventListener('click', () => {
            if ('vibrate' in navigator) {
                navigator.vibrate(10);
            }
        });
    });
</script>
