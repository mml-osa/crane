<?php
   
   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;
   use \App\Models\Media\CcMediaAlbum;
   use \App\Models\Media\CcMediaType;
   
   class CreateCcMediaAlbumsTable extends Migration
   {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
         Schema::create('cc_media_albums', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 191)->unique();
            $table->string('alias', 191)->unique();
            $table->uuid('type_id');
            $table->tinyInteger('sub')->default(0)->unsigned();
            $table->uuid('sub_id')->nullable();
            $table->tinyInteger('published')->default(0)->unsigned();
            $table->uuid('create_id')->nullable();
            $table->uuid('update_id')->nullable();
            $table->timestamps();
         });
         
         $mediaType = CcMediaType::where('alias','image')->first();
         CcMediaAlbum::create(['title' => 'Landing', 'alias' => 'landing', 'type_id' => $mediaType->id, 'published' => 1]);
    }
      
      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
         Schema::dropIfExists('cc_media_albums');
      }
   }
