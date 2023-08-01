<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcPostCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_post_comments');
    Schema::create('cc_post_comments', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->uuid('user_id')->nullable(false);
      $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
      $table->uuid('post_id')->nullable(false);
      $table->foreign('post_id')->references('id')->on('cc_posts')->cascadeOnDelete()->cascadeOnUpdate();
      $table->text('comment')->nullable(false);
      $table->boolean('reply')->default(false);
      $table->boolean('approved')->default(false);
      $table->uuid('approved_by')->nullable(false);
      $table->foreign('approved_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
      $table->boolean('published')->default(false);
      $table->uuid('created_by')->nullable(false);
      $table->uuid('updated_by')->nullable(true);
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cc_post_comments');
  }
}
