@if (auth()->user()->hasEditPermission($routeName))
<a href="{{route('transfer_master.edit',$model->id)}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
<a href="javascript::" onclick="delColumn({{$model->id}})" ><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif
