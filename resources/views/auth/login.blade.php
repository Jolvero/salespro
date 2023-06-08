@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/login.js')}}" defer></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-between">

        <div class="col-lg-5  ml-5">
            <div class="card shadow card-login">
                <img src="{{ '/images/logo.jpeg'}}" class="img-fluid" alt="logo">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="form-login">
                        @csrf

                        <div class="form-group">
                            <label for="email"
                                class=" col-form-label text-md-right text-dark">{{ __('Username') }}</label>

                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username" usernameautofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class=" col-form-label text-md-right text-dark">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-dark" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="offset-md-4">
                                <button type="submit" name="login" id="login" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>

    <div class="col-5 d-lg-block d-none">
        <div id="info" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#info" data-slide-to="0" class="active"></li>
                <li data-target="#info" data-slide-to="1"></li>
                <li data-target="#info" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{'/images/importaciones.jpg'}}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{'/images/asesoria.jpg'}}" alt="Second slide">
              </div>

              <div class="carousel-item">
                <img src="{{'/images/transporte.jpg'}}" class="w-100 d-block img-fluid" alt="">
              </div>

            </div>
            <a class="carousel-control-prev" href="#info" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#info" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>
</div>

@endsection
