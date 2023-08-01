<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcProductSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_product_sub_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cat_id');
            $table->string('title',191)->unique();
            $table->string('alias',191)->unique();
            $table->integer('discount')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('published')->unsigned()->default(1);
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
        Schema::dropIfExists('cc_product_sub_categories');
    }
}
