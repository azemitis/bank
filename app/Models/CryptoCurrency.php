<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'price_bought',
        'amount',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
