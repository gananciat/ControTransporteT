<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layout.partials.head')
   @include('layout.partials.footer_scripts')
 </head>

 <body>
 	<div class="bg-dark dk" id="wrap">
 		@include('layout.partials.header')
 		@include('layout.partials.sidebar')
 		@yield('content')
 	</div>
 	@include('layout.partials.footer')
 	@yield('js')
 </body>
</html>