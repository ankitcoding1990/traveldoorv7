<a href="{{route('pdf_master.show',$model->id)}}" class="btn btn-info">View</a>
@if (auth()->user()->hasEditPermission($routeName))
    <a class="btn btn-primary actions" href="{{ route('pdf_master.edit',$model->id) }}">Edit</a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
    <button onclick="delColumn({{$model->id}})" class="btn btn-primary">Delete</button>
@endif