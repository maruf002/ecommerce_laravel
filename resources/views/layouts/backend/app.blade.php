<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   <!-- Favicon and touch icons -->
   <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
   <!-- Start Global Mandatory Style
      =====================================================================-->
   <!-- jquery-ui css -->
   <link href="{{asset('admin-assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Bootstrap -->
   <link href="{{asset('admin-assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Bootstrap rtl -->
   <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
   <!-- Lobipanel css -->
   <link href="{{asset('admin-assets/plugins/lobipanel/lobipanel.min.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Pace css -->
   <link href="{{asset('admin-assets/plugins/pace/flash.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Font Awesome -->
   <link href="{{asset('admin-assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Pe-icon -->
   <link href="{{asset('admin-assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Themify icons -->
   <link href="{{asset('admin-assets/themify-icons/themify-icons.css')}}" rel="stylesheet" type="text/css"/>
   <!-- End Global Mandatory Style
      =====================================================================-->
   <!-- Start page Label Plugins 
      =====================================================================-->
   <!-- Emojionearea -->
   <link href="{{asset('admin-assets/plugins/emojionearea/emojionearea.min.css')}}" rel="stylesheet" type="text/css"/>
   <!-- Monthly css -->
   <link href="{{asset('admin-assets/plugins/monthly/monthly.css')}}" rel="stylesheet" type="text/css"/>
   <!-- End page Label Plugins 
      =====================================================================-->
   <!-- Start Theme Layout Style
      =====================================================================-->
   <!-- Theme style -->
   <link href="{{asset('admin-assets/dist/css/stylecrm.css')}}" rel="stylesheet" type="text/css"/>
   @stack('css')
   <!-- Theme style rtl -->
   <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
   <!-- End Theme Layout Style
      =====================================================================-->
</head>
<body class="hold-transition sidebar-mini">
    <!--preloader-->
    <div id="preloader">
       <div id="status"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
       <header class="main-header">
          <a href="index.html" class="logo">
             <!-- Logo -->
             <span class="logo-mini">
             <img src="{{asset('admin-assets/dist/img/mini-logo.png')}}" alt="">
             </span>
             <span class="logo-lg">
             <img src="{{asset('admin-assets/dist/img/logo.png')}}" alt="">
             </span>
          </a>
          <!-- Header Navbar -->
          @include('layouts.backend.partial.header')
       </header>
       <!-- =============================================== -->
       @include('layouts.backend.partial.sidebar')
       <!-- =============================================== -->
       <!-- Content Wrapper. Contains page content -->
       @yield('content')
       <!-- /.content-wrapper -->
       @include('layouts.backend.partial.footer')
    </div>
    <!-- /.wrapper -->
    <!-- Start Core Plugins
       =====================================================================-->
    <!-- jQuery -->
    <script src="{{asset('admin-assets/plugins/jQuery/jquery-1.12.4.min.js')}}" type="text/javascript"></script>
    <!-- jquery-ui --> 
    <script src="{{asset('admin-assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin-assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- lobipanel -->
    <script src="{{asset('admin-assets/plugins/lobipanel/lobipanel.min.js')}}" type="text/javascript"></script>
    <!-- Pace js -->
    <script src="{{asset('admin-assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{asset('admin-assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript">    </script>
    <!-- FastClick -->
    <script src="{{asset('admin-assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
    <!-- CRMadmin frame -->
    <script src="{{asset('admin-assets/dist/js/custom.js')}}" type="text/javascript"></script>
    <!-- End Core Plugins
       =====================================================================-->
    <!-- Start Page Lavel Plugins
       =====================================================================-->
    <!-- ChartJs JavaScript -->
    <script src="{{asset('admin-assets/plugins/chartJs/Chart.min.js')}}" type="text/javascript"></script>
    <!-- Counter js -->
    <script src="{{asset('admin-assets/plugins/counterup/waypoints.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <!-- Monthly js -->
    <script src="{{asset('admin-assets/plugins/monthly/monthly.js')}}" type="text/javascript"></script>
    <!-- End Page Lavel Plugins
       =====================================================================-->
    <!-- Start Theme label Script
       =====================================================================-->
    <!-- Dashboard js -->
    <script src="{{asset('admin-assets/dist/js/dashboard.js')}}" type="text/javascript"></script>
    <!-- End Theme label Script
       =====================================================================-->
    <script>
       function dash() {
       // single bar chart
       var ctx = document.getElementById("singelBarChart");
       var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
       labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
       datasets: [
       {
       label: "My First dataset",
       data: [40, 55, 75, 81, 56, 55, 40],
       borderColor: "rgba(0, 150, 136, 0.8)",
       width: "1",
       borderWidth: "0",
       backgroundColor: "rgba(0, 150, 136, 0.8)"
       }
       ]
       },
       options: {
       scales: {
       yAxes: [{
           ticks: {
               beginAtZero: true
           }
       }]
       }
       }
       });
             //monthly calender
             $('#m_calendar').monthly({
               mode: 'event',
               //jsonUrl: 'events.json',
               //dataType: 'json'
               xmlUrl: 'events.xml'
           });
       
       //bar chart
       var ctx = document.getElementById("barChart");
       var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
       labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
       datasets: [
       {
       label: "My First dataset",
       data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
       borderColor: "rgba(0, 150, 136, 0.8)",
       width: "1",
       borderWidth: "0",
       backgroundColor: "rgba(0, 150, 136, 0.8)"
       },
       {
       label: "My Second dataset",
       data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
       borderColor: "rgba(51, 51, 51, 0.55)",
       width: "1",
       borderWidth: "0",
       backgroundColor: "rgba(51, 51, 51, 0.55)"
       }
       ]
       },
       options: {
       scales: {
       yAxes: [{
           ticks: {
               beginAtZero: true
           }
       }]
       }
       }
       });
           //counter
           $('.count-number').counterUp({
               delay: 10,
               time: 5000
           });
       }
       dash();         
    </script>
    @stack('js')
 </body>
</html>
