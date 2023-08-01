<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('users');
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->string('username', 225)->unique()->nullable(false);
      $table->string('email', 225)->unique()->nullable(false);
      $table->timestamp('email_verified_at')->nullable(true);
      $table->string('password', 55)->nullable(false);
      $table->uuid('role_id')->nullable(true);
      $table->foreign('role_id')->references('id')->on('cc_roles')->cascadeOnDelete()->cascadeOnUpdate();
      $table->boolean('active')->default(false);
      $table->uuid('created_by')->nullable(false);
      $table->uuid('updated_by')->nullable(true);
      $table->rememberToken();
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
    Schema::dropIfExists('users');
  }
}
