<?php

function procesar_formulario($form_entrada){

   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
    
	   if ($form_entrada["nickname1"]!="")        
	   {
		   $query  = db_query("SELECT * FROM personas
							   WHERE persona_nickname = '".$form_entrada['nickname1']."'
							   AND codigo_persona   = '".$_SESSION['webuser_id']."'");
		   $total  = db_num_rows($query);
	  	   if($total==0) 							  	  
				$error_form = " * Error en antigua nickname. Nick incorrecto";	 
	   
		   else if ($form_entrada["nickname2"]=="")   
				$error_form = " * Error en nuevo nick. Por favor, ingresar el nuevo nickname.";	
		
		   else if ( $form_entrada["nickname1"]=="")        
		 		$error_form = " * Error en email. Por favor ingrese email.";	   
	
		   else
		   {	
		   		$query  = db_query("SELECT codigo_persona FROM personas
								   WHERE persona_email='".$form_entrada['email']."'
								   AND codigo_persona<>'".$_SESSION['webuser_id']."'");
				$total  = db_num_rows($query);
				if($total>0) 								
					$error_form = " * Error en email. Ese email ya esta registrado";	 
				
				else if ($form_entrada["passwd1"]!="")        
				{
				   $query  = db_query("SELECT * FROM personas
									   WHERE persona_password = '".$form_entrada['passwd1']."'
									   AND codigo_persona   = '".$_SESSION['webuser_id']."'");
				   $total  = db_num_rows($query);
	
				   if($total==0) 							  	  
						$error_form = " * Error en antigua contraseña. Contraseña incorrecta";	 
			
				   else if ($form_entrada["passwd2"]=="")   
						$error_form = " * Error en nuevo password. Por favor, ingresar la nueva contraseña.";	
			
				   else if ($form_entrada["passwd3"]=="")   
						$error_form = " * Error en password de confirmacion. Por favor, ingresar la contraseña de confirmacion.";	
			
				   else if ($form_entrada["passwd2"]!=$form_entrada["passwd3"])   
						$error_form = " * Error en password de confirmacion. Las contraseñas ingresadas no son iguales.";	
				 }
	
			}	// else
			
   	  }



  
  if ($error_form != "")
  {		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'>$error_form</span>");
		return $respuesta;
  }
  else
  {	 

	if ($form_entrada["nickname1"]!="")        
	{	$sql_update="UPDATE personas SET 
						persona_nickname	='".$form_entrada["nickname2"]."',codigo_usuario = '".$_SESSION['webuser_id']."' , fecha_modifica = '".date("Y-m-d H:i:s")."'
					 WHERE codigo_persona  ='".$_SESSION['webuser_id']."'";
		db_query($sql_update);
	}
	if ($form_entrada['passwd1']!="")        
	{	$sql_update="UPDATE personas SET 
						persona_password ='".$form_entrada["passwd2"]."',codigo_usuario = '".$_SESSION['webuser_id']."' , fecha_modifica = '".date("Y-m-d H:i:s")."'
					 WHERE codigo_persona  ='".$_SESSION['webuser_id']."'";
		db_query($sql_update);
	}
	if ($form_entrada['email']!="")        
	{	$sql_update="UPDATE personas SET 
						persona_email ='".$form_entrada["email"]."' ,codigo_usuario = '".$_SESSION['webuser_id']."' , fecha_modifica = '".date("Y-m-d H:i:s")."'
					 WHERE codigo_persona  ='".$_SESSION['webuser_id']."'";
		db_query($sql_update);
	}
	

		
	

   }
			
		$respuesta->addRedirect("panel.php");
		return $respuesta;     
}

/* funcion para cerrar session*/
function salir(){
	$respuesta = new xajaxResponse('ISO-8859-1');
	 session_destroy();
	 $respuesta->addRedirect("index.php");
	 return $respuesta;

}

require ('xajax/xajax.inc.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("procesar_formulario");
$xajax->registerFunction("salir");
$xajax->processRequests();

?>