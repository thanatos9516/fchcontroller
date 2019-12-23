<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['almacen']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Item <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Add</button> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info">Report</button></a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Options</th>
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
    <tbody>
    </tbody>
    <tfoot>
       <th>Options</th>
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
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Name(*):</label>
      <input class="form-control" type="hidden" name="idarticulo" id="idarticulo">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Cost Price(*):</label>
      <input class="form-control" type="hidden" name="precio_costo" id="precio_costo">
      <input class="form-control" type="text" name="precio_costo" id="precio_costo" maxlength="100" placeholder="Cost Price" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Profit(*): Example(0.20)</label>
      <input class="form-control" type="hidden" name="profit" id="profit">
      <input class="form-control" type="text" name="profit" id="profit" maxlength="100" placeholder="Profit" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Others(*): </label>
      <input class="form-control" type="hidden" name="others" id="others">
      <input class="form-control" type="text" name="others" id="others" maxlength="100" placeholder="Others" required>
    </div>
    <!-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Sale Price(*):</label>
      <input class="form-control" type="hidden" name="precio_venta" id="precio_venta">
      <input class="form-control" type="text" name="precio_venta" id="precio_venta" maxlength="100" placeholder="Sale Price" required>
    </div> -->
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Category(*):</label>
      <select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Warehouse(*):</label>
      <select name="idwarehouse" id="idwarehouse" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Stock</label>
      <input class="form-control" type="number" name="stock" id="stock"  required>
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Description</label>
      <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripcion">
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Image:</label>
      <input class="form-control" type="file" name="imagen" id="imagen">
      <input type="hidden" name="imagenactual" id="imagenactual">
      <img src="" alt="" width="150px" height="120" id="imagenmuestra">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Code:</label>
      <input class="form-control" type="text" name="codigo" id="codigo" placeholder="codigo del prodcuto" required>
      <button class="btn btn-success" type="button" onclick="generarbarcode()">Generate</button>
      <button class="btn btn-info" type="button" onclick="imprimir()">Print</button>
      <div id="print">
        <svg id="barcode"></svg>
      </div>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Save</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
    </div>
  </form>
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
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/articulo.js"></script>

 <?php 
}

ob_end_flush();
  ?>

 