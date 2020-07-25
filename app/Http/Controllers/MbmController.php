<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bookmark;
use App\Program;

class MbmController extends Controller
{
    public function index($share_token)
    {
        $bookmark = Bookmark::where('share_token', $share_token)->get()[0];
        $editor = User::find($bookmark->user_id);
        return view('mbm.index', ['bookmark' => $bookmark, 'editor' => $editor]);
    }

    public function get_programs($id) {
        $programs = Program::where('bookmark_id',$id)->get();        
        return $programs->toArray();
    }

    private function convert_youtube_url($url) {
        $pattern = "/^https?:\/\/www\.youtube\.com\/watch\?v=(.{11})/";
        preg_match($pattern, $url, $result);
        if ($result) {
            return $result[1];
        }

        $pattern = "/^https?:\/\/youtu\.be\/(.{11})/";
        preg_match($pattern, $url, $result);
        if ($result) {
            return $result[1];
        }

        return $url;

    }
}
