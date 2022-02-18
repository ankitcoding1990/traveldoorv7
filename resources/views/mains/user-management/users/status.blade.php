<div class="activeOrInactive-box">
    @if(isset($model))
        @if($model->users_status == null || $model->users_status == '' || $model->users_status == 1)
            <button type="button" class="btn btn-info btn-sm btn-rounded activeOrInactive-button" onclick="ChangeUserState('{{ $model->id }}', 'inactive')">Active</button>
        @else
            <button type="button" class="btn btn-default btn-sm btn-rounded activeOrInactive-button" onclick="ChangeUserState('{{$model->id}}', 'active')">Inactive</button>
        @endif
    @endif
  </div>