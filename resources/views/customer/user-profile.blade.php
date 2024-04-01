@extends('layouts.main')

@section('title', 'Личный кабинет')

@section('styles')
@endsection

@section('navigation')
<x-navigation.customer />
@endsection

@section('main')
<img src="{{ $user->getProfilePicture() }}" alt="">
<p>{{ $user->getEmail() }}</p>

<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <fieldset>
        <legend>Персональные данные</legend>
        <x-forms.inputs.text :type=" 'email' "
                             :name=" 'email' "
                             :placeholder=" 'Email' "
                             required=""
                             autofocus=""
                             value="{{ $user->getEmail() }}"
                             autocomplete="username"
        />
    </fieldset>

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
</form>
@endsection
