<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcTeamCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_team_categories', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->string('title',55)->unique();
           $table->string('alias',55)->unique();
           $table->text('caption')->nullable();
           $table->text('description')->nullable();
           $table->tinyInteger('published')->default(1)->unsigned();
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
        Schema::dropIfExists('cc_team_categories');
    }
}
