@if(auth()->user()->hasEditPermission($routeName))
<a href="{{ route('expense.edit',$model->id)}}" class="btn btn-primary">Edit</a>
@endif