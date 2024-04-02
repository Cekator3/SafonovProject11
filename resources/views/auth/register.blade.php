@extends('layouts.main')

@section('title', 'Зарегистрироваться')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/checkbox-radio.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/actions.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
@endsection

@section('main')
<header>
    <ul class="actions">
        <li class="action another"><a href="{{ route('login') }}">Вход</a></li>
        <li class="action separator"></li>
        <li class="action current">Регистрация</li>
    </ul>
</header>

<form action="{{ route('register') }}" method="post">
    @csrf

    {{-- Email --}}
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

    {{-- Password confirmation --}}
    <x-forms.inputs.text :type=" 'password' "
                         :name=" 'password_confirmation' "
                         :placeholder=" 'Подтверждение пароля' "
                          required=""
                          autocomplete="current-password"
    />

    {{-- Remember me --}}
    <x-forms.inputs.checkbox-radio :name=" 'remember_me' "
                                   :placeholder=" 'Запомнить меня' "
    />

    {{-- Submit --}}
    <x-forms.submit :placeholder=" 'Войти' " />
</form>
@endsection
