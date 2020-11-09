<?php
declare(strict_types=1);

namespace App\Controller;

use App\services\transform;

class Capitalize implements transform
{
    public function transform(string $string): string
    {
        $array = str_split($string);
        $capitalized = [];
       for ($i = 0; $i < count($array); $i++){
           if($i % 2 == 0){
               array_push($capitalized, strtoupper($array[$i]));
           }else {
               array_push($capitalized, strtolower($array[$i]));
           }
       }
       $message = implode("", $capitalized);
       return $message;
    }
}