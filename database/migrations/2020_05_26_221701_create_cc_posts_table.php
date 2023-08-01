<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_posts');
    Schema::create('cc_posts', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->uuid('cat_id')->nullable(false);
      $table->foreign('cat_id')->references('id')->on('cc_post_categories')->cascadeOnDelete()->cascadeOnUpdate();
      $table->text('title')->nullable(false);
      $table->text('alias')->nullable(false);
      $table->text('caption')->nullable(true);
      $table->text('content')->nullable(true);
      $table->text('link')->nullable(true);
      $table->text('file')->nullable(true);
      $table->integer('views')->default(0);
      $table->uuid('visibility_id')->nullable(false);
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
    Schema::dropIfExists('cc_posts');
  }
}
