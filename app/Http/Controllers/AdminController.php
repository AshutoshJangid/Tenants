<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Dashboard
    function index(Request $request){
        return  view('admin.dashboard');
    }
    //Dashboard
    function addtnt(Request $request){
        return  $request->input();
    }
}
