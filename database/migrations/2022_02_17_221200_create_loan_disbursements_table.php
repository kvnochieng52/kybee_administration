<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_disbursements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->nullable($value = true);
            $table->decimal('amount_sent')->nullable($value = true);
            $table->text('mpesa_code')->nullable($value = true);
            $table->string('receiver_phone')->nullable($value = true);
            $table->decimal('b2c_utility_bal')->nullable($value = true);
            $table->decimal('b2c_working_bal')->nullable($value = true);
            $table->date('date_sent')->nullable($value = true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_disbursements');
    }
}
