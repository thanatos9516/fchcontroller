<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['ventas']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Sales <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Add</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Options</th>
      <th>Date</th>
      <th>Customer</th>
      <th>User</th>
      <th>Document</th>
      <th>Number</th>
      <th>Total Sale</th>
      <th>Status</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Options</th>
      <th>Date</th>
      <th>Customer</th>
      <th>User</th>
      <th>Document</th>
      <th>Number</th>
      <th>Total Sale</th>
      <th>Status</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-8 col-md-8 col-xs-12">
      <label for="">Customer(*):</label>
      <input class="form-control" type="hidden" name="idventa" id="idventa">
      <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required>
        
      </select>
    </div>
      <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Date(*): </label>
      <input class="form-control" type="date" name="fecha_hora" id="fecha_hora" required>
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Type Voucher(*): </label>
     <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required>
       <option value="Boleta">Voucher</option>
       <option value="Factura">Invoice</option>
       <option value="Ticket">Ticket</option>
     </select>
    </div>
     <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Series: </label>
      <input class="form-control" type="text" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
    </div>
     <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Number: </label>
      <input class="form-control" type="text" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required>
    </div>
    <div class="form-group col-lg-2 col-md-2 col-xs-6">
      <label for="">Tax: </label>
      <input class="form-control" type="text" name="impuesto" id="impuesto">
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <a data-toggle="modal" href="#myModal">
       <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Add Item</button>
     </a>
    </div>
<div class="form-group col-lg-12 col-md-12 col-xs-12">
     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th>options</th>
        <th>Item</th>
        <th>Stock</th>
        <th>Sale Price</th>
        <th>Discount</th>
        <th>Subtotal</th>
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total">$/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Save</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
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

  <!--Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Select an Item</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Option</th>
              <th>Name</th>
              <th>Category</th>
              <th>Code</th>
              <th>Stock</th>
              <th>Sales Price</th>
              <th>Image</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Option</th>
              <th>Name</th>
              <th>Category</th>
              <th>Code</th>
              <th>Stock</th>
              <th>Sales Price</th>
              <th>Image</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/venta.js"></script>
 <?php 
}

ob_end_flush();
  ?>

