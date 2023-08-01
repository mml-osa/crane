<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post\CcPostCategory;
use App\Models\Auth\User;

class CreateCcPostCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_post_categories');
    Schema::create('cc_post_categories', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->string('title', 191)->unique()->nullable(false);
      $table->string('alias', 191)->nullable(false);
      $table->text('caption')->nullable(true);
      $table->text('description')->nullable(true);
      $table->tinyInteger('published')->default(1)->unsigned();
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
    Schema::dropIfExists('cc_post_categories');
  }
}
