

<div class="row">
    <div class="col-md-10 col-7 text-center">
        <h4 class="">BANK DETAILS </h4>
    </div>
    <div class="col-md-2 col-5">
        @isset($isSupplier)
              <button class="btn btn-sm btn-info float-right" onclick="supplierBankModal('{{route('supplierBankForm',['id' => encrypt($id),'type' => $type])}}', 'New Bank Detail')" data-toggle="modal" data-target="#supplierBankModal"><i class="fa fa-bank"></i>  Add Bank</button>
        @elseif($isAgent) 
        <button class="btn btn-sm btn-info float-right" onclick="supplierBankModal('{{route('banks.create')}}', 'New Bank Detail')" data-toggle="modal" data-target="#supplierBankModal"><i class="fa fa-bank"></i>  Add Bank</button> 
         
        @endisset
    </div>
    <hr>
</div>
<div class="row">
    @foreach ($bankDetails as $key => $bankData)
    <div class="col-md-4 col-12">
        <div class="card">
        <div class="card-header p-10">
            <div class="col-md-4">
                Bank {{ $key + 1 }}
            </div>
            <div class="col-md-4 text-right pr-0">
                <button class="btn btn-sm btn-primary deleteBank float-right" onclick="delColumn({{$bankData->id}})" id="{{$bankData->id}}"><i class="fa fa-trash"></i> Delete</button> 
            </div>
            <div class="col-md-3 text-left d-flex pl-0">
                <button class="btn btn-sm btn-info updateBank float-right" data-toggle="modal" onclick="updateBankDetails('{{route('banks.edit',$bankData->id)}}')" data-target="#supplierBankModal"><i class="fa fa-bank"></i> edit</button> 
            </div>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0 m-auto bl-4 border-secondary">
                <p class="" id="\bank_details">
                    <label>Acc No.:</label>
                    {{ $bankData->bank_account_number }}
                    <br>
                    <label>Name:</label> {{ $bankData->bank_name }}
                    <br>
                    <label>IFSC:</label> {{ $bankData->bank_ifsc }}
                    <br>
                    <label>IBAN:</label> {{ $bankData->bank_iban }}
                    <br>
                    <label>Currency:</label>
                    {{ $bankData->supplierCurreny->name }}
                </p>
                <footer class="blockquote-footer">Travel Door <cite title="Source Title"></cite></footer>
            </blockquote>
        </div>
        </div>
    <!-- /.card -->
    </div>
    
    @endforeach
</div>




<!-- Modal -->
<div class="modal fade" id="supplierBankModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Add New Bank  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="supplierBankModalBody">
                
            </div>
            
        </div>
    </div>
</div>


<script>
    function supplierBankModal(route, title = 'Supplier Bank Details'){
        $('.modal-title').text(title);
        $.ajax({
            type: "get",
            url: route,
            success: function (res) {
                $('#supplierBankModalBody').html(res.html);
            },
            error : function(err){
                alert(err.statusText);
            }
        });
    }

    function updateBankDetails(route) {
        $('.modal-title').text('Update Bank Details');
        $.ajax({
            type: "get",
            url: route,
            success: function (response) {
                if(response.status == 'ok') {
                    $('.modal-body').html(response.html);
                }
            }
        });
    }

     function delColumn(id){
            var token = $("meta[name='csrf-token']").attr("content");
            var text       = "Once deleted, you will not be able to recover this Bank Deatils!";
            var swalType   = 'warning';
            var ajaxType   = 'delete';
            var url        = "{!! url('banks' ) !!}" + "/" + id;
            var data       = {'_token': token,'id':id};
            ConfirmSwal(text,swalType,ajaxType,url,data);
        }
</script>