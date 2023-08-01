<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Auth\User;
use App\Models\Select\CcRole;

class CreateCcRolesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_roles');
    Schema::create('cc_roles', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->string('title', 25)->unique()->unique()->nullable(false);
      $table->string('alias', 25)->unique()->nullable(false);
      $table->text('description')->nullable(true);
      $table->boolean('active')->default(true);
      $table->timestampsTz();
    });

    //Insert Data Into The Database
    CcRole::create(['title' => 'Administrator', 'alias' => 'administrator', 'description' => 'Can manage every aspects of the system. They can: create edit and delete user accounts and account details, create, publish, edit and delete posts and other content on the website, respond to and delete comments on the website, create ads, see which admin created a post or comment, view insights, and assign user roles, activate and deactivate user accounts, manage content manager settings']);
    CcRole::create(['title' => 'Editor', 'alias' => 'editor', 'description' => 'Can create and edit and delete posts and publish on the website, respond to comments on the website, create ads and other posts, see which admin created a post or comment, view other page statistics, view user account details and edit them']);
    CcRole::create(['title' => 'Moderator', 'alias' => 'moderator', 'description' => 'Can create and edit posts and publish on the website, respond to comments on the website, create ads, view other page statistics']);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cc_roles');
  }
}