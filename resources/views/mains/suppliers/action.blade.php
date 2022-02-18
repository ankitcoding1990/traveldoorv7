<a href="{{route('suppliers.show',encrypt($model->id))}}" target="_blank"><span class="action-btn"><i class="fa fa-eye"> View</i></span></a>
<span class="seprator">|</span>
@if (auth()->user()->hasEditPermission($routeName))
    <a href="{{route('suppliers.edit',encrypt($model->id))}}"><span class="action-btn"><i class="fa fa-edit"> Edit</i></span></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
    <span class="seprator">|</span> 
    <a href=""><span class="sction-btn" onclick="changePassword('{{route('suppliers.changePassword',['id' => encrypt($model->id)])}}')"><i class="fa fa-key" aria-hidden="true"> Password</i></span></a>
@endif