<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //
    function login(Request $request){
        $email =  $request->email;
        $user = DB::table('users')->where('email', $email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return "Incorrect email or password";
        }else{
            $request->session()->put('user',$user);
            return redirect('/');
        }
        return $user;
    }
}
