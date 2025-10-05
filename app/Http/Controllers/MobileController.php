<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;  
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
            return $this->retJson(false,  $validator->errors()->first(), null ) ;  
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
                "profile_image" => $request->profile_image,
                "created_at" => now(),
                "updated_at" => now()
            ];
            User::insert($data);
            return $this->retJson(true, 'Pendaftaran berhasil !', null); 

        }catch(Exception $e ){
            return $this->retJson(false, 'Terjadi kesalahan, 79', [ $e->getMessage() ]); 
        } 

    }

    function ganti_passwd(Request $request){ 
        if( $this->isClient( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }    

        $validator = Validator::make($request->all(), [
            'passwd_lama' => 'required',  
            'passwd_baru' => 'required',   
        ]);  

        if ($validator->fails()) {
            return $this->retJson(false,  $validator->errors()->first(),    null);  
        }  
        try{ 
 
            $row = User::where('email', $request->email);
            if( $row->count() < 1 ){ 
                return $this->retJson(false, 'Email belum terdaftar',  null );  
            }      
            $row = $row->get();

            $cek_password  = Hash::check(  $request->passwd_lama, $row[0]->password);
            if($cek_password !=  true ){ 
                return $this->retJson(false, 'Password lama tidak sesuai', null );   
            }    

            
             $data = ['password' =>  Hash::make($request->passwd_baru) ]; 
             User::where('email', $request->email)->update($data);  
             return $this->retJson(true, 'Ganti Password berhasil !', null  );  

        }
        catch(Exception $e){
            return $this->retJson(false, 'Terjadi kesalahan', $e->getMessage()  );   

        }

        return $this->retJson(false, 'DBG Sukses', null );  


    }

    function users(Request $request, $page =null){
        
        if( $this->isClient( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }    

        // 1. Definisikan jumlah data per halaman (LIMIT)
        $perPage = 7; 
        

        // 3. Hitung OFFSET (SKIP) 
        $page ??= 1;
        $curr_page = intval ( $page );
        $skip = ( $page < 2 ) ? 0 :  ($page - 1) * $perPage;
        $next_page =  $page +  1; 
        
 
        // 4. Lakukan query Eloquent
        try{
            $users = User::orderBy('id', 'asc')  
                        ->skip($skip)        // Menentukan OFFSET
                        ->take($perPage)     // Menentukan LIMIT
                        ->select("id", "name", "email", "created_at", 
                                    "profile_image", "level"
                                )->get(); 
            if( count($users) < 1){ 
                $next_page = $curr_page   ; 
            } 
            $data = [
                "curr_page" =>$curr_page,
                "next_page" => $next_page ,
                "data" => $users
            ];
            return $this->retJson(true, 'List User', $data); 
        }catch(Exception $e){
            return $this->retJson(false, 'Terjadi kesalahan, 111', [ $e->getMessage() ]); 
        } 
        
    }

    function cari(Request $request){

        if( $this->isClient( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }  
        try{
            $row = User::where('email', "LIKE",  "%{$request->cari}%")
                        ->orwhere('name', "LIKE",  "%{$request->cari}%")
                        ->select("id", "name", "email", "created_at", 
                                    "profile_image", "level"
                                )
                        ->get(); 
            $data = [
                "curr_page" => 0,
                "next_page" => 0,
                "data" => $row
            ];
            return $this->retJson(true, 'Sukses pencarian',  $data );   
        }
        catch(Exception $e){
            return $this->retJson(false, 'Terjadi Kesalahan',  $e->getMessage()  );   
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
