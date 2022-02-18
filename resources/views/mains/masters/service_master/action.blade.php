@if (auth()->user()->hasViewPermission($routeName))
<a href="{{route('service_master.show',$model->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasEditPermission($routeName))
<a href="{{ route('service_master.edit',$model->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
@if ($model->deleted_at!=null && auth()->user()->hasDeletePermission($routeName))
    <a onclick="changeState('Services', '{{ $model->id }}', 'deleted_at' ,'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif