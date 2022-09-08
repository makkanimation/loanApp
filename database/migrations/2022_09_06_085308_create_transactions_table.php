<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_emis_id')->constrained()->cascadeOnDelete();
            $table->foreignId('loan_requests_id')->constrained()->cascadeOnDelete();
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->foreignId('users_id')->constrained()->cascadeOnDelete();
            $table->string('payment_method')->nullable();
            $table->date('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
