<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_number',
        'currency',
        'user_id',
        'from_account',
        'balance',
        'rate',
        'term',
        'amount',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
