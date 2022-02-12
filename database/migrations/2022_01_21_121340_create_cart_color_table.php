<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_color', function (Blueprint $table) {
            $table->id();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();


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
        Schema::table('cart_color', function (Blueprint $table) {
            $table->dropForeign("cart_color_color_id_foreign");
            $table->dropForeign("cart_color_cart_id_foreign");
        });
        Schema::dropIfExists('cart_color');
    }
}
