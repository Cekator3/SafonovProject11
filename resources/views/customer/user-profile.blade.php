@extends('layouts.main')

@section('title', 'Личный кабинет')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')

<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <fieldset>
        <legend>Обновить пароль</legend>

        {{-- Old password --}}
        <x-forms.inputs.text :type=" 'password' "
                             :name=" 'old_password' "
                             :placeholder=" 'Текущий пароль' "
                             required=""
                             autocomplete="current-password"
        />

        {{-- New password --}}
        <x-forms.inputs.text :type=" 'password' "
                             :name=" 'new_password' "
                             :placeholder=" 'Новый пароль' "
                             required=""
        />

        {{-- New password --}}
        <x-forms.inputs.text :type=" 'password' "
                             :name=" 'new_password_confirm' "
                             :placeholder=" 'Повторение нового пароля' "
                             required=""
        />
    </fieldset>

    <fieldset class="profile-picture">
        <legend>Аватарка</legend>
        <img src="{{ $profilePicture }}" alt="">
        <x-forms.inputs.file :name=" 'profile_picture' "
                             :placeholder=" 'Загрузите аватарку' "
        />
    </fieldset>

    <x-forms.submit :placeholder=" 'Сохранить' " />
</form>
@endsection
