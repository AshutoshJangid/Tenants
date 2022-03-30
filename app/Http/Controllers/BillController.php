<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TenantDetail;
use App\Models\BillDetail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class BillController extends Controller
{
    //
    
    public function selectUserBill(Request $request){
        $user_id = $request->user()->id;
        $tnts_data = User::select('id','name')->where('parent_id',$user_id)->where('status','active')->get();
        // dd($tntdata);
        return  view('admin.selectUser', compact("tnts_data"));
        // return redirect()->route('ad.tntDetails');
    }
    
    public function tntBillForm(Request $request){
        $user_id = $request->user()->id;
        $tnt_id = $request->tnt_id;
        $tnt_rent_data = TenantDetail::where('user_id',$tnt_id)->first();
        $tnt_last_bill = BillDetail::select('present_unit')->where('user_id',$tnt_id)->orderBy('id', 'DESC')->first();

        // dd($tntdata);
        return  view('admin.billForm', compact("tnt_rent_data","tnt_last_bill"));
        // return redirect()->route('ad.tntDetails');
    }
    
    public function tntBillCreate(Request $request){
        // dd($request->input());

        $tnt_id = $request->tnt_id;
        $date = Carbon::now();
        $bill_id = $date->format('my').$tnt_id; //monthyearTntid (03223)
        $basic_charge = json_encode(array(
            "elect_rate" => $request->elect_rate,
            "tot_elec_bill" => $request->tot_elec_bill,
            "water_bill" => $request->water_bill
        ));
        // var_dump($basic_charge);
        $other_charge = json_encode(array_combine($request->charge_name, $request->charge_value));
        // dd($other_charge);
        $new_bill = new BillDetail;
        $new_bill->bill_id = $bill_id;
        $new_bill->user_id = $tnt_id;
        $new_bill->previous_unit = $request->prev_reading;
        $new_bill->present_unit = $request->present_read;
        $new_bill->basic_charges = $basic_charge;
        $new_bill->other_charges = $other_charge;
        if($new_bill->save()){
            return redirect()->route('ad.selectUserBill');
        }else{

        }
        // return redirect()->route('ad.tntDetails');
    }

    
    public function downloadPdf(Request $request){
        $user_id = $request->user()->id;
        $tnts_data = User::select('id','name')->where('parent_id',$user_id)->where('status','active')->get();
        // // dd($tntdata);
        $pdf = PDF::loadView('layout.m_pdf');
        //$pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');

        return  view('layout.m_pdf');
        // return redirect()->route('ad.tntDetails');
    }
    
}
