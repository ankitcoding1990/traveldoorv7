@if($isSupplier)
    <a class="actions" href="{{ route('restaurant.edit', $model->id) }}"><i class="fa fa-edit"
        aria-hidden="true"></i></a>
    @if ($model->deleted_at!=null)
        <a onclick="changeState('Restaurants', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
    @endif
    <a href="{{ route('restaurant.show', $model->id) }}"><i class="fa fa-eye"
        aria-hidden="true"></i></a>
@else
    @if (auth()->user()->hasEditPermission($routeName))
        <a class="actions" href="{{ route('restaurants.edit', $model->id) }}"><i class="fa fa-edit"
            aria-hidden="true"></i></a>
    @endif

    @if ($model->deleted_at!=null && auth()->user()->hasDeletePermission($routeName))
    <a onclick="changeState('Restaurants', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
    @endif

    @if (auth()->user()->hasViewPermission($routeName))
        <a href="{{ route('restaurants.show', $model->id) }}"><i class="fa fa-eye"
            aria-hidden="true"></i></a>
    @endif
@endif

