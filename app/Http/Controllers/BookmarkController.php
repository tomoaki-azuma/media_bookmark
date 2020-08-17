<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Bookmark;

class BookmarkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $bookmarks = Bookmark::all();
        return $bookmarks->toArray();
    }

    public function show($id) {
        $bookmark = Bookmark::where('id', $id)->get();
        return $bookmark->toArray();
    }

    public function show_by_uid($user_id) {
        $bookmark = Bookmark::where('user_id', $user_id)->get();
        return $bookmark->toArray();
    }

    public function create() {
        $auth = Auth::user();
        return view('bookmark.create', ['auth' => $auth]);
    }

    public function store(Request $request) {
        $form = $request->all();    
        $bookmark = new Bookmark;

        if ($form['type'] == 'update') {
            $bookmark = Bookmark::find($form['id']);
        } else {
            $bookmark->user_id = $form['user_id'];
            $bookmark->share_token = uniqid();
        }

        $bookmark->title = $form['title'];
        $bookmark->comment = $form['comment'];

        $bookmark->save();

        if ($form['type'] == 'update') {
            return $bookmark->toArray(); 
        } else {
            $bookmarks= Bookmark::where('user_id', $form['user_id'])->get();
            return $bookmarks->toArray();
        }
    }

    public function edit($id) {
        $bookmark = Bookmark::find($id);
        $auth = Auth::user();
        return view('bookmark.edit', ['bookmark' => $bookmark, 'auth' => $auth]);
    }

    public function share()
    {
        $auth = Auth::user();
        return view('bookmark.share', ['auth' => $auth]);
    }

    public function destroy(Request $request) {
        Bookmark::destroy($request->id);
        return '';
    }


}
