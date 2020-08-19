<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmemberfieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('amember_id')->after('updated_at')->nullable();
          $table->string('subscription_type')->after('amember_id')->nullable();
          $table->timestamp('subscribed_until')->after('subscription_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('amember_id');
            $table->dropColumn('subscription_type');
            $table->dropColumn('subscribed_until');
        });
    }
}
