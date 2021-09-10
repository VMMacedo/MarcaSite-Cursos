@extends('layouts.auth.login')
@section('title', 'Confirmar Senha')
@section('header', 'Confirmar Senha')

@section('form')
    <p>
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

    <form control="" class="form-group" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="row">
            <input type="password" name="password" id="password" class="form__input" placeholder="password" required
                autocomplete="current-password" autofocus>
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
            <input type="submit" value="{{ __('Confirm') }}" class="btn">
        </div>
    </form>
@endsection
