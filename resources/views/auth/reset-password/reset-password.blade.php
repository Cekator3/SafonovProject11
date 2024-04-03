@extends('layouts.main')

@section('title', 'Сбросить пароль')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/forgot-password.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
@endsection

@section('main')
<header>
    <h1>Введите новый пароль</h1>
</header>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Address -->
    <input hidden name="email" value="{{ old('email', $email) }}" />

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

    {{-- Submit --}}
    <x-forms.submit :placeholder=" 'Сбросить пароль' " />
</form>
@endsection
