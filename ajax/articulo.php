<?php 
require_once "../modelos/Articulo.php";
//include '../vistas/modal.php';

$articulo=new Articulo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$profit=isset($_POST["profit"])? limpiarCadena($_POST["profit"]):"";
$precio_costo=isset($_POST["precio_costo"])? limpiarCadena($_POST["precio_costo"]):"";
$precio_venta=isset($_POST["precio_venta"])? limpiarCadena($_POST["precio_venta"]):"";
$idwarehouse=isset($_POST["idwarehouse"])? limpiarCadena($_POST["idwarehouse"]):"";
$others=isset($_POST["others"])? limpiarCadena($_POST["others"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/".$imagen);
		}
	}
	if (empty($idarticulo)) {
	$rspta=$articulo->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen, $precio_costo,$profit,$precio_venta,$idwarehouse,$others);
		echo $rspta ? "Data registered correctly" : "Could not register data";
	}else{

		//$precio_venta += ((int)$precio_costo['precio_costo'] * (int)$profit['profit']); $precio_costo * $profit;
        $rspta=$articulo->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$profit,$precio_costo,$precio_venta,$idwarehouse,$others);
		echo $rspta ? "Data updated successfully" : "Could not update data";
	}
		break;
	

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
		echo $rspta ? "Data desactivated correctly" : "Could not activate data";
		break;
	case 'activar':
		$rspta=$articulo->activar($idarticulo);
		echo $rspta ? "Data activated correctly" : "Could not activate data";
		break;
	
	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
		echo json_encode($rspta);
		break;

	case 'show_photo':
		$rspta=$articulo->show_photo($idarticulo);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$articulo->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>($reg->condicion)?
			'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.' '.'
			<button class="btn btn-info btn-xs" onclick="show_photo('.$reg->idarticulo.')"><i class="fa fa-photo"></i></button>'.' '.'
			<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.' '.'
			<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->profit,
			"3"=>$reg->precio_costo,
			"4"=>$reg->others,
			"5"=>$reg->precio_venta,  
			"6"=>$reg->categoria,
			"7"=>$reg->warehouse,
            "8"=>$reg->codigo,
            "9"=>$reg->stock,
            "10"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px'>",
            "11"=>$reg->descripcion,
            "12"=>($reg->condicion)?' <span class="label bg-green">Activated</span>':'<span class="label bg-red">isabled</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'selectCategoria':
			require_once "../modelos/Categoria.php";
			$categoria=new Categoria();

			$rspta=$categoria->select();

			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idcategoria.'>'.$reg->nombre.'</option>';
			}
			break;

		case 'selectWarehouse':
				require_once "../modelos/Warehouse.php";
				$warehouse=new Warehouse();
	
				$rspta=$warehouse->select();
	
				while ($reg=$rspta->fetch_object()) {
					echo '<option value=' . $reg->idwarehouse.'>'.$reg->namewarehouse.'</option>';
				}
				break;
}
 ?>

 