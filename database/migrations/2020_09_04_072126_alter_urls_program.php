<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUrlsProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program', function (Blueprint $table) {
           $table->text('url')->change();
           $table->text('thumbnail_img')->change();
           $table->text('comment')->change();
           $table->integer('bookmark_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program', function (Blueprint $table) {
           $table->text('url',255)->change();
           $table->text('thumbnail_img',255)->change();
           $table->text('comment',255)->change();
           $table->text('bookmark_id',255)->change();
        });
    }
}
