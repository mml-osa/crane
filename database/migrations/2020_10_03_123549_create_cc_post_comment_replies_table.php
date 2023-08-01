<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcPostCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_post_comment_replies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('comment_id');
            $table->text('name');
            $table->string('email',191)->nullable()->unique();
            $table->text('location')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('published')->default(0)->unsigned();
            $table->string('avatar',55)->nullable();
            $table->uuid('create_id')->nullable();
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
        Schema::dropIfExists('cc_post_comment_replies');
    }
}
