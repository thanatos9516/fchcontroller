<?php
	if (empty($_POST['name'])){
		$errors[] = "Ingresa el nombre del producto.";
	} elseif (!empty($_POST['name'])){
	require_once ("conn.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    $name2 = mysqli_real_escape_string($conn,(strip_tags($_POST["name"],ENT_QUOTES)));
	$name = utf8_decode($name2);
	$category = mysqli_real_escape_string($conn,(strip_tags($_POST["category"],ENT_QUOTES)));
	$warehouse = mysqli_real_escape_string($conn,(strip_tags($_POST["warehouse"],ENT_QUOTES)));
	$code = floatval($_POST["code"]);
	$profit = floatval($_POST["profit"]);
	$cost_price = floatval($_POST["cost_price"]);
	$others = floatval($_POST["others"]);
	$sale_price = floatval($_POST["sale_price"]);
    $description2 = mysqli_real_escape_string($conn,(strip_tags($_POST["description"],ENT_QUOTES)));
	$description = utf8_decode($description2);
	$stock = intval($_POST["stock"]);
	$fileInfo = PATHINFO($_FILES["image"]["name"]);
	if (empty($_FILES["image"]["name"])){
		$location="";
	} 
	else{
		if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
			$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
			move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $newFilename);
			$location = "img/" . $newFilename;
		}
		else{
			$location="";
			?>
				<script>
					window.alert('Photo not added. Please upload JPG or PNG photo only!');
				</script>
			<?php
		}
	}
 
	// REGISTER data into database
    $sql = "call addproduct('$name','$category','$warehouse','$code','$profit','$cost_price','$others','$sale_price','$description','$stock', '$location')";
    $query = mysqli_query($conn,$sql); 
     // if product has been added successfully
	 if ($query) {
		    
/* 		$sqlIdPdf = "SELECT idarticulo FROM articulo WHERE nombre = '$name'";
		$result = mysqli_query($conn,$sqlIdPdf);
		$result = mysqli_fetch_array($result);
		$result = $result['idarticulo']; */
			
// 			mysqli_query($conn,"call GuardarImagen('$result','$locationImg')"); 
		echo json_encode(['error'=>false,'msg'=>'El producto ha sido guardado con éxito.','products'=>getAllProducts($category,$conn)]);
	} 
	else {
		$errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
		echo json_encode(['error'=>true,'msg'=>'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.']);
	}
}	
else 
{
	// echo json_encode(['error'=>true,'msg'=>'Unknow']);
}

function getAllProducts($idCategory,$conn){
	$tableProd="";
	$sqlRead="SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
	INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
	INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse
   
	where a.idcategoria = $idCategory  ORDER BY a.nombre asc ";

	$result=mysqli_query($conn,$sqlRead);
	if($result){
		while($row = mysqli_fetch_array($result)){
			$pid = $row['idarticulo'];
			$tableProd .="<tr>
			<td><button onclick='getProductEdit($pid)' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editprod'><i class='fa fa-edit'></i> </button>
			<button onclick='getPhoto($pid)' class='btn btn-info btn-xs' data-toggle='modal' data-target='#addphoto'><i class='fa fa-photo'></i></button>
			<button onclick='getProductDelete($pid,$idCategory)' class='btn btn-danger btn-xs' data-toggle='modal' ><i class='fa fa-trash'></i></button></td> 
			<td>". $row['idarticulo']."</td>
			<td>". $row['nombre']. "</td>
			<td>". $row['profit']."</td>
			<td>". $row['precio_costo']."</td>
			<td>". $row['others']."</td>
			<td>". $row['precio_venta']."</td>
			<td>". $row['categoria']."</td>
			<td>". $row['warehouse']."</td>
			<td>". $row['codigo']."</td>
			<td>". $row['stock']."</td>
			<td>". $row['imagen']."</td>
			<td>". $row['descripcion']."</td>
			<td>". $row['condicion'].  "</td>";
			$tableProd .="</tr>";
		}
	}
		// echo json_encode(['error'=>false,'msg'=>'Pruduct was deleted successfully','products'=>$tableProd]);
	return $tableProd;
}
?>