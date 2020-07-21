<?php


	ob_start();
	session_start();
	if (!isset($_SESSION['nombre'])) {
	header("Location: login.html");
	}else{
	require 'conn.php';

	$route = $_SERVER['DOCUMENT_ROOT']."/mi_tienda/vistas/"; // modificado
	// $service = $_POST['id'];
	$id = $_POST['id'];
	$photo = $_POST['photo'];  
	$idProd = $_POST['idProd'];  
	$allPhotos = '';
	// $id=$_GET['service2'];
	mysqli_query($conn,"call deleteimg('$id')");

	
	if(unlink($route.$photo))
	{
		$sql = "select * from photo where idarticulo = $idProd"; 
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result)){
				$id = $row['idphoto'];
				$idProd = $row['idarticulo'];
				$photo = $row['imagen'];
				$allPhotos.= "<div class='col-md-3'> <img class='mb-2 mt-2'src='$photo' width='100%' height='200' /> 
							 	<a onclick='deletePhoto($id,\"$photo\",$idProd)' class='btn btn-danger text-white'><i class='fa fa-trash'></i></a></div>";
			}

			echo json_encode(['error'=>false,'allPhotos'=>$allPhotos]); 
		}
		else
		{	
			echo json_encode(['error'=>true,'msg'=>'<h4>Not Photos yet!</h4>']);
		}    
		
	}	
	else
	{
		echo json_encode(['error'=>true,'msg'=>'Please, try again','route'=>$route.$photo]);
	}
} 
	                          
?>
	