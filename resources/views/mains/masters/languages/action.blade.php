@if (auth()->user()->hasEditPermission($routeName))
    <a href="{{ route('languages.edit', $model->id) }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif

@if ($model->deleted_at!=null && auth()->user()->hasDeletePermission($routeName))
    <a onclick="changeState('Languages', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif
