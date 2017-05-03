<?php 
require ('xajax/xajax.inc.php');

function redirect()
{
	$objResponse = new xajaxResponse();
	$objResponse->addRedirect("tracking.php");
	return $objResponse;
}


function comprobar_documento($form_data){
   $respuesta = new xajaxResponse('ISO-8859-1');
   $numero = 0;
   
   
   $numero = mysql_num_rows(db_query("select * from  tracking where ruc =  '".$form_data."'"));  	
   if($numero==1){
  		$respuesta->addAlert("* Error Nro. documento , valor ya registrado.");
		$respuesta->addAssign("ruc","focus()","");		
		   return $respuesta;	

   }

   return $respuesta;	
	   
}// FUNCION

function procesar_formulario($form_data){   

   $respuesta = new xajaxResponse('ISO-8859-1');
   
   if ($form_data["id_usuario"]==""){   
		$error_form = " * Error en Codigo del cliente. Por favor, Busque y seleccione";			
   }else if($form_data["ruc"]==""){
		$error_form = " * Error en RUC. Por favor, Ingrese el RUC";	
		$respuesta->addAssign("ruc","focus()","");
   }
   
  if ($error_form != "")
  {		
  		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;font-size:13px'><b>$error_form</b></span>");
		return $respuesta;
  }
  else
  {	   
 		
		$sql_tracking = "insert into tracking(ruc,
											  monto,
											  modalidad,
											  ctime,
											  cliente_id,											 
											  tipo_documento,
											  moneda,
											  fecha_inicio,
											  origen,
											  destino,
											  origen_ubigeo,
											  destino_ubigeo,
											  hora_salida,
											  fecha_fin)
										values(
											   '".trim($form_data["ruc"])."'	,
											   '".$form_data["monto"]."'		,
											   '".$form_data["modalidad"]."'	,
											   now(),
											   '".$form_data["id_usuario"]."'	,											   
											   '".$form_data["documento"]."'  	,
											   '".$form_data["moneda"]."'		,
											   '".$form_data["fechaRegistro"]."',
											   '".$form_data["origen"]."'		,
											   '".$form_data["destino"]."'		,
											   '".$form_data["distrito"]."'		,
											   '".$form_data["distrito2"]."'		,
											   '".$form_data["hora_salida"]."'		,
											   '".$form_data["fecha_llegada"]."'		
											   
											   )";
										
		db_query($sql_tracking) or die(mysql_error());
		$id_tracking = mysql_insert_id();
		
		$count_opc =  count($form_data["idopc2"]);		
		################################# Tracking Opciones Detalle 
		for ($x = 0; $x<$count_opc; $x++){
				if(isset($form_data["idopc2"][$x])){
					 $sql_insert_opc = "insert into tracking_opciones_detalle
															(valor,
															 tracking_id,
															 tracking_opciones_id)
														values
															(
															  '".mysql_real_escape_string($form_data["texto2".$form_data["idopc2"][$x]])."'  ,
															  '".$id_tracking."',
															  '".$form_data["idopc2"][$x]."' 
															 )";
					mysql_query($sql_insert_opc) or die("detalle ->".mysql_error());
				}
			}
		############# END
		
			for($i=1;$i<$form_data['img'];$i++){
					
					if($form_data["producto_".$i] != '' && $form_data["origen_".$i]!= '' && $form_data["comentario_".$i]!= '' ){
						//echo $form_data["opciones".$rw_tracking_detalle_opciones['id']."_".$i]." ".$rw_tracking_detalle_opciones['id'];
						$sql_tracking_detalle = "insert into tracking_detalle(
																			  producto,
																			  modalidad,
																			  origen,
																			  fecha,
																			  comentario,
																			  ctime,
																			  tracking_id
																			  )
																		values(
																			   '".$form_data["producto_".$i]."',
																			   '".$form_data["modalidad_".$i]."',
																			   '".$form_data["origen_".$i]."',
																			   '".$form_data["fecha_".$i]."',
																			   '".$form_data["comentario_".$i]."',
																			   now(),
																			   '".$id_tracking."')";
						db_query($sql_tracking_detalle) or die(mysql_error());																				
					} // IF
			}// FOR
	
		
	}// ELSE
	  
	  
 	  	return redirect();  
  }// FUNCION


/* Editar Formulario tracking */  
function procesar_formularioEditar($form_data){   

   $respuesta = new xajaxResponse('ISO-8859-1');
   
   if($form_data["ruc"]==""){
		$error_form = " * Error en RUC. Por favor, Ingrese el RUC";	
		$respuesta->addAssign("ruc","focus()","");
   }
   
   
  if ($error_form != ""){		
  
  		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'><b>$error_form</b></span>");
		return $respuesta;
  
  }else{
  	   
  		$sql_update = "update tracking set 
												ruc		  	   =  '".$form_data['ruc']."' 			,
												monto          =  '".$form_data['monto']."' 		,
												modalidad 	   =  '".$form_data['modalidad']."'	 	,
												tipo_documento =  '".$form_data['documento']."' 	,
												comentario_entrega='".$form_data['comentario']."'	,
												moneda		   = '".$form_data['moneda']."'			,
												fecha_inicio   = '".$form_data['fechaRegistro']."'	,
												fecha_fin	   = '".$form_data['fecha_llegada']."'			,
												origen 		   = '".$form_data['origen']."'			,
												destino		   = '".$form_data['destino']."'		,
												origen_ubigeo  = '".$form_data['distrito']."'		,
											 	destino_ubigeo = '".$form_data['distrito2']."'		,
											  	hora_salida	   = '".$form_data['hora_salida']."'	
														
												
									where 
											 id = '".$form_data['id_tracking']."' ";
											 
		mysql_query($sql_update) or die(mysql_error());
		
		$count_opc =  count($form_data["idopc2"]);		
		################################# Tracking Opciones Detalle 
		db_query("delete from tracking_opciones_detalle where tracking_id = '".$form_data['id_tracking']."' ");
		
		for ($x = 0; $x<$count_opc; $x++){
				if(isset($form_data["idopc2"][$x])){
					 $sql_insert_opc = "insert into tracking_opciones_detalle
															(valor,
															 tracking_id,
															 tracking_opciones_id)
														values
															(
															  '".mysql_real_escape_string($form_data["texto2".$form_data["idopc2"][$x]])."'  ,
															  '".$form_data['id_tracking']."',
															  '".$form_data["idopc2"][$x]."' 
															 )";
					mysql_query($sql_insert_opc) or die("detalle ->".mysql_error());
				}
			}
		############# END
		
		################################################
		for($j=1;$j<=$form_data['nro'];$j++){
				
				 $sql_update = "update tracking_detalle set 
															
															producto   = '".$form_data["producto_".$j]."' ,
															modalidad  = '".$form_data["modalidad_".$j]."',
															origen     = '".$form_data["origen_".$j]."',
															fecha      = '".$form_data["fecha_".$j]."',
															comentario = '".$form_data["comentario_".$j]."'
														where
															id = '".$form_data["id_track_opc".$j]."'
															";
				mysql_query($sql_update) or die(mysql_error());
		}
		
			for($i=1;$i<$form_data['img'];$i++){					
					if($form_data["producto2_".$i] != '' && $form_data["origen2_".$i]!= '' && $form_data["comentario2_".$i]!= '' ){
						//echo $form_data["opciones".$rw_tracking_detalle_opciones['id']."_".$i]." ".$rw_tracking_detalle_opciones['id'];
						$sql_tracking_detalle = "insert into tracking_detalle(
																			  producto,
																			  modalidad,
																			  origen,
																			  fecha,
																			  comentario,
																			  ctime,
																			  tracking_id
																			  )
																		values(
																			   '".$form_data["producto2_".$i]."'  ,
																			   '".$form_data["modalidad2_".$i]."' ,
																			   '".$form_data["origen2_".$i]."' 	  ,
																			   '".$form_data["fecha2_".$i]."',
																			   '".$form_data["comentario2_".$i]."',
																			   now(),
																			   '".$form_data['id_tracking']."')";
						db_query($sql_tracking_detalle) or die(mysql_error());																				
					} // IF
			}// FOR		
		
		
		
 	 		 $respuesta->addRedirect("tracking.php");
 	 		 return $respuesta;
  }
  
}


  /* funcion para cerrar session*/
function salir(){
	$respuesta = new xajaxResponse('ISO-8859-1');
	 session_destroy();
	 $respuesta->addRedirect("index.php");
	 return $respuesta;

}

$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_formulario");
$xajax->registerFunction("procesar_formularioEditar");
$xajax->registerFunction("comprobar_documento");
$xajax->registerFunction("salir");
$xajax->processRequests();
?>