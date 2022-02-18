@php
$id = encrypt($model->id);
@endphp
@auth
    @if (auth()->user()->hasEditPermission($routeName))
        <a class="actions" href="{{ route('activities.edit', $id) }}"><i class="fa fa-edit"
                aria-hidden="true"></i></a>
    @endif
    @if ($model->deleted_at!=null && auth()->user()->hasDeletePermission($routeName))
    <a onclick="changeState('Activity', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash"
         aria-hidden="true"></i></a>
    @endif
    @if ($filter == 'undrafted')
        @if (auth()->user()->hasViewPermission($routeName))
            <a href="{{ route('activities.show', $id) }}" class="actions"><i class="fa fa-eye"
                    aria-hidden="true"></i></a>
        @endif
        @if (auth()->user()->hasEditPermission($routeName))
            <a href="javascript:void(0)" onclick="CloneActivity({{$model->id}})"><i class="fa fa-copy" 
                aria-hidden="true"></i></a>
        @endif
    @endif
@endauth
@auth('supplier')
    <a class="actions" href="{{ route('activity.edit', $id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
    @if ($model->deleted_at!=null)
        <a onclick="changeState('Activity', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash"
            aria-hidden="true"></i></a>
    @endif
    @if ($filter == 'undrafted')
        <a href="javascript:void(0)" onclick="CloneActivity({{$model->id}})"><i class="fa fa-copy" aria-hidden="true"></i></a>
        <a href="{{ route('activities.show', $id) }}" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
    @endif
@endauth
