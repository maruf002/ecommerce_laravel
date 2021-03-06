<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('content'){{ config('app.name', 'Laravel') }}</title>

 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   <!-- Site Metas -->
   <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">

   <!-- Site Icons -->
   <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
   <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
   <!-- Site CSS -->
   <link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="{{asset('front_assets/css/custom.css')}}">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body>
    @include('layouts.frontend.partial.header')
    @yield('content')
    @include('layouts.frontend.partial.footer')  

    
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{asset('front_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('front_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('front_assets/js/bootstrap.min.j')}}s"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('front_assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('front_assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('front_assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('front_assets/js/bootsnav.js.')}}"></script>
    <script src="{{asset('front_assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('front_assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('front_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front_assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('front_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('front_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('front_assets/js/custom.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script>
        @if($errors->any())
        @foreach($errors->all() as $error)
          toastr.error('{{ $error }}', 'Error',{
              closeButton:true,
              progressBar:true,

          });

        @endforeach

        @endif
    </script>  

    {{--  get product price with ajax call  --}}
    <script>
      $(document).ready(function(){
        $("#selSize").change(function(){
        //   alert("test");
        var idSize = $(this).val();
        if(idSize ==""){
            return false;
        }
        $.ajax({
            type:'get',
            url:'/get-product-price', //wihtout / url get error, / is must for this
            data:{idSize:idSize},
            success:function(resp){
                // alert(resp);
                var arr = resp.split('#');
                $("#getPrice").html("bdt."+arr[0] );
                 $('#price').val(arr[0]);
            },error:function(){
                alert("Error");

            }

        });

         });

         $("#billtoship").click(function(){
             if(this.checked){
               $("#shipping_name").val($("#billing_name").val());
               $("#shipping_address").val($("#billing_address").val());
               $("#shipping_city").val($("#billing_city").val());
               $("#shipping_state").val($("#billing_state").val());
               $("#shipping_country").val($("#billing_country").val());
               $("#shipping_pincode").val($("#billing_pincode").val());
               $("#shipping_mobile").val($("#billing_mobile").val());
             }else{
                 $("#shipping_name").val('');
                 $("#shipping_address").val('');
                 $("#shipping_city").val('');
                 $("#shipping_state").val('');
                 $("#shipping_country").val('');
                 $("#shipping_pincode").val('');
                 $("#shipping_mobile").val('');
             }

         });

       });
    </script>
</body>
</html>
