<?php

use App\Models\Auth\User;
use App\Models\Nav\CcNavCat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcNavigationCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_navigation_categories');
    Schema::create('cc_nav_cats', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('title', 191)->unique()->nullable(false);
      $table->string('alias', 191)->unique()->nullable(false);
      $table->text('description')->nullable()->nullable(true);
      $table->boolean('published')->default(true);
      $table->timestampsTz();
    });

    //Insert Data Into The Database
    CcNavCat::create(['title' => 'Main', 'alias' => 'main', 'Description' => 'This navigation category is the main navigation for the website']);
    CcNavCat::create(['title' => 'Footer', 'alias' => 'footer', 'Description' => 'This navigation category is the footer navigation for the website']);
    CcNavCat::create(['title' => 'Sidebar', 'alias' => 'sidebar', 'Description' => 'This navigation category is the sidebar navigation for the website']);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cc_navigation_categories');
  }
}
