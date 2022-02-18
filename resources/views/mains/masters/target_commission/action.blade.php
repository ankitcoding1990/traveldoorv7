@if (auth()->user()->hasEditPermission($routeName))
    <a href="{{ route('target_commission.edit',$model->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
    <a href="javascript::" onclick="changeState('SettingTargetCommission', '{{ $model->id }}', 'deleted_at' , 'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif