<?php

namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Exception;

class MobileValidasi extends Controller
{
     
    private $keys_vals = [ 
                    'apikey' => 'astronacci-apikey-xxx', 
                    'packagename' =>'astronacci-package-xxxx', 
                    'apiversions' => [
                        '1.0',  // development
                        '1.1',  // production
                    ],  
                ];
                
    function checkvalidasi($request) { 

        $headers = $request->headers->all(); 
        
        try{  
 
            if(!isset($headers['apikey']) || $headers['apikey'][0] != $this->keys_vals['apikey']){
                return false;
            }

            if( !isset($headers['packagename']) || $headers['packagename'][0] != $this->keys_vals['packagename']){
                return false;
            } 

            // Api Version
            if ( !isset($headers['apiversion']) ||  !in_array( $headers['apiversion'][0],  $this->keys_vals['apiversions']  )) {
                return  false; 
            }  

            return true;
 
        }
        catch(Exception $e){
            return false;  
        }  
    }

}
