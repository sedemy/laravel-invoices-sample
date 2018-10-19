<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_invoice')->unsigned();
            $table->foreign('item_invoice')->references('id')->on('invoices')->onDelete('cascade');
            
            $table->integer('item_product')->unsigned();
            $table->foreign('item_product')->references('id')->on('products')->onDelete('cascade');

            $table->integer('item_qty')->nullable();
            $table->float('item_price',8,2)->nullable();
            $table->integer('item_total')->nullable();
            
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
        Schema::dropIfExists('items');
    }
}
