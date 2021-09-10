@extends('layouts.auth.login')
@section('title', 'Registrar')
@section('header', 'MARCASITE CURSO')

@section('form')
    <form control="" class="form-group" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row">
            <input type="text" name="name" id="name" class="form__input" placeholder="Nome" :value="old('name')" required
                autofocus>
        </div>
        <div class="row">
            <input type="text" name="email" id="email" class="form__input" placeholder="Email" :value="old('email')"
                required autofocus>
        </div>
        <div class="row">
            <select class="form__input" name="id_perfil" id="id_perfil" aria-label="Default select example">
                <option selected disabled>Selecione...</option>
                <option value="1">Operador</option>

            </select>
        </div>
        <div class="row">
            <!-- <span class="fa fa-lock"></span> -->
            <input type="password" name="password" id="password" class="form__input" placeholder="Senha" type="password"
                required autocomplete="current-password">
        </div>
        <div class="row">
            <!-- <span class="fa fa-lock"></span> -->
            <input type="password" name="password_confirmation" id="password_confirmation" class="form__input"
                placeholder="Confirmar Senha" required autocomplete="current-password">
        </div>
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
        @endif
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
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <div class="row">
            <input type="submit" value="{{ __('Register') }}" class="btn">
        </div>


    </form>

@endsection
