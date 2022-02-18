<div class="modal fade" id="world-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="worldLabel">{{ ucfirst($type) }}</h5>
          <button type="button" class="close world-dismiss" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="world-modal-html">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary world-dismiss" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary pull-right">Save</button>
          </div>
      </div>
    </div>
  </div>


@push('scripts')
 <script>
     $(document).on('click', '.world-dismiss', function(){
        $('#world-modal').modal('hide')
     })

     function renderWorld(route){
         loader('show');
        $.ajax({
            type : 'get',
            url : route,
            success : function(res){
                $('#world-modal-html').html(res);
                $('#world-modal').modal('show');
            },
            error : function(){
                alert('error');
            },
            complete : function(){
                loader('hide');
            }
        });
    }
 </script>
@endpush
