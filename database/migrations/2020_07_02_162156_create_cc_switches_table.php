<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Auth\User;
use App\Models\Setting\CcSwitch;

class CreateCcSwitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_switches', function (Blueprint $table) {
            $table->id();
            $table->string('switch',15);
            $table->uuid('create_id')->nullable();
            $table->uuid('update_id')->nullable();
            $table->timestamps();
        });

        $User = User::ordered()->first();
        //Insert Data Into The Database
        CcSwitch::create(['switch'=>'No']);
        CcSwitch::create(['switch'=>'Yes']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_switches');
    }
}
