<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('subtotal');
            $table->decimal('discount')->default(0);
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('mobile');
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->enum('status',['ordered','delivered','canceled']);
            $table->boolean('is_shipping_different')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
