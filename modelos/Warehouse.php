<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Warehouse{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($namewarehouse,$numberwarehouse,$citywarehouse){
	$sql="INSERT INTO categoria (namewarehouse,numberwarehouse,citywarehouse,condicion) VALUES ('$namewarehouse','$numberwarehouse','$citywarehouse','1')";
	return ejecutarConsulta($sql);
}

public function editar($idwarehouse,$namewarehouse,$numberwarehouse,$citywarehouse){
	$sql="UPDATE warehouse SET namewarehouse='$namewarehouse',numberwarehouse='$numberwarehouse',citywarehouse='$citywarehouse' 
	WHERE idcategoria='$idwarehouse'";
	return ejecutarConsulta($sql);
}
public function desactivar($idwarehouse){
	$sql="UPDATE warehouse SET condicion='0' WHERE idwarehouse='$idwarehouse'";
	return ejecutarConsulta($sql);
}
public function activar($idwarehouse){
	$sql="UPDATE warehouse SET condicion='1' WHERE idwarehouse='$idwarehouse'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idcategoria){
	$sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM categoria";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM categoria WHERE condicion=1";
	return ejecutarConsulta($sql);
}
}

 ?>
