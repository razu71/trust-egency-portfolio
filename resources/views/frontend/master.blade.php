<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<!-- favicons -->
	<link rel="shortcut icon" href="{{asset(FAVICON_IMAGE_PATH.setting('favicon'))}}" type="image/x-icon">
	<!-- viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- page description -->
	<meta name="description" content="description">
	<!-- styles -->
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/styles.min.css">
	<!-- fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
	<!-- icons -->
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/icons/styles.css">
	
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/theme-colors/theme-03d9a1.css">
    
    @yield('style')
	<style>
        .main-5-slider-content{
            margin-left: 600px;
            margin-top: 240px;
        }
		.wrapper-content{
			background-color: @if(!empty(setting('body_background'))) {{setting('body_background')}} !important; @endif;
		}
		.header-dark{
			background-color: @if(!empty(setting('body_background'))) {{setting('nav')}} !important; @endif;
		}
		.section-2.section-dark.pb-0.s-portfolio{
			background-color: @if(!empty(setting('body_background'))) {{setting('gallery')}} !important; @endif;
		}
		.section.section-dark.s-clients{
			background-color: @if(!empty(setting('body_background'))) {{setting('client_background')}} !important; @endif;
		}
		.footer-top{
			background-color: @if(!empty(setting('body_background'))) {{setting('footer_top')}} !important @endif;
		}
		.footer-form__input, .footer-form__submit{
			background-color: @if(!empty(setting('body_background'))) {{setting('contact_form')}} !important @endif;
			color: #000;
		}
		.footer-bottom{
			background-color: @if(!empty(setting('body_background'))) {{setting('footer')}} !important @endif;
		}
	</style>
</head>

<body class="sticky-header smooth-scroll p-multipage menu-mobile-right">
	<!-- preloader -->
	<div class="preloader"></div>
	<!-- page preloader -->
	<div class="p-preloader">
		<div class="p-preloader__top"></div>
		<div class="p-preloader__bottom"></div>
		<div class="p-preloader__progressbar"></div>
		<div class="p-preloader__percentage">0</div>
	</div>
	<!-- global wrapper -->
	<div class="wrapper">
		<!-- start header(menu) multipage section -->
		<header class="header ">
			<div class="container">
				<div class="row">
					<div class="header-logo col-xs-9 col-sm-3"><a class="header-logo__link" href="./"><img src="{{asset(LOGO_IMAGE_PATH.setting('logo'))}}"></a></div>
					<nav class="menu-nav col-xs-3 col-sm-9">
						<div class="menu-toggle">
							<div class="menu-toggle__inner"></div>
						</div>
						<ul class="menu">
							<li class="menu__item menu-mobile-logo"><a class="header-logo__link" href="./">Trust<span class="theme-color">Enterprise</span></a></li>
							<li class="menu__item submenu-mega"><a href="{{route('home')}}" class="menu__link">Home</a>
							</li>

							<li class="menu__item"><a href="#about_us" class="menu__link">About Us</a></li>

							<li class="menu__item"><a href="#people" class="menu__link">People</a></li>

							{{--<li class="menu__item"><a href="#product" class="menu__link">Our Products</a></li>--}}

							<li class="menu__item submenu-mega"><a href="#gallery" class="menu__link">Gallery</a></li>
							<li class="menu__item"><a href="#clients" class="menu__link">Our Clients</a></li>

							<li class="menu__item">
								<a href="#contact" class="menu__link">Contact</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<!-- end header(menu) multipage section -->
		<div class="wrapper-content">

			@yield('content')

			<!-- start footer 2 section -->
			@include('frontend.footer')
			<!-- end footer 2 section -->

		</div>
		<!-- /.wrapper-content -->
		<!-- start modal window -->
		<div class="modal">
			<div class="ico-108 modal__close"></div>
			<div class="ico-157 modal__info"></div>
			<div class="modal__content"></div>
		</div>
		<div class="overlay"></div>
		<!-- end modal window -->
		

	</div>
	<!-- /.wrapper -->
	<script>
		function setBgImageFromData() {
			var el = document.querySelectorAll('[data-background-image]');
			for (var i = 0; i < el.length; i++) {
				if (getComputedStyle(el[i]).backgroundImage === 'none') el[i].style.backgroundImage = 'url(' + el[i].getAttribute('data-background-image') + ')';
			}
		}
		setBgImageFromData();

		//async loading scripts with callback
		function loadjs(src, callback) {
			var script = document.createElement('script');
			script.src = src;
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(script, s);
			var loaded = false;

			function onload() {
				if (loaded) return;
				loaded = true;
				if (callback) callback();
			}
			script.onload = onload;
			script.onreadystatechange = function() {
				if (this.readyState === 'loaded' || this.readyState === 'complete') {
					setTimeout(onload, 0);
				}
			}
		}
		loadjs('{{asset('frontend')}}/assets/js/jquery.min.js', function() {
			loadjs('{{asset('frontend')}}/assets/js/libs.min.js', function() {
				loadjs('{{asset('frontend')}}/assets/js/common.min.js');
			});
		});
	</script>

@yield('script')
</body>

</html>