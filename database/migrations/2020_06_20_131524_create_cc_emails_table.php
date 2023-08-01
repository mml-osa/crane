<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_emails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',191)->nullable()->unique();
            $table->string('alias',191)->nullable()->unique();
            $table->string('email',191)->nullable()->unique();
            $table->tinyInteger('main')->default(0);
            $table->tinyInteger('mail')->default(0);
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
        Schema::dropIfExists('cc_emails');
    }
}
