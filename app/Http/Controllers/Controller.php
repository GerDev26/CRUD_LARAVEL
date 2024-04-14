<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $validKeys = [];

    public function searchInvalidsKeys($keys){
        $invalidKeys = "";
        $isValidKey = true;

        foreach ($keys as $key) {
            if(!in_array($key, $this->validKeys)){
                $isValidKey = false;
                $invalidKeys .= $key. ", ";
            }
        }
        $invalidKeys = trim($invalidKeys, ", ");
        
        if(!$isValidKey){
            return "Las keys $invalidKeys no son validas";
        }
        return null;
    }
}
