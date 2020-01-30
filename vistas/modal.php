<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


 <!-- add photo -->
 
 <div class="modal fade" id="addphoto_<?php echo $pid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Add Product</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					<?php
					//	$a=mysqli_query($conn,"select * from product left join category on category.categoryid=product.categoryid left join supplier on supplier.userid=product.supplierid where productid='$pid'");
					//	$b=mysqli_fetch_array($a);
					?>
				
                   
                            
                        <!--     <form onsubmit="return false" class="oculto" method="post" enctype="multipart/form-data" id="formUpload">
	                        <input type="file" name="image" onchange="upload_img();">
                            <input type="submit" value="Upload" class="submit" />

                            
                              <div style="height:10px;"></div>					
                                <div class="form-group input-group">
                                <span class="input-group-addon" style="width:120px;">Photo:</span> 
                                <input type="file" style="width:400px;" class="form-control" name="file" id="file" multiple="" accept="image/*" />
                                <input type="submit" value="Upload" class="submit" />
                                </div> -->
                             
                               
                         <div class="col-sm-10">
						
                                   

                                   
						<?php 
                                      
                                  // $sql = "select * from carousel as c where c.productid = '$pid'"; 
                                  //  $result = mysqli_query($conn, $sql);
                                
                                                               

       /*                                  if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                        $id = $row['idphoto'];
                                        $photo = $row['photo'];
                                       
                                              for($i=0; $i < count($photo); $i++){
                                
                                   
                
                                        
                                        echo "<img src='$photo' width=200px  />";
                                    
                                       echo " 
                                       
                                         <a class='btn btn-danger glyphicon glyphicon-remove' href='del_file.php/?service=$id&service2=$photo'>Borrar</a>
                                      
                                       ";                                    } 

                                    }
                                     
                                    } */
                                   
                                    
                                        
                                   ?>
                
    		   
                          
						
	
					</div>                     
				
            
    		  
                                
                            
                       <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="submit btn btn-success"><i class="fa fa-check-square-o"></i> Add Photo</button>
					</form>
                </div>
                        
				</div>
			
				</div>
                
        </div>
</div>
</div>
 
<script>
function upload_img(){

	var formData = new FormData($("#formUpload")[0]);
	$.ajax({
	type: 'POST',
	url: 'addphoto.php',
	data: formData,
	contentType: false,
	processData: false
	});

}
</script>