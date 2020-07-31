<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('uid')->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('dimensions')->nullable();
            $table->unsignedTinyInteger('img_position')->nullable();
            $table->unsignedTinyInteger('img_scale')->nullable();
            $table->string('footer_details')->nullable();
            $table->unsignedTinyInteger('page_number_position')->nullable()->default(0);
            $table->unsignedTinyInteger('add_blank_pages')->nullable()->default(0);
            $table->unsignedSmallInteger('total_pages')->nullable();
            $table->unsignedBigInteger('total_size')->nullable();
            $table->string('pdf')->nullable();
            $table->string('ppt')->nullable();
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
        Schema::dropIfExists('books');
    }
}
