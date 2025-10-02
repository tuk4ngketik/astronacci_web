<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    
    function login_act(Request $request){  
        
        $validator = Validator::make($request->all(), [
            'email' =>'required',  
            'password' => 'required' 
        ]); 
        
        if ($validator->fails()) { // All Error  
            return $this->retJson(false, 'Errors', $validator->errors());
        }          
        $sql = User::where('level','Admin')->where('email', $request->email);  
  
        if( $sql->count() > 0 ){  
            $row = $sql->get(); 
            $cek_password  = Hash::check(  $request->password, $row[0]->password); 
            if($cek_password !=  true ){ 
                return $this->retJson(false, 'Errors',  ["password" => ["Kata sandi tidak sesuai"] ]  );  
            }            
            
            if (  Auth::attempt( ['email' =>  $request->email,  'password' =>  $request->password ]  ) ) {  
                return $this->retJson(true, 'Login Berhasil !',  [] );   
            } 

        }
 
        return $this->retJson(false, 'Error',   ["email" => "email bellum terdaftar"] );
    } 

    function logout(){
        Auth::logout();  
        return redirect('login');
    }
    
    function retJson($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
    
}
