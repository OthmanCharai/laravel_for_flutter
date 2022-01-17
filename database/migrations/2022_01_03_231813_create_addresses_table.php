<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->text("city");
            $table->text("region");
            $table->text("details");
            $table->text("notes");
            $table->text("latitude");
            $table->text("longitude");
            $table->foreignId("user_id")->constrained()->onDelete("CASCADE")->onUpdate("CASCADE");
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
        Schema::table('addresses', function (Blueprint $table) {
                $table->dropForeign("addresses_user_id_foreign");
        });
        Schema::dropIfExists('addresses');
    }
}
