<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Url;

class ProgramController extends Controller
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

    public function show_by_bmid($bm_id) {
        $programs = Program::where('bookmark_id',$bm_id)->get();
        return $programs->toArray();
    }

    public function show($id) {
        $program = Program::find($id);
        return $programs->toArray();
    }

    public function store(Request $request) {
        
        $form = $request->all();
        $program = new Program;


        if ($form['type'] == 'update') {
            $program = Program::find($form['id']);
        } 

        $program->user_id = $form['user_id'];
        $program->bookmark_id = $form['bookmark_id'];
        $program->title = $form['title'];
        $program->comment = $form['comment'];
        $program->url = $form['url'];
        $program->save();

        $programs = Program::where('bookmark_id',$program->bookmark_id)->get();
        return $programs->toArray();

    }

    public function destroy(Request $request) {
        $program = Program::find($request->id);
        Program::destroy($request->id);
        
        $programs = Program::where('bookmark_id',$request->bookmark_id)->get();
        return $programs->toArray();

    }
}
