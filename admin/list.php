<?php include("header.php");?>
<?php include("sidebar.php");?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
			
			

            <div class="row"> 
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table design <small>Custom design</small></h2>
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
                            <th class="column-title">Invoice </th>
                            <th class="column-title">Invoice Date </th>
                            <th class="column-title">Order </th>
                            <th class="column-title">Bill to Name </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Amount </th>
                            <th class="column-title no-link last" colspan="3"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 23, 2014 11:47:56 PM </td>
                            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#viewPopup"><i class="fa fa-folder"></i> view </button>
                            <td class=" last"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editPopup"><i class="fa fa-pencil"></i>edit</button>
                            <td class=" last"><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 23, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a> 
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000038</td>
                            <td class=" ">May 24, 2014 10:55:33 PM</td>
                            <td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$432.26</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000037</td>
                            <td class=" ">May 24, 2014 10:52:44 PM</td>
                            <td class=" ">121000204</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$333.21</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 24, 2014 11:47:56 PM </td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 26, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="error fa fa-long-arrow-down"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000038</td>
                            <td class=" ">May 26, 2014 10:55:33 PM</td>
                            <td class=" ">121000203</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$432.26</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000037</td>
                            <td class=" ">May 26, 2014 10:52:44 PM</td>
                            <td class=" ">121000204</td>
                            <td class=" ">Mike Smith</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$333.21</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>

                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 27, 2014 11:47:56 PM </td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$7.45</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
                          <tr class="odd pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 28, 2014 11:30:12 PM</td>
                            <td class=" ">121000208</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="a-right a-right ">$741.20</td>
                            <td class=" last"><a href="#">View</a>
                            <td class=" last"><a href="#">Edit</a>
                            <td class=" last"><a href="#">Delete</a>
                            </td>
                          </tr>
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
<!-- Add popup -->
  <div class="modal fade" id="addPopup" role="dialog">
    <div class="modal-dialog"> 
      <!-- Modal content-->
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h2>Form Basic Elements <small>different form elements</small></h2>
        </div> 
          <div class="x_content"> 
			<form class="form-horizontal form-label-left">

			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" placeholder="Default Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Disabled Input </label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Read-Only Input</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <textarea class="form-control" rows="3" placeholder='rows="3"'></textarea>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="password" class="form-control" value="passwordonetwo">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">AutoComplete</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" name="country" id="autocomplete-custom-append" class="form-control col-md-10"/>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control">
					<option>Choose option</option>
					<option>Option one</option>
					<option>Option two</option>
					<option>Option three</option>
					<option>Option four</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Custom</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_single form-control" tabindex="-1">
					<option></option>
					<option value="AK">Alaska</option>
					<option value="HI">Hawaii</option>
					<option value="CA">California</option>
					<option value="NV">Nevada</option>
					<option value="OR">Oregon</option>
					<option value="WA">Washington</option>
					<option value="AZ">Arizona</option>
					<option value="CO">Colorado</option>
					<option value="ID">Idaho</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NM">New Mexico</option>
					<option value="ND">North Dakota</option>
					<option value="UT">Utah</option>
					<option value="WY">Wyoming</option>
					<option value="AR">Arkansas</option>
					<option value="IL">Illinois</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="OK">Oklahoma</option>
					<option value="SD">South Dakota</option>
					<option value="TX">Texas</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Grouped</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_group form-control">
					<optgroup label="Alaskan/Hawaiian Time Zone">
					  <option value="AK">Alaska</option>
					  <option value="HI">Hawaii</option>
					</optgroup>
					<optgroup label="Pacific Time Zone">
					  <option value="CA">California</option>
					  <option value="NV">Nevada</option>
					  <option value="OR">Oregon</option>
					  <option value="WA">Washington</option>
					</optgroup>
					<optgroup label="Mountain Time Zone">
					  <option value="AZ">Arizona</option>
					  <option value="CO">Colorado</option>
					  <option value="ID">Idaho</option>
					  <option value="MT">Montana</option>
					  <option value="NE">Nebraska</option>
					  <option value="NM">New Mexico</option>
					  <option value="ND">North Dakota</option>
					  <option value="UT">Utah</option>
					  <option value="WY">Wyoming</option>
					</optgroup>
					<optgroup label="Central Time Zone">
					  <option value="AL">Alabama</option>
					  <option value="AR">Arkansas</option>
					  <option value="IL">Illinois</option>
					  <option value="IA">Iowa</option>
					  <option value="KS">Kansas</option>
					  <option value="KY">Kentucky</option>
					  <option value="LA">Louisiana</option>
					  <option value="MN">Minnesota</option>
					  <option value="MS">Mississippi</option>
					  <option value="MO">Missouri</option>
					  <option value="OK">Oklahoma</option>
					  <option value="SD">South Dakota</option>
					  <option value="TX">Texas</option>
					  <option value="TN">Tennessee</option>
					  <option value="WI">Wisconsin</option>
					</optgroup>
					<optgroup label="Eastern Time Zone">
					  <option value="CT">Connecticut</option>
					  <option value="DE">Delaware</option>
					  <option value="FL">Florida</option>
					  <option value="GA">Georgia</option>
					  <option value="IN">Indiana</option>
					  <option value="ME">Maine</option>
					  <option value="MD">Maryland</option>
					  <option value="MA">Massachusetts</option>
					  <option value="MI">Michigan</option>
					  <option value="NH">New Hampshire</option>
					  <option value="NJ">New Jersey</option>
					  <option value="NY">New York</option>
					  <option value="NC">North Carolina</option>
					  <option value="OH">Ohio</option>
					  <option value="PA">Pennsylvania</option>
					  <option value="RI">Rhode Island</option>
					  <option value="SC">South Carolina</option>
					  <option value="VT">Vermont</option>
					  <option value="VA">Virginia</option>
					  <option value="WV">West Virginia</option>
					</optgroup>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Multiple</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_multiple form-control" multiple="multiple">
					<option>Choose option</option>
					<option>Option one</option>
					<option>Option two</option>
					<option>Option three</option>
					<option>Option four</option>
					<option>Option five</option>
					<option>Option six</option>
				  </select>
				</div>
			  </div>

			  <div class="control-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Input Tags</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input id="tags_1" type="text" class="tags form-control" value="social, adverts, sales" />
				  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
				  <br>
				  <small class="text-navy">Normal Bootstrap elements</small>
				</label>

				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" value=""> Option one. select more than one options
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" value=""> Option two. select more than one options
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one. only select one option
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Option two. only select one option
					</label>
				  </div>
				</div>
			  </div>

			  <div class="form-group">
				<label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
				  <br>
				  <small class="text-navy">Normal Bootstrap elements</small>
				</label>

				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" checked="checked"> Checked
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat"> Unchecked
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" disabled="disabled"> Disabled
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Disabled & checked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" checked name="iCheck"> Checked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck"> Unchecked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck" disabled="disabled"> Disabled
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck3" disabled="disabled" checked> Disabled & Checked
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" checked /> Checked
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" /> Unchecked
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" disabled="disabled" /> Disabled
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" disabled="disabled" checked="checked" /> Disabled Checked
					</label>
				  </div>
				</div>
			  </div>


			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
				  <button type="button" class="btn btn-primary">Cancel</button>
				  <button type="reset" class="btn btn-primary">Reset</button>
				  <button type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>

			</form>
		  </div> 
        <div class="modal-footer"></div>
      </div> 
    </div>
  </div> 
<!-- Add Close Popup -->
<!-- Edit popup -->
  <div class="modal fade" id="editPopup" role="dialog">
    <div class="modal-dialog"> 
      <!-- Modal content-->
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h2>Form Basic Elements <small>different form elements</small></h2>
        </div> 
          <div class="x_content"> 
			<form class="form-horizontal form-label-left">

			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" placeholder="Default Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Disabled Input </label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Read-Only Input</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <textarea class="form-control" rows="3" placeholder='rows="3"'></textarea>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="password" class="form-control" value="passwordonetwo">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">AutoComplete</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" name="country" id="autocomplete-custom-append" class="form-control col-md-10"/>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control">
					<option>Choose option</option>
					<option>Option one</option>
					<option>Option two</option>
					<option>Option three</option>
					<option>Option four</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Custom</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_single form-control" tabindex="-1">
					<option></option>
					<option value="AK">Alaska</option>
					<option value="HI">Hawaii</option>
					<option value="CA">California</option>
					<option value="NV">Nevada</option>
					<option value="OR">Oregon</option>
					<option value="WA">Washington</option>
					<option value="AZ">Arizona</option>
					<option value="CO">Colorado</option>
					<option value="ID">Idaho</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NM">New Mexico</option>
					<option value="ND">North Dakota</option>
					<option value="UT">Utah</option>
					<option value="WY">Wyoming</option>
					<option value="AR">Arkansas</option>
					<option value="IL">Illinois</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="OK">Oklahoma</option>
					<option value="SD">South Dakota</option>
					<option value="TX">Texas</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Grouped</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_group form-control">
					<optgroup label="Alaskan/Hawaiian Time Zone">
					  <option value="AK">Alaska</option>
					  <option value="HI">Hawaii</option>
					</optgroup>
					<optgroup label="Pacific Time Zone">
					  <option value="CA">California</option>
					  <option value="NV">Nevada</option>
					  <option value="OR">Oregon</option>
					  <option value="WA">Washington</option>
					</optgroup>
					<optgroup label="Mountain Time Zone">
					  <option value="AZ">Arizona</option>
					  <option value="CO">Colorado</option>
					  <option value="ID">Idaho</option>
					  <option value="MT">Montana</option>
					  <option value="NE">Nebraska</option>
					  <option value="NM">New Mexico</option>
					  <option value="ND">North Dakota</option>
					  <option value="UT">Utah</option>
					  <option value="WY">Wyoming</option>
					</optgroup>
					<optgroup label="Central Time Zone">
					  <option value="AL">Alabama</option>
					  <option value="AR">Arkansas</option>
					  <option value="IL">Illinois</option>
					  <option value="IA">Iowa</option>
					  <option value="KS">Kansas</option>
					  <option value="KY">Kentucky</option>
					  <option value="LA">Louisiana</option>
					  <option value="MN">Minnesota</option>
					  <option value="MS">Mississippi</option>
					  <option value="MO">Missouri</option>
					  <option value="OK">Oklahoma</option>
					  <option value="SD">South Dakota</option>
					  <option value="TX">Texas</option>
					  <option value="TN">Tennessee</option>
					  <option value="WI">Wisconsin</option>
					</optgroup>
					<optgroup label="Eastern Time Zone">
					  <option value="CT">Connecticut</option>
					  <option value="DE">Delaware</option>
					  <option value="FL">Florida</option>
					  <option value="GA">Georgia</option>
					  <option value="IN">Indiana</option>
					  <option value="ME">Maine</option>
					  <option value="MD">Maryland</option>
					  <option value="MA">Massachusetts</option>
					  <option value="MI">Michigan</option>
					  <option value="NH">New Hampshire</option>
					  <option value="NJ">New Jersey</option>
					  <option value="NY">New York</option>
					  <option value="NC">North Carolina</option>
					  <option value="OH">Ohio</option>
					  <option value="PA">Pennsylvania</option>
					  <option value="RI">Rhode Island</option>
					  <option value="SC">South Carolina</option>
					  <option value="VT">Vermont</option>
					  <option value="VA">Virginia</option>
					  <option value="WV">West Virginia</option>
					</optgroup>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Select Multiple</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="select2_multiple form-control" multiple="multiple">
					<option>Choose option</option>
					<option>Option one</option>
					<option>Option two</option>
					<option>Option three</option>
					<option>Option four</option>
					<option>Option five</option>
					<option>Option six</option>
				  </select>
				</div>
			  </div>

			  <div class="control-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Input Tags</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input id="tags_1" type="text" class="tags form-control" value="social, adverts, sales" />
				  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
				  <br>
				  <small class="text-navy">Normal Bootstrap elements</small>
				</label>

				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" value=""> Option one. select more than one options
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" value=""> Option two. select more than one options
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one. only select one option
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Option two. only select one option
					</label>
				  </div>
				</div>
			  </div>

			  <div class="form-group">
				<label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
				  <br>
				  <small class="text-navy">Normal Bootstrap elements</small>
				</label>

				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" checked="checked"> Checked
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat"> Unchecked
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" disabled="disabled"> Disabled
					</label>
				  </div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Disabled & checked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" checked name="iCheck"> Checked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck"> Unchecked
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck" disabled="disabled"> Disabled
					</label>
				  </div>
				  <div class="radio">
					<label>
					  <input type="radio" class="flat" name="iCheck3" disabled="disabled" checked> Disabled & Checked
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" checked /> Checked
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" /> Unchecked
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" disabled="disabled" /> Disabled
					</label>
				  </div>
				  <div class="">
					<label>
					  <input type="checkbox" class="js-switch" disabled="disabled" checked="checked" /> Disabled Checked
					</label>
				  </div>
				</div>
			  </div>


			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
				  <button type="button" class="btn btn-primary">Cancel</button>
				  <button type="reset" class="btn btn-primary">Reset</button>
				  <button type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>

			</form>
		  </div> 
        <div class="modal-footer"></div>
      </div> 
    </div>
  </div> 
<!-- Edit Close Popup -->
<!-- View Popup -->
<div class="modal fade" id="viewPopup" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="page-title">
              <div class="title_left">
                <h3>General Elements</h3>
              </div> 
            </div>
			</div>
			<div class="modal-body">
			   <div class="">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Collapsible / Accordion <small>Sessions</small></h2> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Collapsible Group Item #1</h4>
                        </a>
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Username</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Larry</td>
                                  <td>the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Collapsible Group Item #2</h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 2 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Collapsible Group Item #3</h4>
                        </a>
                        <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion --> 
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Collapsible / Accordion <small>Sessions</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Collapsible Group Items #1</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Username</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Otto</td>
                                  <td>@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Larry</td>
                                  <td>the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Collapsible Group Items #2</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 2 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Collapsible Group Items #3</h4>
                        </a>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
              </div>
			  
              <div class="clearfix"></div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Vertical Tabs <small>Float left</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a>
                        </li>
                        <li><a href="#profile" data-toggle="tab">Profile</a>
                        </li>
                        <li><a href="#messages" data-toggle="tab">Messages</a>
                        </li>
                        <li><a href="#settings" data-toggle="tab">Settings</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                          <p class="lead">Home tab</p>
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                            synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                        <div class="tab-pane" id="profile">Profile Tab.</div>
                        <div class="tab-pane" id="messages">Messages Tab.</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Tabs <small>Float left</small></h2> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                            synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="clearfix"></div> 

            </div>
			</div>
			<div class="modal-footer"></div>
		  </div>
    </div>
</div>
<!-- View Close Popup -->
    </div>
  </div>
<?php include("footer.php");?>
<style> 

body .modal-content {  
        margin: 0px -300px 800px -300px;
}
</style>
         