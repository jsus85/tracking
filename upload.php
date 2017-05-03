<?php
session_start();
include("app/models/basedatos.php");
include("app/models/funciones.php");


  $mensaje = "";
  $campoImagen = "";
        
    if ($_FILES["file"]["name"] != '') {      

        $imagen1 = $_FILES['file']['name'];
        $dir = 'img/documentos/';             
        $imagen1 = fnRenameUpload($imagen1,$dir);
        copy($_FILES["file"]["tmp_name"],$dir.$imagen1);  
        $campoImagen = " archivo = '".$imagen1."' , ";
    }

        db_query("update tracking 
                          set
                               ".$campoImagen."
                               comentario_entrega = '".$_POST['comentario']."' ,
                               estado = 1,
                               recepcionado = '".$_POST['recepcionado']."' , 

                               hora_llegada = '".date(" H:i:s")."',
                               empleado_id = '". $_SESSION['idEmpleado']."'

                 where id  = '".$_POST['codigo']."' ") ;
        
header('Location: index.php');

?>