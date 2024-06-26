@extends('layouts.main')

@section('title', 'Войти')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/actions.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/login.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
@endsection

@section('main')
<header>
    <ul class="actions">
        <li class="action current">Вход</li>
        <li class="action separator"></li>
        <li class="action another"><a href="{{ route('register') }}">Регистрация</a></li>
    </ul>
</header>

<form action="{{ route('login') }}" method="post">
    @csrf

    {{-- Login --}}
    <x-forms.inputs.text :type=" 'email' "
                         :name=" 'email' "
                         :placeholder=" 'Email' "
                          required=""
                          autofocus=""
                          autocomplete="username"
    />

    {{-- Password --}}
    <x-forms.inputs.text :type=" 'password' "
                         :name=" 'password' "
                         :placeholder=" 'Пароль' "
                          required=""
                          autocomplete="current-password"
    />

    <div class="input-field options">
        {{-- Remember me --}}
        <x-forms.inputs.checkbox-radio :name=" 'remember_me' "
                                       :placeholder=" 'Запомнить меня' "
        />

        {{-- Forgot password --}}
        <div class="forgot-password">
            <a href="{{ route('password.request') }}">Восстановить пароль</a>
        </div>
    </div>

    {{-- Submit --}}
    <x-forms.submit :placeholder=" 'Войти' " />
</form>
@endsection
