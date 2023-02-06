<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use XMLReader;

class InfoController extends Controller
{
    public function index() {
        return view('info', ['data' => $this->get()]);
    }

    public function get() {
        return [
            'currency' => $this->currency(),
            'weather' => $this->weather()
        ];
    }

    public function currency() {       
        // $reader = new XMLReader();
        $response = Http::get('http://www.cbr.ru/scripts/XML_daily.asp');
        $xml = simplexml_load_string($response);
        // dd($xml);
        $data = [];
        foreach($xml as $val) {
            if (
                $val->CharCode == 'USD' || 
                $val->CharCode == 'EUR' || 
                $val->CharCode == 'JPY' ||
                $val->CharCode == 'CAD' ||
                $val->CharCode == 'SEK'
                ) {
                $data[] = [
                    'charCode' => $val->CharCode,
                    'name' => $val->Name,
                    'value' => substr($val->Value->__toString(), 0, 5)
                ];
            }
        }
        // dd($data);
        return $data;
    }

    public function weather() {       
        $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude=55.75&longitude=37.6155&timezone=auto&current_weather=true&hourly=apparent_temperature')->json();
        $data = $response['current_weather'];
        // dd($response['hourly']['time']);
        foreach($response['hourly']['time'] as $key => $val ) {
            if($response['current_weather']['time'] == $val) {
                $data['apparent_temperature'] = $response['hourly']['apparent_temperature'][$key];
            }
        }
        $data['date'] = date('d.m');
        return $data;
    }
}
