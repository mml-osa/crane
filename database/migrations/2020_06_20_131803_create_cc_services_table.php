<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cat_id');
            $table->string('name',191)->unique();
            $table->string('title',191)->unique();
            $table->string('alias',191)->unique();
            $table->text('caption')->nullable();
            $table->text('content')->nullable();
            $table->text('link')->nullable();
            $table->text('file')->nullable();
            $table->uuid('visibility_id')->nullable();
            $table->tinyInteger('published')->default(0)->unsigned();
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
        Schema::dropIfExists('cc_services');
    }
}
