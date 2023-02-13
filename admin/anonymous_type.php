<?php include("header.php");?>
<?php include("sidebar.php");?>
<?php include("config.php");?>  
        

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Anonymous Type Management</h3>
              </div> 
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <!--<div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>-->
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row"> 
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Customers Record Listing for Tours <small>Total Record - 54</small></h2>-->
                    <ul class="nav navbar-right panel_toolbox">
                       
                      <div align="right"> 
							<button type="button" class="btn-success btn-xs" data-toggle="modal" data-target="#addPopup"><i class="fa fa-plus"></i>Add</button>
					  </div>
                       
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Sl.No </th>
                            <th class="column-title">Anonymous Type </th> 
                            <th class="column-title no-link last" colspan="3"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
						<?php 
							$i = 1;
							$query = mysqli_query($conn,"SELECT * FROM gt_anonymous_type");
							while ($row=$query->fetch_assoc()) { ?>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?php echo $i;?></td>
                            <td class=" "><?php echo $row['name'];?></td>  
                            <td class=" last"><button type="button" class="btn btn-info btn-xs get_data" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-target="#editPopup"><i class="fa fa-pencil"></i>edit</button>
                            <!--<td class=" last"><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>-->
                            </td>
                          </tr> 
							<?php $i++; } ?>
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
              </div> 
			  
            </div>
          </div>
        </div>
        <!-- /page content --> 

<!-- START POPUP SECTION -->
<?php include('popup_elements/anonymous_type_add_popup.php');?>
<?php include('popup_elements/anonymous_type_edit_popup.php');?>
<?php //include('popup_elements/tours_view_popup.php');?>  
<!-- END POPUP SECTION -->
    </div>
  </div>
<?php include("footer.php");?>
 
         