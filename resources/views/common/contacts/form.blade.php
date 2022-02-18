
@php
  $data = ['type' => $type];
  if (isset($agent)) {
    $data['agent_id'] = $agent->id;
  }
  if (isset($supplier)) {
    $data['supplier_id'] = $supplier->id;
  }
@endphp
@isset($contact)
  @php
    $data[0] = $contact->id;
  @endphp
  {!! Form::model($contact, ['method' => 'put', 'route' => ['contacts.update', $data], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
@endisset
@empty ($contact)
  {!! Form::open(['method' => 'post', 'route' => ['contacts.store', $data], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
@endempty

{{-- import form --}}
@include('common.contacts._form-inputs')
{{-- /Import form --}}

<button type="submit" class="btn btn-primary">{{ isset($contact) ? 'Update' : 'Submit' }} </button>
@empty ($contact)
  <button type="reset" class="btn btn-light">Cancel </button>
@endempty


{!! Form::close() !!}
