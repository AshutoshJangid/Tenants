<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TenantDetail;
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
        }else{
            $imageName=null;
        }
        if ($request->hasFile('aadhar_img')) {
            $adharImgName = Carbon::now()->timestamp.'.'.$request->file('aadhar_img')->extension();  
            
            $request->file('aadhar_img')->move(public_path('images'), $adharImgName);
        }else{
            $adharImgName=null;
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
            $user->type = 'Tn';

            if($user->save()){
                
                $tntDetail = new TenantDetail;
                $tntDetail->user_id = $user->id;
                $tntDetail->save();
                $tntid = $tntDetail->id;
                // dd($tntid);
                // return redirect()->route('ad.addtenant');
                return redirect()->route('ad.tntDetails', $user->id);
            }else{
                return redirect()->route('ad.dashboard');
            }

        
    }

    
    public function updatetTntDetails(Request $request){

        //    dd($request);

        $user_prev_data = User::where('id',$request->tntid)->first();
        if ($request->hasFile('img')) {
            $imageName = Carbon::now()->timestamp.'.'.$request->file('img')->extension();  
            
            $request->file('img')->move(public_path('images'), $imageName);
        }else{
            $imageName=$user_prev_data->image;
        }
        if ($request->hasFile('aadhar_img')) {
            $adharImgName = Carbon::now()->timestamp.'.'.$request->file('aadhar_img')->extension();  
            
            $request->file('aadhar_img')->move(public_path('images'), $adharImgName);
        }else{
            $adharImgName=$user_prev_data->aadhar_image;
        }
            $user_update = User::where('id', $request->tntid)
            ->update([
                'name' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $imageName,
                'aadhar_number' => $request->aadhar_no,
                'aadhar_image' => $adharImgName
            ]);


            if($user_update){
                
                return redirect()->route('ad.tntRentDetails', $request->tntid);
            }else{
                return redirect()->route('ad.dashboard');
            }

        
    }
    
    public function viewTntList(Request $request){
        $user_id = $request->user()->id;
        $userdata = User::where('parent_id',$user_id)->get();
        return  view('admin.viewTntList', compact("userdata"));
    }

    public function tntDetails(Request $request,$tnt_id){
        $tnt_rent_data = TenantDetail::where('user_id',$tnt_id)->first();
        $tnt_personal_data = User::where('id',$tnt_id)->first();
        // dd($tntdata);
        return  view('admin.updatetenant', compact("tnt_personal_data"));
        // return redirect()->route('ad.tntDetails');
    }

    public function tntRentDetails(Request $request,$tnt_id){
        $tnt_rent_data = TenantDetail::where('user_id',$tnt_id)->first();
        // dd($tntdata);
        return  view('admin.detailForm', compact("tnt_rent_data"));
        // return redirect()->route('ad.tntDetails');
    }

    public function tntViewDetails(Request $request,$tnt_id){
        $tnt_rent_data = TenantDetail::where('user_id',$tnt_id)->first();
        $tnt_pers_data = User::where('id',$tnt_id)->first();
        // dd($tntdata);
        return  view('admin.viewDetails', compact("tnt_rent_data","tnt_pers_data"));
        // return redirect()->route('ad.tntDetails');
    }

    
    public function addtTntDetails(Request $request){
        //    dd($request);
            $tnt_id = $request->tnt_id;
        $user_prev_data = TenantDetail::where('id',$tnt_id)->first();
        if ($request->hasFile('agreement_doc')) {
            $agrmnt_name = Carbon::now()->timestamp.'agreement.'.$request->file('agreement_doc')->extension();  
            
            $request->file('agreement_doc')->move(public_path('agreement_doc'), $agrmnt_name);
        }else{
            $agrmnt_name=$user_prev_data->agreement_doc;
        }
            $user_id = $request->user()->id;
            $tntData =  TenantDetail::where('id', $tnt_id)
                ->update([
                    'type' => $request->place_type,
                    'joining_date' => $request->joindate,
                    'rent_amt' => $request->rentAmt,
                    'advance_amt' => $request->advanceAmt,
                    'electricity_amt' => $request->elec_cost,
                    'water_amt' => $request->water_cost,
                    'agreement_date' => $request->agreement_date,
                    'agreement_duration' => $request->agreement_duration,
                    'agreement_doc' => $agrmnt_name,
                ]);

            if($tntData){
                return redirect()->route('ad.viewTntList');
            }else{
                return redirect()->route('ad.viewTntList');
            }

        
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
