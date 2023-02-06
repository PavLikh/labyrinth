<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index() {    
        return view('news', [
            'data' => $this->get(),
        ]);
    }
    
    public function get() {       
        if(request('id')) {
            $result = [News::find(request('id'))];
        } else if (request('q')) {
            $result = News::where('title', 'like', '%'.request('q').'%')->get();
        } else {
            $result = News::get();
        }
        return [
            'news' => $result,
            'detail' => request('id') ? 1 : 0
        ];
    }
    
    public function create1(Request $req) {
        return ['asd'=>1];
    }

    public function create(Request $req) {
        $new = new News;        
        // $new->id = $req->id;
        $new->title = $req->title;
        $new->announcement = $req->announcement;
        $new->text = $req->text;
        $new->tags = $req->tags;
        $new->date = $req->date;

        try {
            $new->save();
            $result = $new;
        } catch(\Illuminate\Database\QueryException $e){
            $result = response([
                "code" =>  $e->errorInfo[1],
                "message" => $e->errorInfo[2]
            ], 400);
        }
        return $result;
    }


    public function delete() {
        $result = false;
        $id = request('id');
        $new = News::find($id);
        if($new) {
                try {
                    $result = News::query()->where("id","=", $id)->first()->delete();//
                } catch(\Illuminate\Database\QueryException $e){
                    $result = response([
                        "code" =>  $e->errorInfo[1],
                        "message" => $e->errorInfo[2]
                    ], 400);
                }
        } else {
                $result = response([
                    "code" =>  404,
                    "message" => "No note found with id = " . $id
                ], 404);
        }
        return $result;
    }
    
    public function showOne(Request $req) {
        dd($req->input('id'));
        return view('news');
    }
    
}
