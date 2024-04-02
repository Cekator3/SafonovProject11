@extends('layouts.main')

@section('title', 'Личный кабинет')

@section('styles')
{{-- Form --}}
<link href="/assets/css/form/common.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/text.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/file.css" rel="stylesheet" type="text/css">
<link href="/assets/css/form/submit.css" rel="stylesheet" type="text/css">

{{-- Specific --}}
<link href="/assets/css/customer/user-profile.css" rel="stylesheet" type="text/css">
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')

<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <fieldset>
            <legend>Обновить пароль</legend>

            {{-- Old password --}}
            <x-forms.inputs.text :type=" 'password' "
                                :name=" 'old_password' "
                                :placeholder=" 'Текущий пароль' "
                                autocomplete="current-password"
            />

            {{-- New password --}}
            <x-forms.inputs.text :type=" 'password' "
                                :name=" 'new_password' "
                                :placeholder=" 'Новый пароль' "
            />

            {{-- New password --}}
            <x-forms.inputs.text :type=" 'password' "
                                :name=" 'new_password_confirm' "
                                :placeholder=" 'Повторение нового пароля' "
            />
        </fieldset>
    </div>

    <div>
        <fieldset class="profile-picture">
            <legend>Аватарка</legend>
            {{-- <img src="{{ $profilePicture }}"> --}}
            <x-forms.inputs.file :name=" 'profile_picture' "
                                :placeholder=" 'Загрузите аватарку' "
                                accept="image/*"
            />
        </fieldset>

        <x-forms.submit :placeholder=" 'Сохранить' "/>
    </div>
</form>
@endsection
