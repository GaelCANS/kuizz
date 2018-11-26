<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuizzTableParameters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            $table->boolean('display_responses')->default(false);
            $table->boolean('single_response')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            $table->dropColumn('display_responses');
            $table->dropColumn('single_response');
        });
    }
}
