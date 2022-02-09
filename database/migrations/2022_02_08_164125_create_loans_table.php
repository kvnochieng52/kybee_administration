<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable($value = true);
            $table->integer('loan_distribution_id')->nullable($value = true);
            $table->decimal('total_amount')->nullable($value = true);
            $table->decimal('disbursed')->nullable($value = true);
            $table->decimal('interest')->nullable($value = true);
            $table->decimal('commission')->nullable($value = true);
            $table->decimal('amount_paid')->nullable($value = true);
            $table->decimal('balance')->nullable($value = true);
            $table->date('application_date')->nullable($value = true);
            $table->date('due_date')->nullable($value = true);
            $table->string('repayment_status_id')->nullable($value = true);
            $table->string('loan_status_id')->nullable($value = true);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('loans');
    }
}
