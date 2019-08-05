<head>
   @include('layout.partials.head')
 </head>
<body class="login">

      <div class="form-signin">
    <div class="text-center">
        <img src="{{asset('img/logo.png')}}" alt="Metis Logo">
    </div>
    <hr>
    <div class="tab-content">
        <div id="login" class="tab-pane active">

                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="correo electronico" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <input id="password" type="password" class="form-control top @error('password') is-invalid @enderror" name="password" placeholder="contraseña" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                     <!--   <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>-->
                            <div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox"> Recuerdame
                                  </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    Ingresar
                                </button>

                               <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                    </form>
                </div>
        </div>
    </div>
  </div>


<script src="{{ asset('lib/jquery/jquery.js') }}"></script>
<!--Bootstrap -->
<script src="{{ asset('lib/bootstrap/js/bootstrap.js') }}"></script>
</body>
