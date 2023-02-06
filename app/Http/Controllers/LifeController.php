<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeController extends Controller
{

    public function index() {       
        return view('life');
    }

    public function main() {       
        $m = 3;
        $n = $m;
        $field = [
            [0,1,0],
            [0,0,0],
            [1,1,1]
        ];
        for ($i=0; $i<$m;$i++) {
            for($j=0; $j<$n; $j++) {
                // $field[$i][$j] = rand(0,1);
                $cur = $field[$i][$j];
                if ($i == 0) {

                } else if ($i == $m - 1) {

                } else {
                    if ($i - 1 == 0)

                    $next = 0;
                }
            }
        }
        dd($field);
        return 1;
    }


    public function activate() {       
        
        return view('life');
    }

    public function reload() {       
        
        return view('life');
    }

    public function isolation() {       
        
        return view('life');
    }

    public function extinction() {       
        
        return view('life');
    }
}
