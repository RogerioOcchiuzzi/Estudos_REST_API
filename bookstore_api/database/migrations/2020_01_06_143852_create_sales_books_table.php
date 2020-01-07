<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_books', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('sale_id')->references('id')->on('sales');
        $table->integer('book_id')->references('id')->on('books');
        $table->smallInteger('amount')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_books');
    }
}
