<a class="" href="{{route('agents.show',encrypt($model->id))}}" target="_blank"><span class="action-btn"><i class="fa fa-eye"></i></span></a>
<span class="seprator">|</span>
@if (auth()->user()->hasEditPermission($routeName))
    <a class="" href="{{route('agents.edit',encrypt($model->id))}}"><span class="action-btn"><i class="fa fa-edit"> </i></span></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
<span class="seprator">|</span>
    <a class="" href=""><span class="sction-btn" onclick="changePassword('{{route('agents.changePassword.update',['id' => encrypt($model->id)])}}')"><i class="fa fa-key" aria-hidden="true"></i></span></a>
@endif