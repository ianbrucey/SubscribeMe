@extends('layouts.app')
@section('meta')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>
@endsection
@section('body')
<script src="{{ baseUrlConcat('/js/recaptcha.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-heading text-center"><img src="{{getOtruvezLogoImg()}}" width="100"></h3>
                    <h3 class="card-heading text-center">Register</h3>
                </div>
                @include('partials.social.auth-buttons')

                <div class="card-body">
                    <form class="form-horizontal validate-register" method="POST" action="{{ secureUrl(route('register')) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('first') ? ' has-error' : '' }}">

                            <label for="business_owner" class="col-md-12 text-left control-label">Business owner? Click here</label>
                            <div class="col-md-12">

                                <input id="business_owner" type="checkbox" class="form-control" name="business_owner" value=true autofocus>

                                @if ($errors->has('business_owner'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('business_owner') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <hr style="background-color: #4cb996 !important;">

                        <div class="form-group{{ $errors->has('first') ? ' has-error' : '' }}">
                            <label for="first" class="col-md-4 text-left control-label">First</label>

                            <div class="col-md-12">
                                <input id="first" type="text" class="form-control" name="first" value="{{ old('first') }}" required autofocus>

                                @if ($errors->has('first'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('first') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last') ? ' has-error' : '' }}">
                            <label for="last" class="col-md-4 text-left control-label">Last</label>

                            <div class="col-md-12">
                                <input id="last" type="text" class="form-control" name="last" value="{{ old('last') }}" required>

                                @if ($errors->has('last'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('last') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 text-left control-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 text-left control-label">Password</label>

                            <div class="col-md-12">
                                @include('partials.password-requirements')
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 text-left control-label">Confirm Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div id="recaptcha"></div>
                                <br/>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn theme-background float-left" style="display: none" id="register-button" disabled>
                                    Register
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
