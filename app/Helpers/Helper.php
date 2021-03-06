<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class Helper{
    
    // code generaaator
    public static function CodeGenerator($model, $trow, $length = 4, $prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }

    // get api call
    public static function GetMethod($url){
        $response = Http::get($url, [
            'token' => session()->get('token'),
            'branch_id' => session()->get('branch_id')
        ]);
        return $response->json();
    }
    // get api call
    public static function GETMethodWithData($url,$data){
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');    
        $response = Http::get($url, $data);
        return $response->json();
    }
    // post api call
    public static function PostMethod($url,$data){
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        $response = Http::post($url, $data);
        return $response->json();
    }

    // create api
    public static function Create($model, $data){
        
    }

    // get api call
    public static function DataTableGetMethod($url,$data){
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        $response = Http::get($url,$data);
        return $response->json();
    }
}
