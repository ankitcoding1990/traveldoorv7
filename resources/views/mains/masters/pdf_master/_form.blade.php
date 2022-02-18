{!! Form::hidden('id', null) !!}
<input type="hidden" name="delContact" id="delContact">
<input type="hidden" name="delAbout" id="delAbout">
<input type="hidden" name="created_by" value="{{auth()->user()->id}}">
<input type="hidden" name="created_by_role" value="{{auth()->user()->users_role}}">
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Title</label>
            {!! Form::text('title', null, ['class' => 'form-control','id' => 'title']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Ending Quotes</label>
            {!! Form::text('content_desciption', null, ['class' => 'form-control','id' => 'content_desciption']) !!}
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <label>Descriptions</label>
            {!! Form::textarea('about_text', null, ['class' => 'form-control','id' => 'about_text','rows' => '6']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>About Image</label>
            {!! Form::file('about_image', ['class' => 'form-control','id' => 'about_image','accept' => 'image/*']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Contact Image</label>
            {!! Form::file('contact_image', ['class' => 'form-control','id' => 'contact_image','accept' => 'image/*']) !!}
        </div>
    </div>
    @isset($pdf)
    <div class="col-sm-5 border-bottom">
        @if($pdf->about_image)
        <div class="form-group">
            <label>Previous Uploaded Image</label><button type="button" class='btn pull-right' onclick='remdiv($(this),"{{$pdf->about_image}}","delAbout")'><i class="fa fa-trash-o" aria-hidden="true"></i></button><br/>
            <img src="{{$pdf->about_image}}" alt="Fail to load">
        </div>
        @else
        <div style="text-align:center">
            <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
            <label class="text-danger">No Previous Uploaded Image</label>
        </div>
        @endif
    </div>
    @endisset
    @isset($pdf)
    <div class="col-sm-5 border-bottom">
        @if($pdf->contact_image)
        <div class="form-group">
            <label>Previous Uploaded Image</label><button type="button" class='btn pull-right' onclick='remdiv($(this),"{{$pdf->contact_image}}","delContact")'><i class="fa fa-trash-o" aria-hidden="true"></i></button><br/>
            <img src="{{$pdf->contact_image}}" alt="Fail to load">
        </div>
        @else
        <div style="text-align:center">
            <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
            <label class="text-danger">No Previous Uploaded Image</label>
        </div>
        @endif
    </div>
    @endisset
</div>
