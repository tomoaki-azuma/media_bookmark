<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Bookmark;
use App\Favorite;

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

    public function search_init() {
        $auth = Auth::user();
        return view('bookmark.search', ['auth' => $auth]);
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

    public function search(Request $request) {
        $form = $request->all();
        $keyword = $form['keyword'];
        $user = $form['user'];
        $url = $form['url'];
        $query = Bookmark::query()->with('user:id,name');

        if ($user) {
            $query->nameEqual($user);
        }

        if ($keyword) {
            $query->keywordLike($keyword);
        }

        if ($url) {
            $query->shareTokenEqual($url);
        }

        $bookmarks = $query->get()->toArray();

        $auth = Auth::user();
        
        $favorites = Favorite::where('user_id', $auth->id)->pluck('bookmark_id');

        return ['bookmarks'=>$bookmarks, 'favorites'=>$favorites];
        
    }

    public function add_favorite(Request $request) {
        $auth = Auth::user();
        $user_id = $auth->id;
        $form = $request->all();
        $bookmark_id = $form['bookmark_id'];
        
        if (!(Favorite::where('user_id', $user_id))->where('bookmark_id', $bookmark_id)->exists()) {
            $favorite = new Favorite;
            $favorite->user_id = $user_id;
            $favorite->bookmark_id = $bookmark_id;
            $favorite->save();
        }

        $favorites = Favorite::where('user_id', $auth->id)->pluck('bookmark_id');
        $favorite_bookmarks = Bookmark::whereIn('id', $favorites)->with('user:id,name')->get()->toArray();
        return ['favorites'=>$favorites, 'favorite_bookmarks'=>$favorite_bookmarks];
        
    }

    public function delete_favorite(Request $request) {
        $auth = Auth::user();
        $user_id = $auth->id;
        $form = $request->all();
        $bookmark_id = $form['bookmark_id'];
        
        $favorite = Favorite::where('bookmark_id', $bookmark_id)->where('user_id', $user_id)->delete();

        $favorites = Favorite::where('user_id', $auth->id)->pluck('bookmark_id');
        $favorite_bookmarks = Bookmark::whereIn('id', $favorites)->with('user:id,name')->get()->toArray();

        return ['favorites'=>$favorites, 'favorite_bookmarks'=>$favorite_bookmarks];
    }

    public function my_favorite() {
        $auth = Auth::user();
        $user_id = $auth->id;
        
        $favorites = Favorite::where('user_id', $auth->id)->pluck('bookmark_id');
        $bookmarks = Bookmark::whereIn('id', $favorites)->with('user:id,name')->get()->toArray();
        return ['bookmarks'=>$bookmarks, 'favorites'=>$favorites];
        
    }

    public function init_my_favorite() {
        return view('bookmark.favorites');
    }

}
