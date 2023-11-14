<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Title -->
	<title>{{globalSetting()['title'] ?? 'Gemini Consultancy Services' }}</title>

	<!-- Favicon -->
	<link rel="icon" href="{{ !empty(globalSetting()['fav_icon']) ? asset('setting/' . globalSetting()['fav_icon']) : asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />

	<!-- Icons css -->
	<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">

	<!-- Bootstrap css -->
	<link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

	<!--  Right-sidemenu css -->
	<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

	<!-- P-scroll bar css-->
	<link href="{{URL::asset('assets/plugins/perfect-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />

	<!-- Sidemenu css -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">

	<!--- Style css --->
	<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/css/boxed.css')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/css/dark-boxed.css')}}" rel="stylesheet">

	<!--- Dark-mode css --->
	<link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">

	<!---Skinmodes css-->
	<link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

	<!--- Animations css-->
	<link href="{{URL::asset('assets/css/animate.css')}}" rel="stylesheet">

</head>

<body class="error-page1 main-body bg-light text-dark">

	<!-- Loader -->
	<!-- <div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div> -->
	<!-- /Loader -->

	<!-- Page -->
	<div class="page">
		@include('flash-message')
		@yield('content')
	</div>


	</div>
	<!-- End Page -->
<!-- JQuery min js -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap Bundle js -->
        <script src="{{URL::asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!--Internal  Chart.bundle js -->
        <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

        <!-- Ionicons js -->
        <script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
        <!-- Internal Select2.min js -->
        <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
        <!-- Moment js -->
        <script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

        <!--Internal Sparkline js -->
        <script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- Moment js -->
        <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>

        <!--Internal Apexchart js-->
        <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>

        <!-- Rating js-->
        <script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

        <!--Internal  Perfect-scrollbar js -->
        <script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

        <!-- Eva-icons js -->
        <script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>

        <!-- right-sidebar js -->
        <script src="{{URL::asset('assets/plugins/sidebar/sidebar.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

        <!-- Sticky js -->
        <script src="{{URL::asset('assets/js/sticky.js')}}"></script>
        <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
        <script src="{{URL::asset('assets/js/daterange.js')}}"></script>


        <!-- Left-menu js-->
        <script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

        <!-- Internal Map -->
        <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- Internal Form-editor js -->
        <!-- <script src="{{URL::asset('assets/js/form-editor.js')}}"></script> -->
        	<!--Internal quill js -->
		<!-- <script src="{{URL::asset('assets/plugins/quill/quill.min.js')}}"></script> -->
        <!-- sweetalert2 js-->
        <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert2.min.js')}}"></script>

        <!--Internal  index js -->
        <script src="{{URL::asset('assets/js/index.js')}}"></script>

        <!-- Apexchart js-->
        <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
        <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
	<!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>

		<!--Internal Fancy uploader js-->
		<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
	<!--- Internal Darggable js-->
    <script src="{{URL::asset('assets/plugins/darggable/jquery-ui-darggable.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/darggable/darggable.js')}}"></script>
        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('vendor/DataTables/DataTables-1.11.3/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- custom js -->
        <script src="{{URL::asset('assets/js/custom.js')}}"></script>
        <script src="{{ mix('js/admin.js') }}"></script>
        <script src="{{ URL::asset('js/admin.js') }}"></script>
	@yield('scripts')
</body>

</html>