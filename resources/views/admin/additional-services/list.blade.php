@extends('layouts.main')

@section('title', 'Дополнительные услуги')

@section('styles')
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<ul>
    @foreach ($additionalServices as $additionalService)
        <li>{{ $additionalService->getName() }}</li>
        <img src="{{ $additionalService->getPreviewImageUrl() }}" alt="">
    @endforeach
</ul>
@endsection
