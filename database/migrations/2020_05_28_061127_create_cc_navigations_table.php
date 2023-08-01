<?php

use App\Models\Auth\User;
use App\Models\Nav\CcNav;
use App\Models\Pages\CcPage;
use App\Models\Nav\CcNavCat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcNavigationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_navigations');
    Schema::create('cc_navs', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->uuid('cat_id')->nullable(false);
      $table->foreign('cat_id')->references('id')->on('cc_pages_categories')->cascadeOnDelete()->cascadeOnUpdate();
      $table->string('title', 225)->unique()->nullable(false);
      $table->string('alias', 225)->nullable(false);
      $table->string('route', 225)->nullable(false);
      $table->string('url', 191)->unique()->nullable(false);
      $table->boolean('is_sub')->default(false);
      $table->uuid('parent_id')->nullable(true);
      $table->uuid('page_id')->nullable(false);
      $table->tinyInteger('nav_order')->nullable(true)->default(0);
      $table->tinyInteger('target_id')->nullable(true)->unsigned()->default(0);
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
    Schema::dropIfExists('cc_navigations');
  }
}
