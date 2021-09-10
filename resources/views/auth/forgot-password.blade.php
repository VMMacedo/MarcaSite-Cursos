@extends('layouts.auth.login')
@section('title', 'Esqueci a senha')
@section('header', 'Esqueci a senha')

@section('form')
    <p>
        {{ __('Apenas informe seu endereço de e-mail que enviaremos um link que permitirá definir uma nova senha.') }}
    </p>

    <form control="" class="form-group" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="row">
            <input type="text" name="email" id="email" class="form__input" placeholder="Email" :value="old('email')"
                required autofocus>
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
            <input type="submit" value="Enviar Link" class="btn">
        </div>

    </form>

@endsection
