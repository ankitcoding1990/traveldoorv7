@if(auth()->user()->hasEditPermission($routeName))
<a href="{{ route('office_income.edit',$model->id)}}" class="btn btn-primary">Edit</a>
@endif