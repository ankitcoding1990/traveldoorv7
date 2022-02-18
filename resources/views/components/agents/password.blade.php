<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="result-popup" aria-hidden="true" id="agentPasswordModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="result-popup">CHANGE PASSWORD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            	<form id="agentsPasswordForm">
            		{{csrf_field()}}
            		<input type="hidden" name="agent_id">
            		<div class="row mb-10">

            			<div class="col-sm-12 col-md-12 col-lg-12">

            				<div class="form-group">

            					<label>PASSWORD<span class="asterisk">*</span></label>

            					<input type="password" class="form-control" placeholder="PASSWORD"

            					name="agent_new_password" id="agent_new_password">

            				</div>

            			</div>


            		</div>

            		<div class="row mb-10">

            			<div class="col-sm-12 col-md-12 col-lg-12">

            				<div class="form-group">

            					<label>CONFIRM PASSWORD<span class="asterisk">*</span></label>

            					<input type="password" class="form-control" placeholder="CONFIRM PASSWORD"

            					name="agent_confirm_password" id="agent_confirm_password">

            				</div>

            			</div>

            		</div>
            		<div class="row mb-10">

            			<div class="col-sm-12 col-md-12 col-lg-12">
            				 <button type="button" id="change_password_btn" class="btn btn-rounded btn-primary mr-10">Change Password</button>
            			</div>

            	</form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('scripts')
  <script type="text/javascript">
    function agentPassword(agentId){
      $("#agentPasswordModal").modal("show");
    }
    
  </script>
@endpush
