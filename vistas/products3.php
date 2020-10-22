<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{
require 'conn.php';
require 'header.php';
if ($_SESSION['almacen']==1) {
 ?>
 <!-- <link href="../css/alertify.css" rel="stylesheet"> -->

 <link href="../sweetalert/sweetalert2.css" rel="stylesheet">	


    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
<!--   <h1 class="box-title">Item <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Add</button> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info">Report</button></a></h1>
 --> 
 <div class="col-lg-12">
            <h1 class="page-header">Products by Warehouse
				<span class="pull-right">
					<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addproduct"><i class="fa fa-plus-circle"></i> Add Product</button>
				</span>
			</h1>
        </div>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Options</th>
      <th>ID</th>
      <th>Name</th>
      <th>Profit</th>
      <th>Cost Price</th>
      <th>Others</th>
      <th>Sale Price</th>
      <th>Category</th>
      <th>Warehouse</th>
      <th>Code</th>
      <th>Stock</th>
      <th>Image</th>
      <th>Description</th>
      <th>Condition</th>
    </thead>
    <tbody class="infoProduct">
    
                <?php
                    $pq=mysqli_query($conn,"SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
                    INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
                    INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse
                   
                    where a.idwarehouse = \"$_POST[id_txt]\"  ORDER BY a.nombre asc" );
                    while($row=mysqli_fetch_array($pq)){
                        $pid=$row['idarticulo'];
                    ?>
                        <tr>
                        <td>
                        <button onclick="getProductEdit(<?= $pid; ?>)" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editprod"><i class="fa fa-edit"></i></button>
                               <!--  <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editprod_<?php echo $pid; ?>"><i class="fa fa-edit"></i></button> -->
                                <!-- <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#addphoto_<?php echo $pid; ?>"><i class="fa fa-photo"></i> </button> -->
                                <button onclick="getPhoto(<?= $pid; ?>)" class="btn btn-info btn-xs" data-toggle="modal" data-target="#addphoto"><i class="fa fa-photo"></i></button>
                                <button onclick="getProductDelete(<?= $pid; ?>,<?=$_POST['id_txt']?>)" class="btn btn-danger btn-sm" data-toggle="modal" ><i class="fa fa-trash"></i> </button>
                                <!-- <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delproduct_<?php echo $pid; ?>"><i class="fa fa-trash"></i> </button> -->
                                
                        </td>
                            <td><?php echo $row['idarticulo'];?></td>
                            <td><?php echo $row['nombre'];?></td>
                            <td><?php echo $row['profit']; ?></td>
                            <td><?php echo $row['precio_costo']; ?></td>
                            <td><?php echo $row['others']; ?></td>
                            <td><?php echo $row['precio_venta']; ?></td>
                            <td><?php echo $row['categoria']; ?></td>
                            <td><?php echo $row['warehouse']; ?></td>
                            <td><?php echo $row['codigo']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
<!--                            <td><?php echo $row['descripcion']; ?></td>-->      
                            <td><img src="../<?php if(empty($row['imagen'])){echo "upload/noimage.jpg";}else{echo $pqrow['imagen'];} ?>" height="30px" width="30px;"></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['condicion']; ?></td>
                        </tr>
                    <?php
                    }
                ?>                
                </tbody>
    <tfoot>
      <th>Options</th>
      <th>ID</th>
      <th>Name</th>
      <th>Profit</th>
      <th>Cost Price</th>
      <th>Others</th>
      <th>Sale Price</th>
      <th>Category</th>
      <th>Warehouse</th>
      <th>Code</th>
      <th>Stock</th>
      <th>Image</th>
      <th>Description</th>
      <th>Condition</th>
    </tfoot>   
  </table>
            <!-- Modals  -->
  <?php include('product_button.php'); ?>
 

</div>


<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>

<?php include('add_modal.php'); ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="../js/product2.js"></script>
 <!-- <script src="../js/alertify.js"></script>
 <script src="../js/sweetalert.min.js"></script> -->
 <script src="../sweetalert/sweetalert2.min.js"></script>





 <?php 
}

ob_end_flush();
  ?>

 