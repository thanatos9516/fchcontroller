var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })
}

//funcion limpiar
function limpiar(){
	$("#idwarehouse").val("");
	$("#namewarehouse").val("");
    $("#citywarehouse").val("");
    $("#numberwarehouse").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/warehouse.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/warehouse.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		tabla.ajax.reload();
     	}
     });

     limpiar();
}

function mostrar(idwarehouse){
	$.post("../ajax/warehouse.php?op=mostrar",{idwarehouse : idwarehouse},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#namewarehouse").val(data.namewarehouse);
			$("#citywarehouse").val(data.citywarehouse);
            $("#idwarehouse").val(data.idwarehouse);
            $("#numberwarehouse").val(data.numberwarehouse);
		})
}


//funcion para desactivar
function desactivar(idwarehouse){
	bootbox.confirm("¿Are you sure to disable this data??", function(result){
		if (result) {
			$.post("../ajax/warehouse.php?op=desactivar", {idwarehouse : idwarehouse}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idwarehouse){
	bootbox.confirm("¿Are you sure to activate this data??" , function(result){
		if (result) {
			$.post("../ajax/warehouse.php?op=activar" , {idwarehouse : idwarehouse}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();