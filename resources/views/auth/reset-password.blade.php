@extends('layouts.auth.login')
@section('title', 'Redefinir Senha')
@section('header', 'Redefinir Senha')

@section('form')
    <form control="" class="form-group" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="row">
            <input type="text" name="email" id="email" class="form__input" placeholder="Email"
                :value="old('email', $request->email)" required autofocus>
        </div>
        <div class="row">
            <input type="password" name="password" id="password" class="form__input" placeholder="Senha" type="password"
                required autocomplete="new-password">
        </div>
        <div class="row">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form__input"
                placeholder="Confirmar Senha" type="password" required autocomplete="new-password">
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
            <input type="submit" value=" {{ __('Reset Password') }}" class="btn">
        </div>

    </form>

@endsection
