{{-- @dd($supplier->id); --}}
@isset($bank)

{!! Form::model($bank, ['method' => 'put', 'route' => ['banks.update', $bank->id],'id'=>'bank_details_edit', 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
@endisset

@empty($bank)
{!! Form::open(['method' => 'post', 'route' => ['banks.store', ['id' => $vendor->id,'type' => $type ?? null]], 'id'=>'bank_details_store', 'onsubmit'=>"ajaxFormSubmit($(this))"]) !!}
@endempty
      {{-- form import fron another file --}}
    @include('common.banks._form-inputs')
    {{-- /form import fron another file --}}
<button class="btn btn-primary pull-right" type="submit">{{ isset($bank) ? 'Update' : 'Save' }}</button>
{!! Form::close() !!}
