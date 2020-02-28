<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeename',100)->nullable();
            $table->date('dob')->nullable();
            $table->string('email',100)->nullable();
            $table->string('qualification',50)->nullable();
            $table->string('fathername',50)->nullable();
            $table->string('empcodeno',50)->nullable();
            $table->string('maritalstatus',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('experencecomp',50)->nullable();
            $table->string('totalyearexperience',50)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('adharno',15)->nullable();
            $table->string('bloodgroup',15)->nullable();
            $table->string('alternativephonenumber',15)->nullable();
            $table->text('presentaddress')->nullable();
            $table->text('permanentaddress')->nullable();
            $table->string('status',30)->default('PRESENT');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeedetails');
    }
}
