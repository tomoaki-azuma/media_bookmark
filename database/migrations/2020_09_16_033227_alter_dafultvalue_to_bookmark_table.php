<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDafultvalueToBookmarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
           $table->integer('view_cnt')->default(0)->change();
           $table->integer('favorite_cnt')->default(0)->change();
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
           $table->integer('view_cnt')->nullable()->change(); 
           $table->integer('favorite_cnt')->nullable()->change();
        });
    }
}
