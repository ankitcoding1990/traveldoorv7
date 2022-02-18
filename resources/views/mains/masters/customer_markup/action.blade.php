@if (auth()->user()->hasEditPermission($routeName))
<a href="{{ route('customer_markup.edit',$model->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
<a href="javascript::" onclick="changeState('CustomerMarkup', '{{ $model->id }}', 'deleted_at' , 'permanent')"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif