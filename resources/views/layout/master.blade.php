<!DOCTYPE html>
<html lang="en">
    
        @include('layout.head')
    
    <body class="sb-nav-fixed">
        
        @include('layout.header')
        <div id="layoutSidenav">
            @if(Auth::user()->type == 'Sa')
                @include('layout.sa_sidebar')
            @elseif(Auth::user()->type == 'Ad')
                @include('layout.ad_sidebar')
            @elseif(Auth::user()->type == 'Tn')
                @include('layout.tn_sidebar')
            @endif
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                
                @include('layout.footer')
                
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('demo/chart-area-demo.js')}}"></script>
        <script src="{{ asset('demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/datatables-simple-demo.js')}}"></script>
        <script>
            $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input type="text" placeholder="Enter Name of Charge" name="charge_name[]"/><input type="number"  placeholder="Enter value of Charge" name=charge_value[]"/><a href="#" class="remove_field btn btn-danger btn-sm"><i class="fa fa-minus" aria-hidden="true"></i></a></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#present_read").keyup(function(){
                    var prev_reading  = $("#prev_reading").val();
                    var present_read  = $("#present_read").val();
                    var elec_char  = $("#elec_char").val();

                    if(prev_reading > present_read){
                        var tot_bill = 0;
                    }else{
                        var tot_bill = (present_read - prev_reading) * elec_char;
                    }
                    
                    $("#tot_elec_bill").val(tot_bill);
                });
            });
        </script>
        </script>
    </body>
</html>