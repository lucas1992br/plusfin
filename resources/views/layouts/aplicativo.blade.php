@extends('adminlte::page')

@section('title', 'Dashboard')
    
@section('content_header')
<h1>Plusfin</h1>
@stop

@section('content')
{{ $slot }}
<!-- Bootstrap core JavaScript-->
<script src="js/jquery/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>




<!-- Core plugin JavaScript-->
<script src="js/jquery-easing/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom scripts for all pages-->
<script src="js/cpr/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="js/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
{{-- <script src="js/demo/chart-area-demo.js"></script> --}}
{{-- <script src="js/demo/chart-pie-demo.js"></script> --}}
<script src="{!! asset('js/app.js') !!}"></script>
@stop

@section('css')
   
@stop

@section('js')

@stop