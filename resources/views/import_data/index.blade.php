@extends('layouts.main')
@section('title','Import CSV/XLS')
@section('main')
@push('style')
<style>
.col-sm-5{
    margin: 10px;
}
.col-sm-4{
    margin: 15px;
}
</style>
@endpush

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Import Data from CSV/XLS file</h4>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'import-form']) !!}
                    <div class="row">
                        <div class="col-sm-5">
                            {!! Form::label('file', 'Select file from local', []) !!}
                            {!! Form::file('file', ['class' => 'form-control','id' => 'file', 'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel']) !!}
                        </div>
                        <div class="col-sm-5">
                            {!! Form::label('file', 'Select file type', []) !!}
                            {!! Form::select('type', ['csv' => 'CSV','xls' => 'XLS'], null, ['class' => 'form-select','id' => 'type']) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::submit('Upload', ['class' => 'btn btn-info']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
$(document).on('submit','#import-form',function(e){
    e.preventDefault()
    var type = $('#type').val();
    var data = new FormData($(this)[0])
    $.ajax({
        url : '{{ route("import") }}',
        type: 'POST',
        data: data,
        processData: false,
        contentType:false,
        success: function(response){
            console.log(response);
            swal({
                title: response.title,
                message: response.messsage,
                type: response.status,
            })
        }
    })

})
</script>
@endpush
