<?php

    use App\Models\Auth\User;
    use App\Models\Setting\CcLanding;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_landings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('control')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->string('bg',35)->nullable();
            $table->uuid('create_id')->nullable();
            $table->uuid('update_id')->nullable();
            $table->timestamps();
        });

        $User = User::ordered()->first();
        //Insert Data Into The Database
        CcLanding::create(['control'=>'landing','state'=>'1']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_landings');
    }
}
