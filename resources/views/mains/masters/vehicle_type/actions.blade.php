@if (auth()->user()->hasEditPermission($routeName))
    <a href="{{ route('vehicles_types.edit', $model->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif

@if (auth()->user()->hasDeletePermission($routeName))
    <a href="javascript::" onclick="delUser({{$model->id}})" ><i class="fa fa-trash-o" aria-hidden="true"></i></a href="javascript::">
@endif
