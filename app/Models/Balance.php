<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'year',
        'previous_balance',
        'current_balance',
        'total_meals',
        'total_expenses',
        'is_settled'
    ];

    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
        'is_settled' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
