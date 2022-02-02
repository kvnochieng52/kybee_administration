<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable($value = true);
            $table->string('first_name')->nullable($value = true);
            $table->string('middle_name')->nullable($value = true);
            $table->string('last_name')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->text('id_number')->nullable($value = true);
            $table->date('date_of_birth')->nullable($value = true);
            $table->integer('marital_status_id')->nullable($value = true);
            $table->integer('gender_id')->nullable($value = true);
            $table->integer('education_level_id')->nullable($value = true);
            $table->integer('employment_status_id')->nullable($value = true);
            $table->integer('salary_range')->nullable($value = true);
            $table->integer('outstanding_loan_status')->nullable($value = true);
            $table->bigInteger('county_id')->nullable($value = true);
            $table->text('home_address')->nullable($value = true);
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
        Schema::dropIfExists('user_details');
    }
}
