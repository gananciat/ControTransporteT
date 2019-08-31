<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layout.partials.head')
   <script src="{{ asset('lib/jquery/jquery.js') }}"></script>
 </head>

 <body>
 	<div class="bg-dark dk" id="wrap">
 		@include('layout.partials.header')
 		@include('layout.partials.sidebar')
 		@yield('content')

 		<!--include scripts -->
        @include('layout.partials.footer_scripts') 
 	</div>
 	@include('layout.partials.footer')
 	@yield('js')
 </body>
</html>