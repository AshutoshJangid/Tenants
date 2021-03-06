<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TenantDetail;
use App\Models\BillDetail;
use App\Models\BillSettle;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class BillController extends Controller
{
    //
    
    public function selectUserBill(Request $request){
        $user_id = $request->user()->id;
        $tnts_ids = User::select('id')->where('parent_id',$user_id)->where('status','active')->get();
        foreach($tnts_ids as $tnt_id){
            $date = Carbon::now();
            $bill_id = $date->format('my').$tnt_id->id;
            // $bill_id = '0322'.$tnt_id->id;
            $bill_ids[] = $bill_id;
        }
        $tnts_data = User::select('id','name')->where('parent_id',$user_id)->whereNotIN('id',BillDetail::select('user_id')->whereIn('bill_id',$bill_ids)->pluck('user_id')->toArray())->get();
        
        return  view('admin.selectUser', compact("tnts_data"));
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
            "rent_amt" => $request->rent_amt,
            "remark" => $request->remark,
            "discount" => $request->discount,
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
            return redirect()->route('ad.userBills',$tnt_id);
        }else{
            return redirect()->route('ad.viewTntList');
        }
        // return redirect()->route('ad.tntDetails');
    }
    // @foreach(json_decode($bill_data->basic_charges) as $bill_rate)
              
    // {{$bill_rate->elect_rate}}
    
    // @endforeach
    
    public function downloadPdf(Request $request,$bill_id){
        $user_id = $request->user()->id;
        $bill_data = BillDetail::where('bill_id',$bill_id)->first();
        // // dd($tntdata);
        $tnts_data = User::where('id',$bill_data->user_id)->first();
        $user_data = User::where('id',$user_id)->first();
        $bills = json_decode($bill_data->basic_charges);

        $oth_char = json_decode($bill_data->other_charges);
        // dd($other_charges->keys());
        
        if(!$bills->discount){
            $discount=0;
        }else{
            $discount=$bills->discount;
        }
        $oth_tot=0;
        foreach($oth_char as $key=>$value){
            if($value==null){
                $oth_tot=0;
            }else{
            $oth_tot = $oth_tot+$value; 
            }
        }
        $settle_prev=0;
        $subtotal = $bills->rent_amt+$bills->tot_elec_bill+$bills->water_bill+$oth_tot;
        $main_total = $subtotal - $discount;
        $prevdate = Carbon::now()->subMonth();
        $prev_bill_id = $prevdate->format('my').$bill_data->user_id;
        $settle_prev_data = BillSettle::where('bill_id',$prev_bill_id)->orderBy('id', 'DESC')->first();
        if(!empty($settle_prev)){
            $settle_prev=$settle_prev_data->remaining_amt;
            $main_total=$main_total+$settle_prev;
        }
        $select_settle  = BillSettle::where('bill_id',$bill_id)->orderBy('id', 'DESC')->get();
        
        if(empty($select_settle)||$select_settle==null||!$select_settle){
            $settle_amt = new BillSettle;
            $settle_amt->bill_id = $bill_id;
            $settle_amt->total_amt = $main_total;
            $settle_amt->remaining_amt	 = $main_total;
            $settle_amt->save();
        }
        
        $pdf = PDF::loadView('layout.m_pdf', compact("bill_data","tnts_data","user_data","bills","oth_char","subtotal","main_total","discount","settle_prev")); 
        return $pdf->download('invoice.pdf');

    }


    
    public function userBills(Request $request,$tnt_id){
        $user_id = $request->user()->id;
        $bill_data = BillDetail::where('user_id',$tnt_id)->get();
        // dd($tntdata);
        return view('admin.userBills', compact("bill_data"));
        // return redirect()->route('ad.tntDetails');
    }
    
    public function getBillDetail(Request $request){
        $user_id = $request->user()->id;
        $bill_id = $request->bill_id;
        $settle_data = BillSettle::where('bill_id',$bill_id)->orderBy('id', 'DESC')->first();

        // dd($tntdata);
        return  view('admin.settleForm', compact("settle_data"));
        // return redirect()->route('ad.tntDetails');
    }
    
    public function settleAmt(Request $request){
        $user_id = $request->user()->id;
        $bill_id = $request->bill_id;
        $received_amt = $request->bill_amt;

        $settle_data = BillSettle::where('bill_id',$bill_id)->orderBy('id', 'DESC')->first();
        $total_amt = $settle_data->total_amt;
        // $received_amt = $settle_data->received_amt;
        $remaining_amt = $settle_data->remaining_amt;
        $tot_remaining = $remaining_amt - $received_amt;
            $settle_amt = new BillSettle;
            $settle_amt->bill_id = $bill_id;
            $settle_amt->total_amt = $total_amt;
            $settle_amt->received_amt = $received_amt;
            $settle_amt->remaining_amt = $tot_remaining;
            
            if($settle_amt->save()){
                
            return  view('admin.selectBill');
            }
        // return redirect()->route('ad.tntDetails');
    }

}
// Bill Settlement Module