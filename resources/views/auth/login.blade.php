@extends('layouts.master_login')
@section('content')
<div class="login-box">
    <div class="login-logo ">
        <img  class="card-img" src="{{ asset('imgRedes/usuario.png') }}" alt="" >
    </div> 
    <div class="card ">
        <div class="card-body login-card-body">
{{--            <p class="login-box-msg">{{ __('Ingreso') }}</p>--}}

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input placeholder="Usuario" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
{{--                <input type="checkbox"> Recordarme--}}
              </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary  btn-xs">Conectarse</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 ">
                            <a href="{{route('register')}}" class="btn btn-danger btn-xs ">Registrar una nueva membresía</a>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{-- <div class="social-auth-links text-center mb-3">
                <p>- O -</p>
                <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook-f mr-2"></i> Ingresar usando Facebook
        </a>
                <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus-g mr-2"></i> Ingresar usando Google+
        </a>
            </div> --}}
            <!-- /.social-auth-links -->

{{--            <p class="mb-1">--}}
{{--                <a href="#">Olvidé mi contraseña</a>--}}
{{--            </p>--}}

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection
