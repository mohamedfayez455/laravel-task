<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('template_files/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('template_files/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('template_files/dist/js/adminlte.min.js')}}"></script>
<!-- Data table -->
<script src="{{ asset('template_files/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables/dataTables.buttons.min.js') }}"></script>
@stack('js')
