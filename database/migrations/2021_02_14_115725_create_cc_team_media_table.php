<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcTeamMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_team_media', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->uuid('item_id');
           $table->uuid('team_id');
           $table->uuid('type_id');
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
        Schema::dropIfExists('cc_team_media');
    }
}
