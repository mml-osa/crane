<?php

    use App\Models\Auth\User;
    use App\Models\Media\CcMediaType;
    use App\Models\Setting\CcSwitch;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcMediaTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_media_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',25)->unique();
            $table->string('alias',25)->unique();
            $table->text('description')->nullable();
            $table->uuid('create_id')->nullable();
            $table->uuid('update_id')->nullable();
            $table->timestamps();
        });

        $User = User::ordered()->first();
        //Insert Data Into The Database
        CcMediaType::create(['title'=>'Image','alias'=>'image','description'=>'Image File Type']);
        CcMediaType::create(['title'=>'Audio','alias'=>'audio','description'=>'Audio File Type']);
        CcMediaType::create(['title'=>'Video','alias'=>'video','description'=>'Video File Type']);
        CcMediaType::create(['title'=>'Document','alias'=>'document','description'=>'Document File Type']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_media_types');
    }
}
