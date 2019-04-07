<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="/public/unisharp/laravel-ckeditor/ckeditor.js"></script>
	<script src="/public/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/foundation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
	<div id="app">
	<div class="top-bar">
	  <div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
		  <li class="menu-text">Admin Panel</li>
			@auth
		  <li><a href="{{route('admin.index')}}">Panel</a></li>
			<li>
			<a href="#">Blog</a>
			<ul class="menu vertical">
				<li><a href="{{route('admin.category.index')}}">Categoryis</a></li>
				<li><a href="{{route('admin.article.index')}}">Articles</a></li>
				<li><a href="{{route('admin.language.index')}}">Languages</a></li>
			</ul>
		  </li>
				@endauth
		  @guest
				<li><a href="{{ route('login') }}">Login</a></li>
				@auth
				<li><a href="{{ route('register') }}">Register</a></li>
				@endauth
			@else
				<li>
				  <a href="#">{{ Auth::user()->name }}</a>
				  <ul class="menu">
					<li>
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				  </ul>
				</li>
			@endguest
		</ul>
	  </div>
		{{--
	  <div class="top-bar-right">
		<ul class="menu">
		  <li><input type="search" placeholder="Search"></li>
		  <li><button type="button" class="button">Search</button></li>
		</ul>
	  </div>--}}
	</div>

        @yield('content')
    </div>

    <!-- Scripts -->

	<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
