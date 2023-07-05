<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->decimal('currency_rate', 10, 2)->default(0);
            $table->decimal('amount_received', 10, 2)->default(0);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sender_account_id')
                ->nullable()
                ->constrained('accounts')
                ->onDelete('set null');
            $table->foreignId('recipient_account_id')
                ->nullable()
                ->constrained('accounts')
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
