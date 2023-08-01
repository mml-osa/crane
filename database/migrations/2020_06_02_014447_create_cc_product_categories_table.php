<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcProductCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_product_categories');
    Schema::create('cc_product_categories', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('cat_id')->nullable();
      $table->string('title', 191)->unique();
      $table->string('alias', 191)->unique();
      $table->string('caption', 191)->nullable(true);
      $table->text('content')->nullable(true);
      $table->integer('discount')->nullable();
      $table->dateTime('promo')->nullable();
      $table->tinyInteger('featured')->default(0);
      $table->tinyInteger('published')->unsigned()->default(1);
      $table->uuid('create_id');
      $table->uuid('update_id')->nullable();
      $table->timestamps();
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
    Schema::dropIfExists('cc_product_categories');
  }
}
