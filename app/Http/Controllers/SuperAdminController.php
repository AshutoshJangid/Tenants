<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TenantDetail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class SuperAdminController extends Controller
{
    //
    // public function index(Request $request)
    // {
    //     return  view('superadmin.dashboard');
    // }
    
    public function newAdmin(Request $request)
    {
        //    dd($request);
        if ($request->hasFile('img')) {
            $imageName = Carbon::now()->timestamp . '.' . $request->file('img')->extension();

            $request->file('img')->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
        if ($request->hasFile('aadhar_img')) {
            $adharImgName = Carbon::now()->timestamp . '.' . $request->file('aadhar_img')->extension();

            $request->file('aadhar_img')->move(public_path('images'), $adharImgName);
        } else {
            $adharImgName = null;
        }

        $user_id = $request->user()->id;
        $user = new User;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->phone);
        $user->image = $imageName;
        $user->aadhar_number = $request->aadhar_no;
        $user->aadhar_image = $adharImgName;
        $user->parent_id = $user_id;
        $user->type = 'Ad';

        if ($user->save()) {

            $tntDetail = new TenantDetail;
            $tntDetail->user_id = $user->id;
            $tntDetail->save();
            $tntid = $tntDetail->id;
            // dd($tntid);
            // return redirect()->route('ad.addtenant');
            return redirect()->route('sa.dashboard');
        } else {
            return redirect()->route('sa.dashboard');
        }
    }

    
    public function viewAdmList(Request $request)
    {
        $user_id = $request->user()->id;
        $userdata = User::where('parent_id', $user_id)->get();
        return  view('superadmin.viewAdmList', compact("userdata"));
    }

    public function changeStatus(Request $request, $id)
    {
        $userStatus = User::select('status')->where('id', $id)->first();
        if ($userStatus->status == 'active') {
            User::where('id', $id)
                ->update([
                    'status' => 'inactive'
                ]);
        } elseif ($userStatus->status == 'inactive') {
            User::where('id', $id)
                ->update([
                    'status' => 'active'
                ]);
        } else {
            dd($id);
        }

        return redirect()->route('ad.viewTntList');
    }

}
