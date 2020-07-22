<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'title' => 'Coten Radio',
            'comment' => 'Coten Radio You tube bookmark.',
            'share_token' => '',
            'created_at' => new DateTime(),
        ];
        DB::table('bookmarks')->insert($param);
        $param = [
            'user_id' => 1,
            'title' => 'Green Jacket',
            'comment' => 'Green Jacket You tube bookmark.',
            'share_token' => '',
            'created_at' => new DateTime()
        ];
        DB::table('bookmarks')->insert($param);
        $param = [
            'user_id' => 1,
            'title' => 'Hikakin TV',
            'comment' => 'HikakinTV You tube bookmark.',
            'share_token' => '',
            'created_at' => new DateTime()
        ];
        DB::table('bookmarks')->insert($param);
        $param = [
            'user_id' => 2,
            'title' => 'Suehirogaris',
            'comment' => 'すえひろがりず You tube bookmark.',
            'share_token' => '',
            'created_at' => new DateTime()
        ];
        DB::table('bookmarks')->insert($param);
        $param = [
            'user_id' => 2,
            'title' => 'あさぎーにょ',
            'comment' => 'ちはるさんのあさぎーにょチャンネル',
            'share_token' => '',
            'created_at' => new DateTime()
        ];
        DB::table('bookmarks')->insert($param);
        $param = [
            'user_id' => 1,
            'title' => '大橋トリオ',
            'comment' => '大橋トリオ　You tubeチャンネル.',
            'share_token' => '',
            'created_at' => new DateTime()
        ];
        DB::table('bookmarks')->insert($param);
    }
}
