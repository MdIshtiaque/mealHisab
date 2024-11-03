<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('previous_balance', 10, 2)->default(0);
            $table->decimal('current_balance', 10, 2)->default(0);
            $table->decimal('total_meals', 8, 1)->default(0);
            $table->decimal('total_expenses', 10, 2)->default(0);
            $table->boolean('is_settled')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'month', 'year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('balances');
    }
};
