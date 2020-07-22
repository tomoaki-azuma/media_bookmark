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
        $programs = Program::with('urls:id,url,file_type,program_id')->where('bookmark_id',$bm_id)->get();
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
            $program = Program::With('urls')->find($form['id']);
            $urls = $program->urls;
            foreach ($urls as $url) {
                Url::destroy($url->id);
            }
        } 

        $program->user_id = $form['user_id'];
        $program->bookmark_id = $form['bookmark_id'];
        $program->title = $form['title'];
        $program->comment = $form['comment'];
        $program->save();

        $new_program_urls = $form['new_program_urls'];
        foreach ($new_program_urls as $new_program_url) {  
            $url = new Url;
            $url->url = $new_program_url['url'];
            $url->file_type = $new_program_url['file_type'];
            $url->program_id = $program->id;
            $url->save();
        }

        $programs = Program::with('urls:id,url,file_type,program_id')->where('bookmark_id',$program->bookmark_id)->get();
        return $programs->toArray();

    }

    public function destroy(Request $request) {
        $program = Program::find($request->id);
        Program::destroy($request->id);
        $urls = $program->urls;
        foreach ($urls as $url) {
            Url::destroy($url->id);
        }

        $programs = Program::with('urls:id,url,file_type,program_id')->where('bookmark_id',$request->bookmark_id)->get();
        return $programs->toArray();

    }
}
