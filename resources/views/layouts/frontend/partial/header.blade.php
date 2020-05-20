
<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="https://intro.karnurmax.kz" class="logo">Профиль компании</a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{route('mainhome')}}">Портал</a></li>
				<li><a href="{{route('post.index')}}">Посты</a></li>
				<li><a href="{{route('plugin.index')}}">Плагины</a></li>
				@guest
				<li><a href="{{route('login')}}">Войти</a></li>
				@else

				@if(Auth::user()->role->id == 1)
				<li><a href="{{route('admin.dashboard')}}">Личный кабинет</a></li>
				@endif

				@if(Auth::user()->role->id == 2)
				<li><a href="{{route('author.dashboard')}}">Личный кабинет</a></li>
				@endif

				
				@if(Auth::user()->role->id == 3)
				<li><a href="{{route('dev.dashboard')}}">Личный кабинет</a></li>
				@endif

				@endguest


			</ul><!-- main-menu -->

			<div class="src-area">
			<form method="GET" action="{{ route('search') }}">
                    <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    <input class="src-input" name="query" type="text" placeholder="Искать">
                </form>
			</div>

		</div><!-- conatiner -->
	</header>