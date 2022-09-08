<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanEmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_emis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_requests_id')->constrained()->cascadeOnDelete();
            $table->date('emi_date');
            $table->integer('emi_number')->unsigned()->nullable();
            $table->double('emi_amount',15,2);
            $table->double('rate_of_interest',15,2);
            $table->double('remaining_amount',15,2);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('loan_emis');
    }
}
