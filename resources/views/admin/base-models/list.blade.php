@extends('layouts.main')

@section('title', 'Модельки')

@section('styles')
{{-- Form --}}

{{-- Specific --}}
@endsection

@section('navigation')
<x-navigation.admin />
@endsection

@section('main')
<header>
    <h1>Модельки</h1>

    <div class="actions">
        <x-search :placeholder=" 'Поиск' "
                :name=" 'search' "
                :url=" route('base-models') "
        />

        <form method="GET" action="{{ route('base-models.create') }}">
            <x-forms.submit :placeholder=" 'Создать' " />
        </form>
    </div>
</header>

<ul class='base-models'>
@foreach ($baseModels as $baseModel)
<li>
    <section class="base-model">
        {{-- ... --}}
    </section>
</li>
@endforeach
</ul>

@endsection
