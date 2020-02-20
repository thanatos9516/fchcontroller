<script src="../../js/dropzone.js"></script>

<!-- Add Product -->
   <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New Product</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                    <form role="form" method="POST" action="addproduct.php" enctype="multipart/form-data">
						<div class="container-fluid">
						<div style="height:15px;"></div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Name:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="name" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Category:</span>
                            <select style="width:400px;" class="form-control" name="category">
								<?php
									$cat=mysqli_query($conn,"select * from category");
									while($catrow=mysqli_fetch_array($cat)){
										?>
											<option value="<?php echo $catrow['categoryid']; ?>"><?php echo $catrow['category_name']; ?></option>
										<?php
									}
								?>
							</select>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Supplier:</span>
                            <select style="width:400px;" class="form-control" name="supplier">
								<?php
									$sup=mysqli_query($conn,"select * from supplier");
									while($suprow=mysqli_fetch_array($sup)){
										?>
											<option value="<?php echo $suprow['userid']; ?>"><?php echo $suprow['company_name']; ?></option>
										<?php
									}
								?>
							</select>
                        </div>
                        <div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Price:</span>
                            <input type="text" style="width:400px;" class="form-control" name="price" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Quantity:</span>
                            <input type="text" style="width:400px;" class="form-control" name="qty">
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Main Photo:</span>
                            <input type="file" style="width:400px;" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                        <label for="exampleTextarea">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleTextarea">Tech Specs</label>
                        <textarea class="form-control" id="tech" name="tech" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleTextarea">Video</label>
                        <textarea class="form-control" id="video" name="video" rows="10"></textarea>
                        </div>
						</div>
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</form>
                </div>
			</div>
		</div>
</div>

<!--Modal para agregar las fotos-->
<div class="modal fade" id="addphoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add Photo Product</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                    <form role="form" method="POST" action="addphoto.php" enctype="multipart/form-data">
						<div class="container-fluid">
						<div style="height:15px;"></div>
						
						
						<div id="actions" class="row">

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
      </div>

      <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
          </div>
        </span>
      </div>

    </div>
    
<div class="table table-striped files" id="previews">

  <div id="template" class="file-row">
    <!-- This is used as the file preview template -->
    <div>
        <span class="preview"><img data-dz-thumbnail /></span>
    </div>
    <div>
        <p class="name" data-dz-name></p>
        <strong class="error text-danger" data-dz-errormessage></strong>
    </div>
    <div>
        <p class="size" data-dz-size></p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
    </div>
    <div>
      <button class="btn btn-primary start">
          <i class="glyphicon glyphicon-upload"></i>
          <span>Start</span>
      </button>
      <button data-dz-remove class="btn btn-warning cancel">
          <i class="glyphicon glyphicon-ban-circle"></i>
          <span>Cancel</span>
      </button>
      <button data-dz-remove class="btn btn-danger delete">
        <i class="glyphicon glyphicon-trash"></i>
        <span>Delete</span>
      </button>
    </div>
  </div>

</div>
                        
                   
						</div>
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</form>
                </div>
			</div>
		</div>
</div>
<!-- /.modal -->

<!-- Add Customer -->
    <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New Customer</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                    <form role="form" method="POST" action="addcustomer.php" enctype="multipart/form-data">
						<div class="container-fluid">
						<div style="height:15px;"></div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Name:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="name" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Address:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="address">
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Contact Info:</span>
                            <input type="text" style="width:400px;" class="form-control" name="contact">
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Username:</span>
                            <input type="text" style="width:400px;" class="form-control" name="username" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Password:</span>
                            <input type="password" style="width:400px;" class="form-control" name="password" required>
                        </div>  						
						</div>
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</form>
                </div>
			</div>
		</div>
    </div>
<!-- /.modal -->

<!-- Add Supplier -->
<div class="modal fade" id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New Supplier</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                    <form role="form" method="POST" action="addsupplier.php" enctype="multipart/form-data">
						<div class="container-fluid">
						<div style="height:15px;"></div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Company:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="name" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Address:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="address">
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Contact Info:</span>
                            <input type="text" style="width:400px;" class="form-control" name="contact">
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Username:</span>
                            <input type="text" style="width:400px;" class="form-control" name="username" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Password:</span>
                            <input type="password" style="width:400px;" class="form-control" name="password" required>
                        </div>  						
						</div>
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</form>
                </div>
			</div>
		</div>
    </div>
<!-- /.modal -->

<!-- Add Category -->
    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add New Category</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                    <form role="form" method="POST" action="addcategory.php" enctype="multipart/form-data">
						<div class="container-fluid">
						<div style="height:15px;"></div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">ID:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="id" required>
                        </div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Name:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="name">
                        </div> 						
						</div>
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</form>
                </div>
			</div>
		</div>
    </div>
<!-- /.modal -->