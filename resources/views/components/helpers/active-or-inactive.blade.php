<div class="activeOrInactive-box">
  @if(isset($model))
    @if (isset($column))
      @if($model->$column == null || $model->$column == '')
          <button type="button" class="btn btn-info btn-sm btn-rounded activeOrInactive-button" onclick="changeState('{{ $modelName}}', '{{ $model->id }}', '{{  $column }}', 'delete')">Active</button>
      @else
          <button type="button" class="btn btn-default btn-sm btn-rounded activeOrInactive-button" onclick="changeState('{{ $modelName}}', '{{$model->id}}', '{{$column}}', 'restore')">Inactive</button>
      @endif
    @endif
  @endif
</div>
