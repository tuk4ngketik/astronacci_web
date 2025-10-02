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

    function detail_user(){

    }

    function delete_user(){

    }

}
