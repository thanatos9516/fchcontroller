
<?php include('conn.php'); ?>
<body>
<div id="wrapper">
<?php include('header.php'); ?>
<div style="height:50px;"></div>
<div id="page-wrapper">
<div class="container-fluid">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products
				<span class="pull-right">
					<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addproduct"><i class="fa fa-plus-circle"></i> Add Product</button>
				</span>
			</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="prodTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
<!--                        <th>Description</th>-->
<!--                        <th>Tech</th>-->
                        <th>Video</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $pq=mysqli_query($conn,"select * from articulo as p where p.idcategoria = \"$_POST[id_txt]\"");
                    while($row=mysqli_fetch_array($pq)){
                        $pid=$row['idarticulo'];
                    ?>
                        <tr>
                            <td><?php echo $row['nombre'];?></td>
                            <td><?php echo $row['precio_costo']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
<!--                            <td><?php echo $row['descripcion']; ?></td>-->
<!--              <td><?php echo $row['tech']; ?></td>-->
             
                            <td><img src="../<?php if(empty($row['photo'])){echo "upload/noimage.jpg";}else{echo $pqrow['photo'];} ?>" height="30px" width="30px;"></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editprod_<?php echo $pid; ?>"><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addphoto_<?php echo $pid; ?>"><i class="fa fa-edit"></i> Add Photo</button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delproduct_<?php echo $pid; ?>"><i class="fa fa-trash"></i> Delete</button>
                                <?php include('product_button.php'); ?>
                            </td>
                        </tr>
                    <?php
                    }
                ?>                
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<?php include('script.php'); ?>
<?php include('modal.php'); ?>
<?php include('add_modal.php'); ?>
</body>
