<?php 
require_once "../modelos/Warehouse.php";

$warehouse=new Warehouse();

$idwarehouse=isset($_POST["idwarehouse"])? limpiarCadena($_POST["idwarehouse"]):"";
$namewarehouse=isset($_POST["namewarehouse"])? limpiarCadena($_POST["namewarehouse"]):"";
$numberwarehouse=isset($_POST["numberwarehouse"])? limpiarCadena($_POST["numberwarehouse"]):"";
$citywarehouse=isset($_POST["citywarehouse"])? limpiarCadena($_POST["citywarehouse"]):"";
switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idwarehouse)) {
		$rspta=$warehouse->insertar($namewarehouse,$numberwarehouse,$citywarehouse);
		echo $rspta ? "Data registered correctly" : "Could not register data";
	}else{
         $rspta=$warehouse->editar($idwarehouse,$namewarehouse,$numberwarehouse,$citywarehouse);
		echo $rspta ? "Data updated successfully" : "Could not update data";
	}
		break;
	

	case 'desactivar':
		$rspta=$warehouse->desactivar($idwarehouse);
		echo $rspta ? "Data deactivated correctly" : "Could not deactivate data";
		break;
	case 'activar':
		$rspta=$warehouse->activar($idwarehouse);
		echo $rspta ? "Data activated correctly" : "Could not activate data";
		break;
	
	case 'mostrar':
		$rspta=$warehouse->mostrar($idwarehouse);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$warehouse->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idwarehouse.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idwarehouse.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idwarehouse.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idwarehouse.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->namewarehouse,
            "2"=>$reg->numberwarehouse,
            "3"=>$reg->citywarehouse,
            "4"=>($reg->condicion)?'<span class="label bg-green">Activated</span>':'<span class="label bg-red">Disabled</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
}
 ?>