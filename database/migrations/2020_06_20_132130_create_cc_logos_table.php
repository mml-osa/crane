<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_logos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',191)->nullable()->unique();
            $table->string('alias',191)->nullable()->unique();
            $table->string('img',35)->nullable();
            $table->tinyInteger('favicon')->default(0);
            $table->tinyInteger('published')->default(0);
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
        Schema::dropIfExists('cc_logos');
    }
}
