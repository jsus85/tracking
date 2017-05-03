<?php
session_start();
include('models/basedatos.php');
include('models/estado_usuario.php');

if(isset($_POST['accion'])){
   
   if($_POST['accion']=='cliente'){

      $rowcliente = mysql_fetch_array(db_query("select * from clientes where id = '".mysql_real_escape_string($_POST['id_cliente'])."' "));
    $email      = $rowcliente['email'];
    $telefonos    = $rowcliente['telefonos'];
    $dni        = $rowcliente['dni'];
    $id         = $rowcliente['id'];
    
    echo $email.'*'.$telefonos.'*'.$dni.'*'.$id.'*';
    exit;
   }
}
?>