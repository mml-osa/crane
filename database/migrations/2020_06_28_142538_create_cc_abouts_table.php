<?php

    use App\Models\Auth\User;
    use App\Models\Profile\CcAbout;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_abouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',191)->nullable()->unique();
            $table->string('alias',191)->nullable()->unique();
            $table->text('tag')->nullable();
            $table->text('caption')->nullable();
            $table->text('about')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('objective')->nullable();
            $table->text('goals')->nullable();
            $table->text('values')->nullable();
            $table->text('keywords')->nullable();
            $table->text('author')->nullable();
            $table->string('revised',55)->nullable();
            $table->uuid('create_id')->nullable();
            $table->uuid('update_id')->nullable();
            $table->timestamps();
        });

        $User = User::ordered()->first();
        //Insert Data Into The Database
        CcAbout::create(['title'=>'Company Name','alias'=>'company-name']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cc_abouts');
    }
}
