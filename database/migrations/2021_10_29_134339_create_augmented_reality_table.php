<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAugmentedRealityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('augmented_realities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("marker_id");
            $table->string("marker_file_url");
            $table->string("content_file_url");
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
        Schema::dropIfExists('augmented_reality');
    }
}
