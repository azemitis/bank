<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'sender_account_id',
        'recipient_account_id',
        'user_id',
        'amount_received',
        'currency_rate'
    ];

    public function senderAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'sender_account_id')->withTrashed();
    }

    public function recipientAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'recipient_account_id')->withTrashed();
    }
}
