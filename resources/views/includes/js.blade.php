<!-- jQuery -->
<script src="{{asset('template_files/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('template_files/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('template_files/dist/js/adminlte.min.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('template_files/dist/js/demo.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('template_files/dist/js/select2.min.js')}}"></script>
<!-- Data table -->
<script src="{{ asset('template_files/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<!-- print -->
<script src="{{asset('template_files/dist/js/print.min.js')}}"></script>
<!-- my function -->
<script src="{{asset('template_files/dist/js/myFunction.js')}}"></script>

@stack('js')
