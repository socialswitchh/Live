<style>
 input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
<?php include('config.php');?>
<!-- Add popup -->
  <div class="modal fade" id="addPopup" role="dialog">
    <div class="modal-dialog"> 
      <!-- Modal content-->
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h2>Add Anonymous </h2>
        </div> 
          <div class="x_content"> 
			<form class="form-horizontal form-label-left" id="upload_form" action="dynamic/custom_anonymous.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Anonymous Type</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_multiple form-control" id="anonymous_type">
					<option value="0">Type</option>
					<?php 
					$query = mysqli_query($conn,"SELECT * FROM gt_anonymous_type");
					while ($row=$query->fetch_assoc()) { ?>
						<option value="<?php echo $row['id']; ?>" ><?php echo $row['name'];?></option>
					<?php } ?> 
				  </select>
				</div>
			  </div>  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Anonymous Name </label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" id="anonymous_name" placeholder="Anonymous Name">
				</div>
			  </div> 
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3"> 
				  <button type="reset" class="btn btn-primary">Reset</button>
				  <button type="button" class="btn btn-success anonymous_add" >Add</button>
				</div>
			  </div> 
			</form>
		  </div> 
        <div class="modal-footer"></div>
      </div> 
    </div>
  </div> 
<!-- Add Close Popup --> 