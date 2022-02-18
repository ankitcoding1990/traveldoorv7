@if (auth()->user()->hasEditPermission($routeName))
    <button data-toggle="modal" data-target="#myModal" onclick="fillData({{$model->id}},'{{$model->name}}',{{$model->state_id}})" class="btn btn-primary actions">Edit</button>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
    <button onclick="delColumn({{$model->id}})" class="btn btn-primary actions">Delete</button>
@endif