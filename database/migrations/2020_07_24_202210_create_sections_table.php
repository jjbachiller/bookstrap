<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('book_id')->nullable();
            $table->string('title')->nullable();
            $table->unsignedTinyInteger('header')->nullable()->default(0);
            $table->unsignedSmallInteger('order')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->unsignedInteger('pages_count')->nullable();
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
        Schema::dropIfExists('sections');
    }
}
