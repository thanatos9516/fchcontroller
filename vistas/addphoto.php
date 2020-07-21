<?php
	
	ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{
require 'conn.php';

	$getPhoto = $_POST["getPhoto"];
	$idProd	= $_POST['idProd'];
	$allPhotos ="";
	
	if($getPhoto =="1")
	{
		$sql = "select * from photo where idarticulo = $idProd"; 
		$result = mysqli_query($conn, $sql);
		echo mysqli_error($conn);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$id = $row['idphoto'];
				$idProd = $row['idarticulo'];
				$photo = $row['imagen'];
				$allPhotos.= "<div class='col-md-3'> <img class='mb-2 mt-2'src='$photo' width='100%' height='200' />
					 <a onclick='deletePhoto($id,\"$photo\",$idProd)' class='btn btn-danger text-white'><i class='fa fa-trash'></i></a></div>";
					// href='del_file.php/?id=$id&photo=$photo'
			} /// ARREGLAR ESTE FRACMENTO YA QUE METE UN DIV DENTRO DEL MISMO DIV
			echo json_encode(['error'=>false,'allPhotos'=>$allPhotos]); 
		}
		else
		{
			echo json_encode(['error'=>true,'allPhotos'=>'<h4>Not Photos yet!</h4>']);
		} 
	}
	else
	{
		$fileInfo = PATHINFO($_FILES["archivo"]["name"]);
		//Validamos que el archivo exista
		if(empty($_FILES["archivo"]["name"]))
		{
			 echo json_encode(['error'=>true,'allPhotos'=>'File empty']);
		}
		else
		{
			$filename = $_FILES["archivo"]["name"]; //Obtenemos el nombre original del archivo
			$sourceTempo = $_FILES["archivo"]["tmp_name"]; //Obtenemos un nombre temporal del archivo
					
			$directory = $_SERVER['DOCUMENT_ROOT']."/mi_tienda/vistas/img/"; // Esta ruta estaria mal debeido a que no coincide con la del proyecto actual /// modificado
			//Declaramos un  variable con la ruta donde guardaremos los archivos
			$filename = $fileInfo['filename'] .".". $fileInfo['extension'];
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directory)){
				mkdir($directory, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
				move_uploaded_file($sourceTempo,$directory.$filename);
				echo json_encode(['error'=>false,'allPhotos'=>$allPhotos]); 
			}
			else
			{	
				$dir=opendir($directory); //Abrimos el directorio de destino
				// $filename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
				//Movemos y validamos que el archivo se haya cargado correctamente
				//El primer campo es el origen y el segundo el destino
				
				if(move_uploaded_file($sourceTempo,$directory.$filename)) 
				{	
					closedir($dir); //Cerramos el directorio de destino
				
					mysqli_query($conn,"call GuardarImagen('$idProd','img/$filename')"); 
					// $pid=mysqli_insert_id($conn);

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
				} 
				else 
				{	
					echo json_encode(['error'=>true, 'allPhotos'=>'Error al mover la foto']);
				}
			}
			
		}
		
	}
}
?>
