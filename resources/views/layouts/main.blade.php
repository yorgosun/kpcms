<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>内容管理</title>
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		@yield('css')
		<script>
	        window.Laravel = {!! json_encode([
	            'csrfToken' => csrf_token(),
	        ]) !!};
	    </script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>@yield('title')</h1>
				</div>
			</div>
			@yield('content')
		</div>
		@yield('js')
	</body>
</html>
