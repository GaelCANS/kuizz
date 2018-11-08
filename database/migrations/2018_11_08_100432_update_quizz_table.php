<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuizzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzs', function (Blueprint $table) {
            $table->dropColumn('template');
            $table->integer('template_id');
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
            $table->string('template');
            $table->dropColumn('template_id');
        });
    }
}
