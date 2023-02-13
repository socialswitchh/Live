<!-- Edit popup -->
	<div class="modal fade" id="editPopup" role="dialog">
		<div class="modal-dialog"> 
		  <!-- Modal content-->
		   <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h2>Add Anonymous Type </h2>
			</div> 
			  <div class="x_content"> 
				<form class="form-horizontal form-label-left" id="upload_form" action="dynamic/custom_anonymous.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Anonymous Type</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" class="form-control id" id="id">
							<input type="text" class="form-control name" id="name" placeholder="Anonymous Type">
						</div>
					</div> 
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3"> 
						  <button type="reset" class="btn btn-primary">Reset</button>
						  <button type="button" class="btn btn-success anonymous_type_edit" >Submit</button>
						</div>
					</div> 
				</form>
			  </div> 
			<div class="modal-footer"></div>
		  </div> 
		</div>
	</div>
<!-- Edit Close Popup -->