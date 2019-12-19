<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Articulo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$precio_costo,$profit,$precio_venta,$idwarehouse,$others){
	$porcentaje = ($precio_costo * $profit);
	$precio2 = $precio_costo+$others;
	$precio_venta = $precio2 + $porcentaje;
	$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion,precio_costo,profit,precio_venta,idwarehouse,others)
	 VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1','$precio_costo','$profit','$precio_venta','$idwarehouse','$others')";
	return ejecutarConsulta($sql);
}

public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$precio_costo,$profit,$precio_venta,$idwarehouse,$others){
	$porcentaje = ($precio_costo * $profit);
	$precio_venta = $precio_costo + $porcentaje;
	$sql="UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo', nombre='$nombre',stock='$stock',descripcion='$descripcion',imagen='$imagen', precio_costo='$precio_costo', profit='$profit', precio_venta='$precio_venta', other='$others' 
	WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function desactivar($idarticulo){
	$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function activar($idarticulo){
	$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idarticulo){
	$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
	return ejecutarConsultaSimpleFila($sql);
}

//List all photos
public function show_photo($idarticulo){
	$sql="select a.nombre,a.idarticulo,p.idphoto, p.route from articulo a, photo p where p.idarticulo='$idarticulo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
	INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
	INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos a unir con el ultimo registro de la tabla detalle_ingreso)

public function listarActivosVenta(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock, a.precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}    
    
/*public function listarActivosVenta(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
} */
}
 ?>
