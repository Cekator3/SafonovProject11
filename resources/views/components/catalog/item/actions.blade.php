@props(['userRole', 'baseModelId'])

<div class="actions">
@switch($userRole)
    @case(App\Enums\UserRole::Guest)
        <a class="link button" href="#">Купить</a>
        @break
    @case(App\Enums\UserRole::Customer)
        <a class="link button" href="#">Купить</a>
        @break
    @case(App\Enums\UserRole::Admin)
        <a class="link button" href="{{ route('base-models.update', ['id' => $baseModelId]) }}">Изменить</a>
        @break
@endswitch
</div>
