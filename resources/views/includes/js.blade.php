<!-- jQuery -->
<script src="{{asset('template_files/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('template_files/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('template_files/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('template_files/dist/js/myScript.js')}}"></script>
<!-- validation plugin-->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/additional-methods.min.js"></script>
<!-- Data table -->
<script src="{{ asset('template_files/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('template_files/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template_files/plugins/vendor/datatables/buttons.server-side.js') }}"></script>
<!--    dropzone    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.js" integrity="sha512-0QMJSMYaer2wnpi+qbJOy4rOAlE6CbYImSlrgQuf2MBBMqTvK/k6ZJV126/EbdKzMAXaB6PHzdYxOX6Qey7WWw==" crossorigin="anonymous"></script>

@stack('js')
