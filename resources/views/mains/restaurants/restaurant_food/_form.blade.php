<input type="hidden" name="food_created_by" value="{{session()->get('travel_users_id')}}">
<input type="hidden" name="food_role" value="{{session()->get('travel_users_role')}}">

                    <div class="row mb-10">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="restaurant">RESTAURANT<span class="asterisk">*</span></label>
                                {!! Form::select('restaurant_id_fk', $fetch_restaurants->pluck('restaurant_name','restaurant_id'), null, ['id' => 'restaurant', 'class' => 'form-control select2','placeholder' => '--SELECT RESTAURANT--']) !!}
                                @error('restaurant_id_fk')
                                <p class="text-danger">{{ 'The restaurant field is required.' }}</p>
                                @enderror
                                {{-- <select id="restaurant" name="restaurant" class="form-control select2">
                                    <option value="0">--SELECT RESTAURANT--</option>
                                    @foreach($fetch_restaurants as $restaurant)
                                    <option value="{{$restaurant->restaurant_id}}">{{$restaurant->restaurant_name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="menu_category">CATEGORY<span class="asterisk">*</span></label>
                                {!! Form::select('menu_category_id_fk', $menu_categories->pluck('restaurant_menu_category_name','restaurant_menu_category_id'), null, ['id' => 'menu_category' ,'class' => 'form-control select2' ,'placeholder' => '--SELECT CATEGORY--']) !!}
                                @error('menu_category_id_fk')
                                    <p class="text-danger">{{ 'The menu category field is required.'}}</p>
                                @enderror
                                {{-- <select id="menu_category" name="menu_category" class="form-control select2">
                                    <option value="0">--SELECT CATEGORY--</option>
                                    @foreach($menu_categories as $category)
                                    <option value="{{$category->restaurant_menu_category_id}}">{{$category->restaurant_menu_category_name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="food_name">FOOD / DRINKS NAME <span class="asterisk">*</span></label>
                                {!! Form::text('food_name', null, ['id' => 'food_name', 'class' => 'form-control', 'placeholder' => 'FOOD / DRINKS NAME']) !!}
                                {{-- <input type="text" id="food_name" name="food_name" class="form-control" placeholder="FOOD / DRINKS NAME"> --}}
                                @error('food_name')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="food_price">FOOD / DRINKS PRICE<span class="asterisk">*</span></label>
                                {!! Form::text('food_price', null, ['id' => 'food_price', 'class' => 'form-control', 'placeholder' => 'FOOD / DRINKS PRICE']) !!}
                                {{-- <input type="text" id="food_price" name="food_price" class="form-control" placeholder="FOOD / DRINKS PRICE" onkeypress="javascript:return validateNumber(event)" onpaste="javascript:return validateNumber(event)"> --}}
                                @error('food_price')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="food_discounted_price">FOOD / DRINKS DISCOUNTED PRICE</label>
                                {!! Form::text('food_discounted_price', null, ['id' => 'food_discounted_price', 'class' => 'form-control', 'placeholder' => 'DISCOUNTED PRICE']) !!}
                                {{-- <input type="text" id="food_discounted_price" name="food_discounted_price" class="form-control" placeholder="DISCOUNTED PRICE" onkeypress="javascript:return validateNumber(event)" onpaste="javascript:return validateNumber(event)"> --}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="food_unit">FOOD / DRINKS UNIT <span class="asterisk">*</span></label>
                                {!! Form::text('food_unit', null, ['id' => 'food_unit', 'class' => 'form-control', 'placeholder' => 'For example: L, ml, Kg, g, plate']) !!}
                                {{-- <input type="text" id="food_unit" name="food_unit" class="form-control" placeholder="For example: L, ml, Kg, g, plate"> --}}
                                @error('food_unit')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="food_unit">FOOD / DRINKS PACKAGE COUNT <span class="asterisk">*</span></label>
                                {!! Form::text('food_package_count', '1', ['id' => 'food_package_count', 'class' => 'form-control', 'placeholder' => '1']) !!}
                                {{-- <input type="text" id="food_package_count" name="food_package_count" class="form-control" placeholder="1" value="1" onkeypress="javascript:return validateNumber(event)" onpaste="javascript:return validateNumber(event)"> --}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <br>
                                <label for="food_available_for_delivery">AVAILABLE FOR DELIVERY</label>
                                &nbsp;&nbsp;<input type="checkbox" name="food_available_for_delivery" id="food_available_for_delivery" value="yes" class="checkbox-col-primary" {{isset($foods) && $foods->food_available_for_delivery == 'yes' ? 'checked' : ''}}>
                                <label for="food_available_for_delivery">&nbsp;</label>
                            </div>

                            <div class="form-group">
                                    <label>Food Type</label>
                                    <input type="radio" id="radio_20" class="with-gap radio-col-primary" name="food_type" value="veg" {{isset($foods) && $foods->food_type == 'veg' ? 'checked': ''}}>
                                    <label for="radio_20">Veg </label>
                                    <input type="radio" id="radio_21" class="with-gap radio-col-primary" name="food_type" value="non_veg" {{isset($foods) && $foods->food_type == 'non_veg' ? 'checked': ''}}>
                                    <label for="radio_21">Non Veg</label>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <br>
                                <label for="food_featured">FEATURED</label>

                                &nbsp;&nbsp;<input type="checkbox" name="food_featured" id="food_featured" value="yes" class="checkbox-col-primary" {{isset($foods) && $foods->food_featured == 'yes' ? 'checked': ''}}>
                                <label for="food_featured">&nbsp;</label>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label id="food_drinks_ingredient" for="food_unit">FOOD / DRINKS INGREDIENTS ( , )</label>
                                {!! Form::text('food_ingredients', null, ['id' => 'food_ingredients', 'class' => 'form-control', 'placeholder' => 'FOOD / DRINKS INGREDIENTS']) !!}
                                {{-- <input type="text" id="food_ingredients" name="food_ingredients" class="form-control" placeholder="FOOD / DRINKS INGREDIENTS "> --}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group" style="display: none">
                                <label>FOOD / DRINKS AVAILABILITY<span class="asterisk">*</span></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <input type="text" placeholder="FROM" class="form-control pull-right datepicker" id="validity_operation_from" name="validity_operation_from" readonly="readonly" value="{{date('Y-m-d')}}">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <div class="input-group date">
                                                <input type="text" placeholder="TO" class="form-control pull-right datepicker" id="validity_operation_to" name="validity_operation_to" readonly="readonly" value="{{date('Y-m-d')}}">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-10" style="display: none">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="food_description">FOOD / DRINKS DESCRIPTION</label>
                                <textarea class="form-control" id="food_description" name="food_description"></textarea>
                            </div>

                        </div>
                    </div>



                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <label>FOOD / DRINKS IMAGES</label>
                        <div class="input-group control-group increment" id="increment">
                            <input type="file" name="upload_ativity_images[]" class="form-control upload_ativity_images">
                            {{-- {!! Form::file('upload_ativity_images', ['class' => 'control upload_ativity_images']) !!} --}}
                            <div class="input-group-btn">
                                <button class="btn btn-primary add_more_food_image" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="clone hide" style="display:none" id="clone">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="upload_ativity_images[]" class="form-control upload_ativity_images">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger remove_more_food_image" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                    </div>
                    <div id="previewImg" class="row">
                        @if (isset($foods))
                        @php

                        $foods=unserialize($foods->food_images);
                        for($images=0;$images< count($foods);$images++) { @endphp <div class='col-md-3 already_images' id="already_images{{($images+1)}}">
                                                <span class="pull-right remove_already_images" title="Delete Image" id="remove_already_images{{($images+1)}}" style="cursor:pointer"> X </span>
                                                <input type="hidden" name="upload_ativity_already_images[]" value="{{$foods[$images]}}">
                                                <img class='upload_ativity_images_preview' src='{{ asset("assets/uploads/food_images") }}/{{$foods[$images]}}' width=150 height=150 class="img img-thumbnail" />

                    </div>
                    @php
                    }

                    @endphp
                        @endif



            </div>
        </div>
    </div>
</div>
