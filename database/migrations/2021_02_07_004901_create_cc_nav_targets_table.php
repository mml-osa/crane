<?php

use App\Models\Auth\User;
use \App\Models\Nav\CcNavTarget;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcNavTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_nav_targets', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->string('title',191)->unique();
           $table->string('alias',191)->unique();
           $table->text('code');
           $table->tinyInteger('published')->unsigned()->default(1);
           $table->uuid('create_id')->nullable();
           $table->uuid('update_id')->nullable();
           $table->timestamps();
        });
   
       $User = User::ordered()->first();
       //Insert Data Into The Database
       CcNavTarget::create(['title'=>'New Window','alias'=>'new-window','code'=>'_blank','published'=>1]);
       CcNavTarget::create(['title'=>'Parent','alias'=>'parent','code'=>'_parent','published'=>1]);
       CcNavTarget::create(['title'=>'Self','alias'=>'self','code'=>'_self','published'=>1]);
       CcNavTarget::create(['title'=>'Top','alias'=>'top','code'=>'_top','published'=>1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_nav_targets');
    }
}
