<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_distributions', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amount')->nullable($value = true);
            $table->decimal('max_amount')->nullable($value = true);
            $table->integer('period')->nullable($value = true);
            $table->integer('order')->nullable($value = true);
            $table->integer('visible')->nullable($value = true);
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
        Schema::dropIfExists('loan_distributions');
    }
}
