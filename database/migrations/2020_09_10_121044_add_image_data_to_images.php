<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageDataToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
          $table->string('show_name')->after('name')->nullable();
          $table->string('type')->after('show_name')->nullable();
          $table->unsignedInteger('size')->after('type')->nullable();
          $table->renameColumn('name', 'file_name');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
          $table->renameColumn('file_name', 'name');
          $table->dropColumn('show_name');
          $table->dropColumn('type');
          $table->dropColumn('size');
        });
    }
}
