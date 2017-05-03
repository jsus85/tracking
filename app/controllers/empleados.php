<?php

/***
 *** Funcion para Nuevo Empleado 
 ***/
function procesar_formulario($form_entrada)
{
   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
   
			if ($form_entrada["nombres"]=="")   
		   		$error_form = " * Error en Nombre. Por favor, ingrese Nombre";			
		   else if (!validar_letras($form_entrada["nombres"])) 
		   		$error_form = " * Error en Nombre. Por favor, ingresar solo letras";			
	 	   else if ($form_entrada['email']=="")	 
				$error_form = " * Error en Email. Por favor, ingrese un Email.";						
		   else if (!validar_email($form_entrada["email"]))  
				$error_form = " * Error en Email. Email invalido.";	
 
	 
  if ($error_form != "")
  {		

  	$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'><b>$error_form</b></span>");
		return $respuesta;
  }
  else
  {
	

$numero = 0;
if( $form_entrada["clave"]!=''){
$numero = mysql_num_rows(db_query("select * from empleados where clave = '".mysql_real_escape_string(trim($form_entrada["clave"]))."' "));
}

if($numero==0){

  $insertPersona= " INSERT INTO empleados (
										nombres,
										clave,
										email,
										telefonos,
										dni,
										ctime)
								VALUES (						
										'".$form_entrada['nombres']."'	,
										'".$form_entrada['clave']."'	,
										'".$form_entrada['email']."'	,
										'".$form_entrada['telefonos']."',
										'".$form_entrada['dni']."',
										now())";
							
				$queryPersona = db_query($insertPersona);
			  	$respuesta->addAlert("Registro Guardardo.");
				$respuesta->addRedirect("empleados.php");

			}else{
				$respuesta->addAlert("* Error en Clave, clave existente.");
				$respuesta->addAssign("clave","focus()","");	



			}
				}
	
		return $respuesta;
		
}

function comprobar_clave($form_data){

   $respuesta = new xajaxResponse('ISO-8859-1');
   $numero = 0;
   $numero = mysql_num_rows(db_query("select * from  empleados where clave =  '".$form_data."'"));  	
   
   if($numero==1){
  
  		$respuesta->addAlert("* Error en Clave , valor ya registrado.");
		$respuesta->addAssign("clave","focus()","");		
		return $respuesta;	
	}

   return $respuesta;	

}// FUNCION



/***
 *** Funcion para Editar empleados 
 ***/
function procesar_editar($form_entrada){
   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
    
	
 if ($form_entrada["nombres"]=="")   
		$error_form = " * Error en Nombre. Por favor, ingrese Nombre";	
		
	else if (!validar_letras($form_entrada["nombres"])) 
		$error_form = " * Error en Nombre. Por favor, ingresar solo letras";	
		
	else if ($form_entrada['email']=="")	 
		$error_form = " * Error en Email. Por favor, ingrese un Email.";			
			
	else if (!validar_email($form_entrada["email"]))  
		$error_form = " * Error en Email. Email invalido.";	
  
			 

  if ($error_form != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
		return $respuesta;
  }
  else
  {		
		   
	   // UPDATE TABLA empleados	 
	   $sql_update="UPDATE empleados SET 
						nombres   	= '".$form_entrada['nombres']."'	, 
						clave       = '".$form_entrada['clave']."'		,
						telefonos   = '".$form_entrada['telefonos']."'	, 
						dni   		= '".$form_entrada['dni']."'		,	 

						email   	= '".$form_entrada['email']."'		
					WHERE 
						id  = '".$form_entrada['id_empleados']."'";
	
		$queryUpdate   =db_query($sql_update);
	
		if($queryUpdate)

		$respuesta->addAlert("Registro Guardardo.");
		$respuesta->addRedirect("empleados.php");
		return $respuesta;		  
  }


	
}



require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("comprobar_ruc");
$xajax->registerFunction("procesar_formulario");
$xajax->registerFunction("procesar_editar");
$xajax->registerFunction("comprobar_clave");
$xajax->processRequests();
?>