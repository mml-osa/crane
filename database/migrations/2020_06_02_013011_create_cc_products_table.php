<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateCcProductsTable extends Migration
  {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cc_products', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('title', 191)->unique();
        $table->string('alias', 191)->unique();
        $table->uuid('cat_id');
        $table->text('caption')->nullable(true);
        $table->text('content')->nullable(true);
        $table->integer('price');
        $table->integer('discount')->default(0);
        $table->date('promo_start')->nullable();
        $table->date('promo_end')->nullable();
        $table->integer('quantity');
        $table->tinyInteger('featured')->default(0);
        $table->uuid('visibility_id')->nullable();
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
      Schema::dropIfExists('cc_products');
    }
  }
