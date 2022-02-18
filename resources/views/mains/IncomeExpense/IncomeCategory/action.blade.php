@if(auth()->user()->hasEditPermission($routeName))
<a href="{{ route('incomes.edit',$model->id)}}" class="btn btn-primary">Edit</a>
@endif