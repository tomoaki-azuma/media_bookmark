<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUrlsBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
           $table->text('comment')->change();
           $table->integer('view_cnt');
           $table->integer('favorite_cnt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
           $table->text('comment',255)->change();
           $table->dropColumn('view_cnt');
           $table->dropColumn('favorite_cnt');
        });
    }
}