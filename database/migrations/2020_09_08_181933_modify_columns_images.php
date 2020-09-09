<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
          $table->renameColumn('disk', 's3_disk');
          $table->renameColumn('folder', 's3_directory');
          // As a workaround to a fail convertin to tinyInteger, I convert it to SmallInt first.
          $table->unsignedSmallInteger('solution')->unsignedTinyInteger('solution')->nullable()->change();
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
          $table->renameColumn('s3_disk', 'disk');
          $table->renameColumn('s3_directory', 'folder');
          $table->string('solution')->nullable()->change();
        });
    }
}
