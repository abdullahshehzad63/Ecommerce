<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Theme style -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{asset('admin-assets/css/custom.css')}}">
		<link rel="stylesheet" href="{{asset('admin-assets/plugins/select2/css/select2.min.css')}}">

		<meta name="csrf-token" content="{{ csrf_token() }}">
		
	</div>
	
	<style>
		.image-container {
			display: flex;
			flex-wrap: wrap;
			gap: 15px; /* Adjust the gap between images if needed */
		}
	
		.image-wrapper {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 15px;
		}
	
		.product-image {
			max-width: 100px;
			max-height: 100px;
			margin-bottom: 5px;
		}
	
		.btn-remove {
			display: block;
		}
	</style>

	</head>

	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
            @include('admin.include.navbar')
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				@include('admin.include.sidebar')
				<!-- /.sidebar -->
         	</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				@yield('content')
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2014-2022 Ecommerce All rights reserved.
			</footer>
			
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('admin-assets/js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{asset('admin-assets/js/demo.js')}}"></script>
		<script src="{{asset('admin-assets/plugins/select2/js/select2.min.js')}}"></script>

		<script>
			$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
		</script>
		@yield('customJs')
	</body>
</html>