<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cat_id');
            $table->text('title');
            $table->text('alias');
            $table->text('caption')->nullable();
            $table->text('content')->nullable();
            $table->text('location')->nullable();
            $table->text('organizer')->nullable();
            $table->string('start_date',25)->nullable();
            $table->string('end_date',25)->nullable();
            $table->string('start_time',25)->nullable();
            $table->string('end_time',25)->nullable();
            $table->string('phone',35)->nullable();
            $table->string('email',191)->nullable();
            $table->tinyInteger('current')->default(0);
            $table->tinyInteger('expired')->default(0);
            $table->text('link')->nullable();
            $table->tinyInteger('views')->default(0)->unsigned();
            $table->string('view_id',65)->nullable();
            $table->uuid('visibility_id')->nullable();
            $table->tinyInteger('published')->default(0)->unsigned();
            $table->uuid('create_id');
            $table->uuid('update_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_events');
    }
}
