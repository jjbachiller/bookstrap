<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentperpageToSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->unsignedTinyInteger('images_per_page')->after('image_name_as_title')->nullable()->default(1);
            $table->unsignedTinyInteger('solutions_per_page')->after('solutions_name_as_title')->nullable()->default(1);
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
            $table->dropColumn('images_per_page');
            $table->dropColumn('solutions_per_page');
        });
    }
}
