<?php
	require_once ("conn.php");

	if (empty($_POST['edit_id'])){
		echo json_encode(['error'=>true,'msg'=>"The id field is empty! ",'field'=>$_POST['edit_id']]);
	} 
	elseif (!empty($_POST['edit_id']))
	{
		$pid = intval($_POST['edit_id']);
		
		if($_POST['query'] == '1')
		{
			$result=mysqli_query($conn,"SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
			INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
			INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse
		   
			where a.idarticulo = $pid  ORDER BY a.nombre asc");
			$row=mysqli_fetch_array($result);

			echo json_encode(['error'=>false, 
			"edit_name"=>"$row[nombre]",
			"category"=>category($conn,$row['idcategoria'],$row['categoria']),
			'warehouse'=>warehouse($conn,$row['idwarehouse'],$row['warehouse']),
			'edit_code'=>$row['codigo'],
			'edit_profit'=>$row['profit'],
			'edit_cost_price'=>$row['precio_venta'],
			'edit_others'=>$row['others'],
			'edit_sale_price'=>$row['precio_venta'],
			'edit_stock'=>$row['stock'],
			'edit_description'=>$row['descripcion']]);
		}
		else 
		{
				
			$id=mysqli_real_escape_string($conn,(strip_tags($_POST["edit_id"],ENT_QUOTES)));      
			$name = mysqli_real_escape_string($conn,(strip_tags($_POST["edit_name"],ENT_QUOTES)));
			$category = mysqli_real_escape_string($conn,(strip_tags($_POST["edit_category"],ENT_QUOTES)));
			$warehouse = mysqli_real_escape_string($conn,(strip_tags($_POST["edit_warehouse"],ENT_QUOTES)));
			$code = mysqli_real_escape_string($conn,(strip_tags($_POST["edit_code"],ENT_QUOTES)));
			$profit = intval($_POST["edit_profit"]);
			$cost_price = floatval($_POST["edit_cost_price"]);
			$others = floatval($_POST["edit_others"]);
			$sale_price = floatval($_POST["edit_sale_price"]);
			$stock = intval($_POST["edit_stock"]);
			$description = mysqli_real_escape_string($conn,(strip_tags($_POST["edit_description"],ENT_QUOTES)));
			$fileInfo = PATHINFO($_FILES["image"]["name"]);
			define('folderDirectory',$_SERVER['DOCUMENT_ROOT']."/mi_tienda/vistas/img/"); /// modificado
			$p=mysqli_query($conn,"select * from articulo where idarticulo='$id'");
			$prow=mysqli_fetch_array($p); 
			
			if (empty($_FILES["image"]["name"]))
			{
				$locationImg=$prow['photo'];
			}
			else
			{
				if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png")
				{
					if(!file_exists(folderDirectory."upload"))
					{
						mkdir(folderDirectory."upload",0777,true);
					}
					$newFilename = $fileInfo['filename'] . "." . $fileInfo['extension'];
					move_uploaded_file($_FILES["image"]["tmp_name"], folderDirectory."img/".$newFilename);
					$locationImg = "img/" . $newFilename;
					unlink(folderDirectory."img/".$prow["imagen"]); // eliminamos la foto actual 
				}
				else
				{
					$locationImg=$prow['photo'];
				}
			}
			
			// UPDATE data into database
			$sql = "call update_product('$id','$name','$category','$warehouse','$code','$profit','$cost_price','$others','$sale_price','$stock','$description','$locationImg')";
			$query = mysqli_query($conn,$sql);
			
			// if product has been added successfully
			if($query) 
			{
				echo json_encode(['error'=>false,"msg"=>'Product successfully updated!','products'=>getAllProducts($conn,$category)]);
			} 
			else
			{
				echo json_encode(['error'=>true,'msg'=>'Try again. Product not deleted!',"mistake"=>mysqli_error($conn)]);
				echo mysqli_error($conn);
			}
		}
	} 
	else 
	{
		echo json_encode(['error'=>true,'msg'=>"Unknow"]);
	}


	function category($conn,$idCategory,$nameCategory){
		$options ="";
		try{
			$result=mysqli_query($conn,"select * from categoria where idcategoria != $idCategory");
			if($result)
			{
				$options.= "<option value=". $idCategory.">".$nameCategory."</option>";
				while($crow=mysqli_fetch_array($result)){
					$options.= "<option value=". $crow['idcategoria'].">".$crow['nombre']."</option>";
				}
			}
			else
			{
				return "<option >There are errors in category</option>";
			}
		}
		catch(mysqli_sql_exception $e){
			return "<option>".$e."</option>";
		}
		
		return $options;
	}

	function warehouse($conn,$idWarehouse,$nameWarehouse){
		$options = "";
		try{
			$result=mysqli_query($conn,"select * from warehouse where idwarehouse != $idWarehouse");
			if($result)
			{
				$options.= "<option value=". $idWarehouse.">".$nameWarehouse."</option>";
				while($srow=mysqli_fetch_array($result)){
					$options.= "<option value=". $srow['idwarehouse'].">".$srow['namewarehouse']."</option>";
				}
			}
			else
			{
				return "<option >There are errors in warehouse</option>";
			}
			
		}catch(mysqli_sql_exception $e){
			return "<option>".$e."</option>";
		}
		return $options;
	}

	function getAllProducts($conn,$idCategory){
		$tableProd="";
		$sqlRead="SELECT a.idarticulo,a.idcategoria, a.idwarehouse, w.namewarehouse as warehouse, c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion, a.precio_costo, a.profit, a.precio_venta, a.others FROM articulo a 
		INNER JOIN categoria c ON a.idcategoria=c.idcategoria 
		INNER JOIN warehouse w on a.idwarehouse=w.idwarehouse
	   
		where a.idcategoria = $idCategory  ORDER BY a.nombre asc ";
		
		$result=mysqli_query($conn,$sqlRead);
		if($result){
			while($row = mysqli_fetch_array($result)){
				$pid = $row['productid'];
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
		return $tableProd;
	}

?>