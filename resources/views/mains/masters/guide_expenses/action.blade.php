@if (auth()->user()->hasEditPermission($routeName))
<a href="{{ route('guide_expenses.edit',$model->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
<a onclick="delColumn({{$model->id}})" href="javascript::"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif
