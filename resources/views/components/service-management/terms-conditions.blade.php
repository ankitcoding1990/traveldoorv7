<div>
    <div class="col-sm-12">
        <label> Admin Cancellation Policy </label>
        {!! Form::textarea('cancel_policy',$model->terms_conditions ??  null, ['class' => 'form-control','id' => 'cancel_policy']) !!}
    </div>
    <div class="col-sm-12">
        <label> Admin Terms And Condition </label>
        {!! Form::textarea('terms_conditions',$model->cancel_policy ??  null, ['class' => 'form-control','id' => 'terms_conditions']) !!}
    </div>
    <div class="col-sm-12">
        <label> Admin Confirmation Message </label>
        {!! Form::textarea('confirm_message',$model->confirm_message ?? null, ['class' => 'form-control','id' => 'confirm_message']) !!}
    </div>
</div>
@push('scripts')
<script>
CKEDITOR.replace('cancel_policy');
CKEDITOR.replace('terms_conditions');
CKEDITOR.replace('confirm_message');
</script>
@endpush
