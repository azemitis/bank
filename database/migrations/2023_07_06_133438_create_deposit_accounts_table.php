<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('deposit_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('currency')->default('EUR');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 12, 2)->default(0);
            $table->decimal('rate', 6, 2);
            $table->integer('term');
            $table->foreignId('from_account')->constrained('accounts')->onDelete('cascade');
            $table->decimal('amount', 12, 2)->nullable();
            $table->decimal('amount_with_interests', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deposit_accounts');
    }
}
