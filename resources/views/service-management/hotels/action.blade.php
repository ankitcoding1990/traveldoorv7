@php
    $id = encrypt($model->id)
@endphp
@auth
@if (auth()->user()->hasEditPermission($routeName))
<a class="actions" href="{{ route('hotels.edit',$id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
@endif
@if (auth()->user()->hasDeletePermission($routeName))
<a onclick="delColumn({{$model->id}})" href="javascript:void(0)" class="actions"><i class="fa fa-trash" aria-hidden="true"></i></a>
@endif
{{-- @if ($filter == 'undrafted') --}}
@if (auth()->user()->hasViewPermission($routeName))
    <a  href="{{ route('hotels.show', $id) }}" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
@endif
{{-- @endif --}}
@endauth
@auth('supplier')
<a class="actions" href="{{ route('hotel.edit',$id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
<a onclick="delColumn({{$model->id}})" href="javascript:void(0)" class="actions"><i class="fa fa-trash" aria-hidden="true"></i></a>
<a  href="{{ route('hotel.show', $id) }}" class="actions"><i class="fa fa-eye" aria-hidden="true"></i></a>
@endauth
