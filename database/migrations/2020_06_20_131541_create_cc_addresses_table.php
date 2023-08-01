<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',191)->nullable()->unique();
            $table->string('alias',191)->nullable()->unique();
            $table->text('address')->nullable();
            $table->text('postal')->nullable();
            $table->text('city')->nullable();
            $table->uuid('country')->nullable();
            $table->text('map')->nullable();
            $table->tinyInteger('main')->unsigned()->default(0);
            $table->tinyInteger('published')->unsigned()->default(0);
            $table->uuid('create_id');
            $table->uuid('update_id')->nullable();
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
        Schema::dropIfExists('cc_addresses');
    }
}
