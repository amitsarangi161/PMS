<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockentries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id',22)->nullable();
            $table->date('date')->nullable();
            $table->string('unitrate',100)->nullable();
            $table->string('quantity',400)->nullable();
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
        Schema::dropIfExists('stockentries');
    }
}
