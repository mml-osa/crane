<?php

use App\Models\Auth\User;
use App\Models\Pages\CcPage;
use App\Models\Pages\CcPagesCategory;
use App\Models\Select\CcVisibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcPagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_pages');
    Schema::create('cc_pages', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('title', 225)->unique()->nullable(true);
      $table->string('alias', 225)->unique();
      $table->string('seo_name', 225)->unique()->nullable(true);
      $table->uuid('cat_id')->nullable(true);
      $table->foreign('cat_id')->references('id')->on('cc_pages_categories')->cascadeOnDelete()->cascadeOnUpdate();
      $table->text('caption')->nullable(true);
      $table->text('description')->nullable(true);
      $table->uuid('visibility_id')->nullable(true);
      $table->foreign('visibility_id')->references('id')->on('cc_visibilities')->cascadeOnDelete()->cascadeOnUpdate();
      $table->string('password', 191)->nullable(true);
      $table->tinyInteger('published')->unsigned()->default(0);
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
    Schema::dropIfExists('cc_pages');
  }
}
