@extends('layouts.main')

@section('title', 'Подтвердить владение почты')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/customer/auth/verify-email.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
@endsection

@section('main')
<header>
    <h1>Подтвердите email</h1>
</header>

@if ($emailVerification->isResent())
    <p>Ссылка была отправлена повторно на почту {{ $emailVerification->getEmail() }}</p>
@else
    <p>Перейдите по ссылке, отправленной на почту {{ $emailVerification->getEmail() }}.</p>
@endif

<div class="actions">
    <form method="POST" action="{{ route('verification.email.send') }}">
        @csrf

        <x-forms.submit :placeholder=" 'Повторно отправить ссылку' "/>
    </form>

    <form method="GET" action="{{ route('cancel.registration') }}">
        @csrf

        <x-forms.submit :placeholder=" 'Пройти регистрацию заново' "/>
    </form>
</div>


@endsection
