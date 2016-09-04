<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<meta http-equiv=X-UA-Compatible content=IE=EmulateIE7>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
		<meta name="format-detection" content="telephone=no">
		<title>@yield('title')</title>
		@section('css')
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
		@show
	</head>
	<body>
	@yield('content')
	
	@section('js')
	<script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
    </script>
	@show
	</body>
</html>