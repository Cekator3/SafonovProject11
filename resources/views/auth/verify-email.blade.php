@extends('layouts.guest')    

@section('title', 'Подтвердить владение почты')

@section('styles')
<link href="/assets/css/customer/auth/common.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<header>
    <h1>Подтверждение электронной почты</h1>
</header>

<p>Спасибо за регистрацию! Для завершения регистрации необходимо перейти по ссылке, присланной на введённую почту: hamsterdreams@inbox.ru</p>

<form method="POST" action="{{ route('verification.send') }}">
    @csrf

    <button>Отправить повторно письмо с подтверждением</button>
</form>

@if (session('status') == 'verification-link-sent')
    <p>Письмо с подтверждением было отправленно повторно</p>
@endif


<form method="GET" action="{{ route('logout') }}">
    @csrf

    <button type="submit">Отменить регистрацию</button>
</form>
@endsection
