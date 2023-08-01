<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('position')->nullable();
            $table->uuid('cat_id')->nullable();
            $table->string('email',191)->unique()->nullable();
            $table->text('bio')->nullable();
            $table->string('phone',35)->unique()->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linked')->nullable();
            $table->text('youtube')->nullable();
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
        Schema::dropIfExists('cc_teams');
    }
}
