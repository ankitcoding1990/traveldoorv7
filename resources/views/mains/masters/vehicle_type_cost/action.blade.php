@if (auth()->user()->hasEditPermission($routeName))
    <a href="{{ route('vehicles_type_cost.edit', $model->id) }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    <a href="javascript::" onclick="delUser({{ $model->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif
