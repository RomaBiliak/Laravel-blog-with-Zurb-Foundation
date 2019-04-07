@extends('admin.layouts.app_admin')

@section('content')

<div class="row">
    <div class="columns small-3"></div>
    <div class="columns small-6">
        <form class="callout text-center" action="{{ route('login') }}" method="POST" >
            @csrf
            <h2>{{ __('Login') }}</h2>

            <div class="floated-label-wrapper">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input type="text" id="email"  value="{{ old('email') }}"  name="email" required class=" {{ $errors->has('email') ? ' is-invalid-input' : '' }}" placeholder="{{ __('E-Mail Address') }}" required autofocus  >

            @if ($errors->has('email'))
                    <span class="form-error is-visible" role="alert">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="floated-label-wrapper">
                <label for="pass">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required class=" {{ $errors->has('password') ? ' is-invalid-input' : '' }}" placeholder="{{ __('Password') }}">

            @if ($errors->has('password'))
                <span class="form-error is-visible" role="alert">{{ $errors->first('password') }}</span>
            @endif
            </div>
            <div class="floated-label-wrapper">
                <label for="remember">{{ __('Remember Me') }}</label>
                <div class="switch">
                    <input class="switch-input" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="switch-paddle" for="remember">
                        <span class="show-for-sr">{{ __('Remember Me') }}</span>
                    </label>

                </div>
            </div>

            <input class="button expanded" type="submit" value="{{ __('Login') }}">
            <a  href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </form>
    </div>
    <div class="columns small-3"></div>
</div>


@endsection
