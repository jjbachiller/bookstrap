<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolutionsToSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
          $table->string('solutions_title')->after('image_name_as_title')->nullable();
          $table->unsignedTinyInteger('solutions_header')->after('solutions_title')->nullable()->default(0);
          $table->unsignedTinyInteger('solutions_name_as_title')->after('solutions_header')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('solutions_title');
            $table->dropColumn('solutions_header');
            $table->dropColumn('solutions_name_as_title');
        });
    }
}
