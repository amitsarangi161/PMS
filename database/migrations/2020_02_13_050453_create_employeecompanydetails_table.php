<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeecompanydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeecompanydetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id',22)->nullable();
            $table->string('remarks',20)->nullable();
            $table->string('completionyear',22)->nullable();
            $table->string('location',22)->nullable();
            $table->string('reportingto',22)->nullable();
            $table->string('skillsets',22)->nullable();
            $table->string('ofcemail',100)->nullable();
            $table->string('department',52)->nullable();
            $table->string('cugmob',20)->nullable();
            $table->string('designation',52)->nullable();
            $table->date('dateofjoining')->nullable();
            $table->date('dateofconfirmation')->nullable();
            $table->string('joinsalary',52)->nullable();
            $table->string('totalyrexprnc',52)->nullable();
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
        Schema::dropIfExists('employeecompanydetails');
    }
}
