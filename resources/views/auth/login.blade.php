@extends('layouts.auth.login')
@section('title', 'Login')
@section('header', 'MARCASITE CURSO')

@section('form')
    <form control="" class="form-group" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row">
            <input type="text" name="email" id="email" class="form__input" placeholder="Email" :value="old('email')"
                required autofocus>
        </div>
        <div class="row">
            <!-- <span class="fa fa-lock"></span> -->
            <input type="password" name="password" id="password" class="form__input" placeholder="Senha" type="password"
                required autocomplete="current-password">
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <input type="checkbox" id="remember_me" name="remember" class="">
            <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="row">
            <input type="submit" value="{{ __('Entrar') }}" class="btn">
        </div>
        <div class="row">
            @if (Route::has('register'))
                <a class="btn"  href="{{ route('register') }}">
                    {{ __('Registrar') }}
                </a>
            @endif
        </div>
        <div class="row">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        
    </form>

@endsection
