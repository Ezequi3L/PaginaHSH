@extends('layout')

@section('mainContent')
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre y apellido') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="dir" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="dir" type="text" class="form-control" name="dir" value="{{ old('dir') }}" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="dni" type="number" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required>

                                @if ($errors->has('dni'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="fecha_nac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_nac" type="date" class="form-control{{ $errors->has('fecha_nac') ? ' is-invalid' : '' }}" name="fecha_nac" value="{{ old('fecha_nac') }}" required>

                                @if ($errors->has('fecha_nac'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_nac') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pago_tipo" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor de tarjeta') }}</label>

                            <div class="col-md-6">
                                <input id="pago_tipo" type="text" class="form-control{{ $errors->has('pago_tipo') ? ' is-invalid' : '' }}" name="pago_tipo" value="{{ old('pago_tipo') }}" required>

                                @if ($errors->has('pago_tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pago_tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pago_numero" class="col-md-4 col-form-label text-md-right">{{ __('Número de tarjeta') }}</label>

                            <div class="col-md-6">
                                <input id="pago_numero" type="text" class="form-control{{ $errors->has('pago_numero') ? ' is-invalid' : '' }}" name="pago_numero" value="{{ old('pago_numero') }}" required>

                                @if ($errors->has('pago_numero'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pago_numero') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pago_cvv" class="col-md-4 col-form-label text-md-right">{{ __('CVV') }}</label>

                            <div class="col-md-6">
                                <input id="pago_cvv" type="number" class="form-control{{ $errors->has('pago_cvv') ? ' is-invalid' : '' }}" name="pago_cvv" value="{{ old('pago_cvv') }}" required>

                                @if ($errors->has('pago_cvv'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pago_cvv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pago_vencimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de vencimiento') }}</label>

                            <div class="col-md-6">
                                <input id="pago_vencimiento" type="text" class="form-control{{ $errors->has('pago_vencimiento') ? ' is-invalid' : '' }}" placeholder="mm/aa" name="pago_vencimiento" value="{{ old('pago_vencimiento') }}" required>

                                @if ($errors->has('pago_vencimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pago_vencimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Captcha</label>

                            <div class="col-md-6 captcha">
                                <span>{!! captcha_img('flat') !!}</span>
                                <!-- <a href="{{route('refresh_captcha')}}"> --><button type="button" class="btn btn-success btn-refresh">Refresh</button></a>
                            </div>

                            <input type="text" id="captcha" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="Enter Captcha" name ="captcha" required>

                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
