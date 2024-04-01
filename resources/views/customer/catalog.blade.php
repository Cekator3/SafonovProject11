@extends('layouts.main')

@section('title', 'Каталог')

@section('styles')
@endsection

@section('navigation')
@if (Auth::guest())
    <x-navigation.guest />
@else
    <x-navigation.customer />
@endif
@endsection

@section('main')
a
@endsection
