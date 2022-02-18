
<div class="row mb-10">
    <div class="col-md-10 col-7">
        <h4 class="">CONTACT PERSONS</h4>

    </div>
@if(isset($isAgent) || isset($isSupplier))
    <div class="col-md-2 col-5">
      <button class="btn btn-sm btn-info float-right" onclick="vendorContactsModal('{{ route('contacts.create', ['type' => $type, 'model_id' => $model->id]) }}')" ><i class="fa fa-plus"></i>  New Contact</button>
    </div>
    @endif
    <hr>
</div>
<div id="agent-contacts">
  <div class="box">
    <div class="box-body">
      @if ($contacts->count())
        <div class="row">
            @foreach ($contacts as $key => $contact)
            <div class="col-md-4 col-12">
              <div class="card">

                  <div class="card-body ">
                    <blockquote class="blockquote mb-0 m-auto">
                        <p class="">
                            <label class="font-weight-bold">Name: </label> {{ $contact->name }}
                            <br>
                            <label class="font-weight-bold">Number: </label> {{ $contact->phone }}
                            <br>
                            <label class="font-weight-bold">WhatsApp: </label> {{ $contact->whatsapp }}
                            <br>
                            <label class="font-weight-bold">Email : </label> {{ $contact->email }}
                            <br>

                        </p>
                      <footer class="blockquote-footer">Travel Door <cite title="Source Title">( {{ $model->company_name }} )</cite></footer>
                      <small>
                        {{ $contact->created_at->toDayDateTimeString() }}
                      </small>


                    </blockquote>
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-sm" onclick="vendorContactsModal('{{ route('contacts.edit', [$contact->id, 'type' => $type, 'model_id' => $model->id]) }}')"><i class="fa fa-edit"></i> Edit </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="delColumn('contacts','{{ $contact->id }}')" ><i class="fa fa-trash" ></i> Delete </button>
                  </div>
                </div>
              </div>

            <!-- /.card -->

            @endforeach
        </div>
      @else
          <div class="">
            <p class="lead">Contacts not Availble!</p>
          </div>
      @endif
    </div>
  </div>
</div>



<div class="modal fade" id="vendorContactsModal" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Contacts</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="vendorContactsModalHtml">

            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const vendor_contacts_modal = $('#vendorContactsModal');
        const vendor_contacts_modal_html = $('#vendorContactsModalHtml');

        function vendorContactsModal(route, title = 'Contact Details') {
            vendor_contacts_modal.find('.modal-title').text(title);
            loader();
            $.ajax({
                type: 'get',
                url: route,
                success: function(res) {
                    vendor_contacts_modal_html.html(res.html);
                    vendor_contacts_modal.modal('show');
                    loader('hide');
                },
                error: function(err) {
                    alert(err.statusText);
                }
            })
        }
    </script>
    <script>
     function delColumn(route, id){
       
            var token = $("meta[name='csrf-token']").attr("content");
            var text       = "Once deleted, you will not be able to recover this contact person detail!";
            var swalType   = 'warning';
            var ajaxType   = 'delete';
            var url        = "{!! url('"+route+"' ) !!}" + "/" + id;
            var data       = {'_token': token,'id':id};
            ConfirmSwal(text,swalType,ajaxType,url,data);
        }
</script>
@endpush
