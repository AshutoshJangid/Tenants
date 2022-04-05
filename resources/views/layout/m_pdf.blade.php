<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bill</title>
</head>

<body>
  <!-- border: 1px solid black;
  line-height: 22px;
   width: 800PX;
   margin: 0 auto;
   padding: 35px;
   background: #fff; -->
  <table style="line-height: 22px;padding: 35px;">
    <tr>
      <td colspan="2">
        <table style="width: 100%;">
          <tr>
            <td>Name : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$user_data->name}}</span></td>
          </tr>
          <tr>
            <td>Address : <span style="background-color: #d4e0f9;padding: 4px 10px;">--</span></td>
          </tr>
          <tr>
            <td>Zip Code : <span style="background-color: #d4e0f9;padding: 4px 10px;">--</span></td>
          </tr>
          <tr>
            <td>Phone : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$user_data->phone}}</span></td>
          </tr>
          <tr>
            <td>Email : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$user_data->email}}</span></td>
          </tr>
        </table>

      </td>
      <td style="width: 22%;text-align: right;">
        <table>
          <tr>
            <h1 style="line-height: 33px">MONTHLY RENT INVOICE</h1>
          </tr>
        </table>
      </td>
    </tr>
    <tr style="background-color:#a8d1fa ;">
      <td colspan="2" style="padding: 5px 10px;">Invoice Number# : <span
          style="background-color: #d4e0f9;padding: 4px 10px;">{{$bill_data->bill_id}}</span></td>
      <td style="width: 26%;">Date : <span
          style="background-color: #d4e0f9;padding: 4px 10px;">{{$bill_data->created_at->isoFormat('d/M/Y')}}</span>
      </td>
    </tr>
    </tr>
    <tr>
      <td colspan="3">
        <table>
          <tr>
            <td><strong>Tenant</strong></td>
          </tr>
          <tr>
            <td>Name : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$tnts_data->name}}</span></td>
          </tr>
          <tr>
            <td>Address : <span style="background-color: #d4e0f9;padding: 4px 10px;">--</span></td>
          </tr>
          <tr>
            <td>Zip Code : <span style="background-color: #d4e0f9;padding: 4px 10px;">--</span></td>
          </tr>
          <tr>
            <td>Phone : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$tnts_data->phone}}</span></td>
          </tr>
          <tr>
            <td>Email : <span style="background-color: #d4e0f9;padding: 4px 10px;">{{$tnts_data->email}}</span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>

      <td colspan="3">
        <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
          <thead style="background-color:#a8d1fa ;text-align: center;">
            <td><strong>Description</strong> </td>
            <td style="width: 22%;"><strong>Amount (INR)</strong> </td>
          </thead>
          <tr style="background-color:#d4e0f9; text-align: center;">
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              Monthly Rent</td>
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              {{$bills->rent_amt}}
            </td>
          </tr>
          <tr style="background-color:#d4e0f9; text-align: center;">
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              Electricity Charges ( {{$bill_data->present_unit - $bill_data->previous_unit}}Units *
              {{$bills->elect_rate}}INR/Unit )</td>
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              {{$bills->tot_elec_bill}}</td>
          </tr>
          <tr style="background-color:#d4e0f9; text-align: center;">
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              Water Charges</td>
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              {{$bills->water_bill}}</td>
          </tr>
          @foreach($oth_char as $key=>$value)
          @if($key!="" || $value!=null)
          <tr style="background-color:#d4e0f9; text-align: center;">
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              {{$key}}</td>
            <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
              {{$value}}</td>
            @endif
            @endforeach

          </tr>
        </table>
      </td>

    </tr>
    <tr>
      <td style="width: 50%;">
        <table>
          <tr>
            <td style="text-align: Center;" colspan="2">Remark For Special Instructions</td>

          </tr>
          <tr>
            <td>
            <td
              style="background-color:#d4e0f9; text-align: center;border-bottom: 1px solid black;border-collapse: collapse;width: 100%;">
              {{$bills->remark==null?"No Remark" : $bills->remark}}</td>
      </td>
    </tr>
  </table>
  </td>
  <td colspan="2">
    <table style="width: 100%;border-collapse: collapse;">

      <tr>
        <td style=" text-align: right;padding-right: 20px;">Subtotal</td>
        <td
          style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;width: 44%;">
          {{$subtotal}}</td>
      </tr>
      <tr>
        <td style="text-align: right;padding-right: 20px;">Discount</td>
        <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
          {{$discount}}</td>
      </tr>
      <tr>
        <td style="text-align: right;padding-right: 20px;">Previous Amount Settle</td>
        <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
          {{$settle_prev}}</td>
      </tr>
      <tr>
        <td style="text-align: right;padding-right: 20px;"><strong>Total</strong></td>
        <td style="background-color:#d4e0f9; text-align: center;border: 1px solid black;border-collapse: collapse;">
          <strong>{{$main_total}}</strong>
        </td>
      </tr>
    </table>
  </td>

  </tr>
  </table>

</body>

</html>
<!-- #a8d1fa #d4e0f9 
https://invoicetemplates.com/wp-content/uploads/Monthly-Rent-Invoice-Template.png-->