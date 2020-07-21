<?php
	
    ob_start();
    session_start();
    if (!isset($_SESSION['nombre'])) {
      header("Location: login.html");
    }else{
    require 'conn.php';

	$pid =intval(mysqli_real_escape_string($conn,$_POST['idProd']));
	$idCategory =intval(mysqli_real_escape_string($conn,$_POST['idCat']));
	$tableProd = "";
	
	$sql = "call deleteProduct($pid)";
	$sqlRead="SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
	INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
	INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse
   
	where a.idcategoria = $idCategory  ORDER BY a.nombre asc ";
	echo mysqli_error($conn);
	$result = mysqli_query($conn,$sql);
	
	if($result){

		$result=mysqli_query($conn,$sqlRead);

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
		
		echo json_encode(['error'=>false,'msg'=>'Pruduct was deleted successfully','products'=>$tableProd]);
	}
	else
	{
		if(mysqli_errno($conn) == 1451){
			echo json_encode(['error'=>true,'msg'=>'Product not removed, it could have photos. You must remove all photos!']);
		}
		else
		{
			echo json_encode(['error'=>true,'msg'=>'Product not deleted']);
		}
    }
    
}
?>
