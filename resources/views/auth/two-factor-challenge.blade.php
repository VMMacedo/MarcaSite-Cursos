@extends('layouts.auth.login')
@section('title', 'Autenticação')
@section('header', 'Confirme sua autenticação')

@section('form')
    <p class="codeAuth">
        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
    </p>
    <p class="codeEmgerAuth" style="display: none">
        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
    </p>

    <form control="" class="form-group" method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="row codeAuth">
            <input class="form__input" type="text" inputmode="numeric" name="code" id="code" autofocus
                autocomplete="one-time-code">
        </div>

        <div class="row codeEmgerAuth" style="display: none">
            <input class="form__input" type="text" name="recovery_code" id="recovery_code" autofocus
                autocomplete="one-time-code">
        </div>

        <div class="row">
            <a href="#" class="codeAuth" id="codeAuth">
                {{ __('Use a recovery code') }}
            </a>
            <a href="#" class="codeEmgerAuth" id="codeEmgerAuth" style="display: none">
                {{ __('Use an authentication code') }}
            </a>

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

        </div>


        <div class="row">
            <input type="submit" value="{{ __('Log in') }}" class="btn">
        </div>

    </form>

@endsection
