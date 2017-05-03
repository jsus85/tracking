
<?php 		
/* ************************************************************************************************
 * validacion: si no existe la session iniciada se realizara un re direccionamiento al index:login
 * ************************************************************************************************
 */
if (!$_SESSION['webuser_id']) {
	session_destroy();
	header ("Location: ./"); 
   exit; 
}
?>
