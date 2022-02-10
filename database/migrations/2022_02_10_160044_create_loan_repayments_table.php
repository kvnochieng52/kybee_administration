<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->nullable($value = true);
            $table->decimal('paid_amount')->nullable($value = true);
            $table->text('mpesa_code')->nullable($value = true);
            $table->string('account_number')->nullable($value = true);
            $table->string('msisdn')->nullable($value = true);
            $table->decimal('org_balance')->nullable($value = true);
            $table->date('date_paid')->nullable($value = true);
            $table->bigInteger('user_id')->nullable($value = true);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
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
        Schema::dropIfExists('loan_repayments');
    }
}
