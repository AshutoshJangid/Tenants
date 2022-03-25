<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    //Dashboard
    public function index(Request $request){
        return  view('admin.dashboard');
    }

    public function addtnt(Request $request){
        //    dd($request);
        if ($request->hasFile('img')) {
            $imageName = Carbon::now()->timestamp.'.'.$request->file('img')->extension();  
            
            $request->file('img')->move(public_path('images'), $imageName);
        }
            $user_id = $request->user()->id;
            $userdata = $request->input();
            $user = new User;
            $user->name = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->phone);
            $user->image = $imageName?$imageName:null;
            $user->parent_id = $user_id;
            $user->type = 'Tn';

            if($user->save()){
                return redirect()->route('ad.addtenant');
            }else{
                return redirect()->route('ad.dashboard');
            }

        
    }

    public function viewTntList(Request $request){
        $user_id = $request->user()->id;
        $userdata = User::where('parent_id',$user_id)->get();
        return  view('admin.viewTntList', compact("userdata"));
    }

    public function changeStatus(Request $request,$id){
        $userStatus = User::select('status')->where('id', $id)->first();
        if($userStatus->status=='active'){
            User::where('id', $id)
            ->update([
                'status' => 'inactive'
             ]);
        }elseif($userStatus->status=='inactive'){
            User::where('id', $id)
            ->update([
                'status' => 'active'
            ]);
        }else{
            dd($id);
        }
        
        return redirect()->route('ad.viewTntList');
    }
}


// aadhaar number- aadhar phot
// Place type(room/flat/shop/land)
// Rent  agreement doc
// Starting date, 
// leaving date,
// Electric bill type
// Per unit cost
// water bill type and charges
// total number of members
// Permanent address 
// additional charges 
// advance amount
