<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // public function temp() {
    //     // return view('news');
    //     // dd(fake()->dateTime());
    //     $x = now()->addHours(2);
    //     dd($x);


            // $id = $req->input('id');
        // $string = Str::ucfirst('foo bar');
        // $converted = Str::lower('LARAVEL');
        // $slug = Str::slug('Laravel 5 Framework', '-');
        // $slug = Str::slug('Игорь Вася спят', '-');
        // $slice = Str::ascii('вавмар_арван арв');
    //     return csrf_token();

    // }
   
    // public function index(Request $req) {
    public function index() {       
        if(request('id')) {
            $result = News::find(request('id'));
        } else if (request('q')) {
            $result = News::where('title', 'like', '%'.request('q').'%')->get();
        } else {
            $result = News::get();
        }

        return $result;
        // return view('news');
    }
    



    public function create(Request $req) {
        return ['asd'=>1];
    }

    public function create1(Request $req) {
        // return $req;
        $new = new News;        
        // $new->id = $req->id;
        $new->title = $req->title;
        $new->announcement = $req->announcement;
        $new->text = $req->text;
        $new->tags = $req->tags;
        $new->date = $req->date;
        // $new->date =  date(DATE_RFC822);
        // $new->date =  fake()->dateTime();
        // $new->date =  now()->format('d-m-Y H:i:s');
        // $new->date =  now();

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
