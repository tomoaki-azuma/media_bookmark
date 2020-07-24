<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
        $auth = Auth::user();
        return view('user.index',[ 'auth' => $auth ]);
   
    }

    public function store(Request $request) {
        $auth = Auth::user();
        $form = $request->all();

        $auth->name = $form['name'];
        $auth->comment = $form['comment'];
        

        if ($request->file('photo')) {
            if ($auth->img_url) {
                $res = Storage::delete('public/'.$auth->img_url);
            }

            $path = $request->file('photo')->store('avatars','public'); //store で一意のファイル名で保存
            $auth->img_url = $path;
            
        }
        
        $auth->save();

        return view('user.index',[ 'auth' => $auth ]);
    }
}