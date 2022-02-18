@push('style')
<style>
.card {
    position: relative;
    padding: 5px;
}
a.closer {
    position: absolute;
    right: 5px;
    background: black;
    top: 4px;
    border-radius: 32px;
    width: 20px;
    height: 20px;
    padding: 0px 4.2px;
    color: white;
}
a.closer:hover, a.closer:visited, a.closer:focus, a.closer:active{
    color: white;
}


</style>
@endpush
<div class="row my-4">
    <div class="col-sm-6">
        {!! Form::hidden('imageFor', $service ?? null, ['id' => 'imageFor']) !!}
        {!! Form::hidden('reference', $referenceId ?? null, ['id' => 'reference']) !!}
        {!! Form::file('image[]', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/*', 'onchange' => 'ImageUpload($(this))', 'multiple']) !!}
    </div>
    <div class="col-sm-12 my-4">
        <div class="row displayImages"></div>
    </div>
</div>


<script>
displayImages()
function ImageUpload(element){
    var formdata = new FormData($('form')[0]);
    if(image != null){
        loader()
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ' {{ route("service-image.post")}} ',
            type: 'post',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response){
                loader(1)
                if(response.status == 'error'){
                    toasterMessage(response.status,response.message);
                }
                displayImages()
            }
        })
    }
}

function displayImages(){
    var imageFor = $('#imageFor').val()
    var reference = $('#reference').val()
    if(imageFor != null && reference != null){
        $.ajax({
            url: '{{ route("service-image.get") }}',
            type:  'get',
            data: {
                imageFor: imageFor,
                reference: reference,
            },
            success: function(response){
                if(typeof response == 'object'){
                    $('.displayImages').html('')
                    $.each(response, function(key, value){
                        $('.displayImages').append(ImageComponent(value.id, value.image));
                    })
                }
            }
        })
    }
}

function DeleteImage(id){
    if(id != null){
        loader()
        $.ajax({
            url: '{{ route("service-image.delete") }}',
            type: 'get',
            data: {id: id},
            success: function(response){
                loader(1)
                toasterMessage(response.status, response.message);
                displayImages()
            }
        })
    }
}
function ImageComponent(id, imagePath){
    return `<div class="col-sm-3">
            <div class="card">
                <a href="javascript:void(0)" class="closer" onclick="DeleteImage(${id})"><i class="fa fa-close" aria-hidden="true"></i></a>
                <div class="card-img-wrapper">
                    <img class="card-img-top" src="${imagePath}" alt="Card image cap">
                </div>
            </div>
        </div>`;
}
</script>
