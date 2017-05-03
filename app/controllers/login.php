<?php
/* validar el ingreso de login */
function procesar_formulario($form_entrada){

   $respuesta = new xajaxResponse('ISO-8859-1');
   $error_form = "";
   if ($form_entrada["nick"]=="")   					
	   	$error_form = " * Error en Usuario. Por favor, ingrese el usuario";	
   else if (!validar_nick($form_entrada["nick"]))  
   		$error_form = " * Error en usuario, Ingresar solo letras";	
		
   else if ($form_entrada["clave"]=="")  
   		$error_form = " * Error en password. Por favor, ingresar su password";	
		
   else if (!validar_passwd($form_entrada["clave"]))   
   		$error_form = " * Error en password, No estan permitidos caracteres especiales";	
   else
   {		
   			$sqlogin = "SELECT 
   								persona_tipo,codigo_persona,persona_principal ,persona_nickname
   						FROM
   								personas 
   						WHERE 
   								persona_nickname = '".$form_entrada['nick']."'  AND 
   								persona_password = '".$form_entrada['clave']."' AND 
   								registro_estado	 ='1' AND 
   								persona_tipo in('1','2') ";
			
			$reslogin = db_query($sqlogin);

			if (db_num_rows($reslogin)!=0) 
			{
				$user_data = db_fetch_array($reslogin);
				unset ($password);
				session_cache_limiter('nocache,private');
				$_SESSION['webuser_id']       = $user_data['codigo_persona'];
				$_SESSION['webuser_empresa']  = $user_data['persona_nickname'];
				$_SESSION['webuser_aut']      = '1';
				$_SESSION['pais']		      = 'PE00000';
				$_SESSION['webuser_pri']      = $user_data['persona_principal'];
				$_SESSION['webuser_tipo']      = $user_data['persona_tipo'];
				
				
				db_query("UPDATE personas SET fecha_logeo='".date("Y-m-d H:i:s")."'
						  WHERE codigo_persona='".$user_data['codigo_persona']."'");
							
			
			}
			
			else if (db_num_rows($reslogin)==0)
			{	
				$error_form = " * Error en datos de usuario, el nombre y password son incorrectos.";	
			}
		
	} //else
	
	if ($error_form!="")
    {	
   		
   		$respuesta->addAssign("mensaje","innerHTML","<span style='color:red;'><b>$error_form</b></span>");
	}else{	 
    	
    	$respuesta->addRedirect("panel.php");
    }
   
     return $respuesta;

} //function


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