<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;

class MobileController extends Controller
{
    
    function login(Request $request){  
        
        if( $this->isClient( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }    

        $validator = Validator::make($request->all(), [
            'email' =>'required',  
            'password' => 'required' 
        ]); 
        
        if ($validator->fails()) {
            return $this->retJson(false, 'Error validasi', null);  
        }  

        $row = User::where('email', $request->email);
        if( $row->count() < 1 ){ 
            return $this->retJson(false, 'Email belum terdaftar',  null );  
        }
        
        $row = $row->get(); 
        $cek_password  = Hash::check(  $request->password, $row[0]->password);
        
        if($cek_password !=  true ){ 
            return $this->retJson(false, 'Kata sandi salah', null );   
        }         
        
        return $this->retJson(true, 'success', $row[0]  );  

    } 

    function register(Request $request){
        
        if( $this->isClient( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }    

        $validator = Validator::make($request->all(), [
            'email' => 'required', 
            'password' => 'required', 
            'name' => 'required|min:5|max:100|regex:/^[a-zA-z\ ]+$/i', 
            'profile_image' => 'required'
        ]);  

        if ($validator->fails()) {
            return $this->retJson(false, 'Lengkapi semua data', $validator->errors()  ) ;  
        }
        
        $cek_email = User::where("email", $request->email)->count();
        if ($cek_email > 0 ) {
            return $this->retJson(false, 'Email sudah digunkan', null);  
        }

        try{
            $passwd =  Hash::make($request->password);
            $data = [
                "name" => $request->name,
                "email" => $request->email,
                "password" => $passwd,
                "profile_image" => $request->profile_image
            ];
            User::insert($data);
            return $this->retJson(true, 'Pendaftaran berhasil !', null); 

        }catch(Exception $e ){
            return $this->retJson(false, 'Terjadi kesalahan, 79', [ $e->getMessage() ]); 
        } 

    }

    
    function isClient($request) {  
        $valid = new MobileValidasi();
        return $valid->checkvalidasi($request); 
    }

    function retJson($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
    
}
