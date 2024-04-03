@extends('layouts.main')

@section('title', 'Восстановить аккаунт')

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
<x-navigation.guest />
@endsection

@section('main')
<header>
    <h1>Восстановление аккаунта</h1>
</header>

@session('status')
    <p>{{ session('status') }}</p>
@endsession

<!-- Session Status -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <x-forms.inputs.text :type=" 'email' "
                         :name=" 'email' "
                         :placeholder=" 'Email' "
                          required=""
                          autofocus=""
                          autocomplete="username"
    />

    <x-forms.submit :placeholder=" 'Продолжить' " />
</form>
@endsection
