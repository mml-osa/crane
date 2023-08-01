<?php

use App\Models\Auth\User;
use App\Models\Select\CcVisibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcVisibilitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('cc_visibilities');
    Schema::create('cc_visibilities', function (Blueprint $table) {
      $table->uuid('id')->primary()->nullable(false);
      $table->string('title', 25)->unique()->nullable(false);
      $table->string('alias', 25)->nullable(false);
      $table->text('description')->nullable(true);
      $table->timestamps();
    });

    CcVisibility::create(['title' => 'Public', 'alias' => 'public', 'description' => 'Visible to everyone']);
    CcVisibility::create(['title' => 'Private', 'alias' => 'private', 'description' => 'Only visible to site admins and editors']);
    CcVisibility::create(['title' => 'Password Protected', 'alias' => 'password-protected', 'description' => 'Protected with a password you choose']);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cc_visibilities');
  }
}
