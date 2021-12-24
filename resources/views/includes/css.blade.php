<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('template_files/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('template_files/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('template_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--  noty  -->
<link rel="stylesheet" href="{{ asset('template_files/plugins/noty/noty.css') }}">
<script src="{{ asset('template_files/plugins/noty/noty.min.js') }}"></script>
<!--  data table  -->
<link rel="stylesheet" href="{{ asset('template_files/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@if (app()->getLocale() == 'ar')
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{asset('template_files/dist/css/custom.css')}}">
@endif
@stack('css')

