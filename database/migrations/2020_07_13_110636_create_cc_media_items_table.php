<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcMediaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_media_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('album_id');
            $table->text('title')->nullable();
            $table->text('alias')->nullable();
            $table->text('caption')->nullable();
            $table->text('content')->nullable();
            $table->text('url')->nullable();
            $table->text('file')->nullable();
            $table->tinyInteger('published')->default(1)->unsigned();
            $table->uuid('create_id');
            $table->uuid('update_id');
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
        Schema::dropIfExists('cc_media_items');
    }
}
