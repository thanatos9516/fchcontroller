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
  <h1 class="box-title">Warehouse <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Add</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Option</th>
      <th>Name</th>
      <th>Number Warehouse</th>
      <th>City Warehouse</th>
      <th>Status</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Option</th>
      <th>Name</th>
      <th>Number Warehouse</th>
      <th>City Warehouse</th>
      <th>Status</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Name</label>
      <input class="form-control" type="hidden" name="idwarehouse" id="idwarehouse">
      <input class="form-control" type="text" name="namewarehouse" id="namewarehouse" maxlength="50" placeholder="Nombre" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Number Warehouse</label>
      <input class="form-control" type="text" name="numberwarehouse" id="numberwarehouse" maxlength="256" placeholder="Number Warehouse">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">City Warehouse</label>
      <input class="form-control" type="text" name="citywarehouse" id="citywarehouse" maxlength="256" placeholder="City Warehouse">
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

require 'footer.php';
 ?>
 <script src="scripts/warehouse.js"></script>
 <?php 
}

ob_end_flush();
  ?>

