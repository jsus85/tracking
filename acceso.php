<?php
session_start();
include("app/models/basedatos.php");
include("app/models/funciones.php");
require ('app/xajax/xajax.inc.php');

function validar($form_entrada){
    $respuesta = new xajaxResponse('ISO-8859-1');
    $error_form = "";
    
        
    if($form_entrada['clave']==""){
        $respuesta->addAlert("* Error en clave, ingrese por favor.");
        $respuesta->addAssign("clave","focus()","");    
    }else{
    
         
        $numero = mysql_num_rows(mysql_query("select * from empleados where clave = '".mysql_real_escape_string($form_entrada['clave'])."'  "));
        
        $rowEmpleados = mysql_fetch_assoc(mysql_query("select * from empleados where clave = '".mysql_real_escape_string($form_entrada['clave'])."'  "));
         
        if($numero!='0' ){

             
            $_SESSION['idEmpleado'] = $rowEmpleados['id'];
            $respuesta->addAssign("formulario","action","documento.php");
            $respuesta->addAssign("formulario","submit()","");
        }else{
            $respuesta->addAlert("* Error datos incorrectos, ingrese por favor .");     

        }
    }
    return $respuesta;  
}


$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->decodeUTF8InputOn();
$xajax->registerFunction("validar");
$xajax->processRequests();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>alba transportes</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- font-family -->
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <!-- app.css -->
  <link rel="stylesheet" href="dist/css/app.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<?php  $xajax->printJavascript("app/xajax/"); ?>

</head>
<body class="hold-transition">
  <header>
    <div class="col-sm-6">
      <a href="index.html"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-xs-12 col-sm-4">
          <div class="social">
              <li><a href="http://www.twitter.com/transportesalba" target="_blank" class="twitter"></a></li>
              <li><a href="https://www.facebook.com/transalbasac" target="_blank" class="facebook"></a></li>  
          </div>
        </div>
        <div class="col-xs-12 col-sm-8">
          <div class="telefonos">
            <p>(511) 241-6542</p>
            <p>51*834*2502</p>
            <span>operaciones@transportesalba.com</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="banner-img">
          <div class="col-xs-12 col-sm-6">
            <a href="index.php"><img src="img/trackin.jpg" alt=""></a>
          </div>
          <div class="col-xs-12 col-sm-6">
            <a href=""><img src="img/cotizacion.jpg" alt=""></a>
          </div>
        </div>    
      </div>
      <div class="row">
        <a href="alba.pdf" target="_black">Descargar brochure</a>
      </div>
    </div>
    <div class="nav">
      <div class="menu">
        <ul class="botones">
          <li><a href="index.html">Inicio</a></li>
            <li><a href="nosotros.html">Nosotros</a></li>
          <li><a href="servicios.html">Servicios</a></li>
            <li><a href="productos.html">Productos</a></li>
            <!-- <li><a href="cotizacion.html">Cotización</a></li> -->
            <!-- <li><a href="ubicacion.html">Ubicación</a></li> -->
            <li><a href="contacto2.html">Contacto</a></li>
        </ul>
      </div>
    </div>
  </header>
  <div class="wrapper">
    <div class="col-sm-3">
      <div class="cont-left">
        LEFT
      </div>
    </div>
    <div class="col-sm-9 cont-right">
        <div class="banner">
          <img src="img/banner-tracking.jpg" alt="">
        </div>
        <div class="login-box">
          <div class="login-logo">
            <span>TRACKING - INGRESE LOS DATOS</span>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
            <form action="" method="post" id="formulario" name="formulario">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <p>Ingrese su Clave</p>
                  </div>
                  <div class="col-xs-12">

                    <input type="password" onkeypress="if(event.keyCode == '13'){ xajax_validar(xajax.getFormValues('formulario')); return false; }" style="border:#C7C7C7 1px solid;width:150px" name="clave" id="clave" />
    
              

                  </div>
                </div>
              </div>              
              <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                  <button type="button" onclick="xajax_validar(xajax.getFormValues('formulario'));"  class="ingres btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.login-box-body -->
        </div>
    </div>    
  </div>
  <div class="footer text-center">
    <p>OFICINA: Jr. Juan Ochoa 112, Surquillo - Lima ALMACÉN: Jr. Dante 283, Surquillo - Lima</p>
  <p>(511) 241-6542</p>
  <p>Nxtl. 51*834*2502</p>
  <p>by dobano</p>
  </div>


<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
