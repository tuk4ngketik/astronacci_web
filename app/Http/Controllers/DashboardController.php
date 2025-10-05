<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    function list_user(){
        $row = User::get();
        $data = [ 'row' => $row ];
        return view('dashboard.list_user', $data);
    }

    function detail_user($id=null){
        if($id == null){
            return $this->list_user();
        }

        $row = User::where('id', $id)->get();
        $data = [ 'row' => $row[0] ]; 
        return view('dashboard.detail_user', $data);

    }

    function delete_user(){

    }

}
