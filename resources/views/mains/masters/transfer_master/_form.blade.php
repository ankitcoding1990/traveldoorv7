<input type="hidden" name="master_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<input type="hidden" name="city_selected" id="city_selected" value="{{ $transferMaster->master_city ?? null }}">
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Select Master<span class="asterisk">*</span></label>
            {!! Form::select('master_type', ['airport-master' => 'Airport Master','border-master' => 'Border Master', 'railway-master' => 'Railway Master'], null, ["class" => "form-control validate", "id" => "master_type", "placeholder" => "--Select Master--", "autofocus" ]) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Master Name <span class="asterisk">*</span></label>
                {!! Form::text('master_name', null, ["class" => "form-control validate","id" => "master_name", "placeholder" => "Name", "autofocus"]) !!}
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>
    <div class="row mb-10" >
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label> Master Country <span class="asterisk">*</span></label>
                {!! Form::select('master_country', countries()->pluck('country_name', 'id'), null, ["class" => "form-control validate", "id" => "master_country", "placeholder" => "--Select Country--", "autofocus", 'onchange' => 'fetchCities($(this).val())' ]) !!}
                <span class="invalid-feedback"></span>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Master City <span class="asterisk">*</span></label>
                <select name="master_city" id="master_city" class="form-control validate">
                    <option disabled selected hidden id='placeholder'>--Select Country First--</option>
                </select>
                <span class="invalid-feedback"></span>
            </div>
        </div>
    </div>
</div>

