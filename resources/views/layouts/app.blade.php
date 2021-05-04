<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.82.0">
	<title>Комплаенс</title>

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/headers.css') }}" rel="stylesheet">
</head>

<body>
	<div id="spinner">
		<div class="d-flex justify-content-center">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>

	<div class="container">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<img src="{{ asset('img/logo.png') }}" alt />
			</a>
			@auth
			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				<li class="nav-item"><a href="{{ route('home') }}" class="nav-link link-dark">Главная</a></li>
				<li class="nav-item"><a href="{{ route('atc') }}" class="nav-link link-dark">Основные операции</a></li>
				<li class="nav-item"><a href="{{ route('check') }}" class="nav-link link-dark">Проверка клиентов банка</a></li>
			</ul>
			@endauth
			<div class="col-md-3 text-end">
				@auth
				<form action="{{ route('signout') }}" method="post">
					@csrf
					<button type="submit" class="btn btn-outline-dark me-2">Выход</button>
				</form>
				@endauth
			</div>
		</header>
	</div>

	@yield('content')


	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<script>
		let spinner = document.querySelector("#spinner");

		var select = document.getElementById("select_input");
		if (typeof(select) != 'undefined' && select != null) {
			for (let i = 50; i <= 100; i += 5) {
				var option = document.createElement("option");
				option.text = i;
				select.add(option);
				select.value = i;
			}
		}

		document.addEventListener('DOMContentLoaded', function() {
			setTimeout(() => {
				spinner.style.display = "none";
			}, 300);
		})

		window.onwaiting(function(){
			
		})

	</script>



</body>

</html>