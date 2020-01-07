<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuizzTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            $table->boolean('shuffle')->default(0);
            $table->tinyInteger('howmuch');
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
            $table->dropColumn("shuffle");
            $table->dropColumn("howmuch");
        });
    }
}
