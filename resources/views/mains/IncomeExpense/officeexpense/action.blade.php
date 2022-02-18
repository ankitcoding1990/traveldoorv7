@if(auth()->user()->hasEditPermission($routeName))
<a href="{{ route('office_expense.edit',$model->id)}}" class="btn btn-primary">Edit</a>
@endif