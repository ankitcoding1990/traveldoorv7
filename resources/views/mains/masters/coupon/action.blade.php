<a href="{{route('coupon.show',$model->id)}}" class="btn btn-info">View</a>
@if (auth()->user()->hasEditPermission($routeName))
    <a class="btn btn-primary actions" href="{{ route('coupon.edit',$model->id) }}">Edit</a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
    <button onclick="delColumn({{$model->id}})" class="btn btn-primary">Delete</button>
@endif