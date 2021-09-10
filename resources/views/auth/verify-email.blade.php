@extends('layouts.auth.login')
@section('title', 'Verificação de Email')
@section('header', 'Verificação de Email')

@section('form')
    <p>
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>
    @if (session('status') == 'verification-link-sent')
        <p class="success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </p>
    @endif

    <form control="" class="form-group" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="row">
            <input type="submit" value="{{ __('Resend Verification Email') }}" class="btn">
        </div>
    </form>

    <form control="" class="form-group" method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="row">
            <input type="submit" value="{{ __('Log Out') }}" class="btn">
        </div>
    </form>
@endsection
