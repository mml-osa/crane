<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcUserProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_user_profiles');
    Schema::create('cc_user_profiles', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->uuid('user_id')->unique()->nullable(false);
      $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
      $table->string('first_name', 191)->nullable(false);
      $table->string('last_name', 191)->nullable(true);
      $table->text('bio')->nullable(true);
      $table->string('avatar', 35)->nullable(true);
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
    Schema::dropIfExists('cc_user_profiles');
  }
}
