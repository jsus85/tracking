<?php
session_start();
include('models/basedatos.php');
include('controllers/login.php');
include('models/estado_usuario.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alba Transportes</title>
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
  <!-- app.css -->
  <link rel="stylesheet" href="dist/css/app.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php  $xajax->printJavascript("xajax/");?>
</head>
<body class="hold-transition login-page">
<div class="panel--box">
  
    <!--Header-->
    <?php include('include/header.php');?>
    <!--Header-->

    <div class="panel--body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <h1 class="title-panel">ADMINISTRACIÓN</h1>
            <div class="ope">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <a href="tracking.php" class="col-xs-12"><img src="img/tracking.png" alt="tracking"></a>
                  <span class="col-xs-12 col-anar">TRACKING</span>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <a href="clientes.php" class="col-xs-12"><img src="img/clientes.png" alt="clientes"></a>
                  <span class="col-xs-12 col-anar">CLIENTES</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-xs-12">
            <h1 class="title-panel">CONFIGURACIÓN</h1>
            <div class="ope">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <a href="empleados.php" class="col-xs-12"><img src="img/empleados.png" alt="empleados"></a>
                  <span class="col-xs-12 col-anar">EMPLEADOS</span>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <a href="perfil.php" class="col-xs-12"><img src="img/mi-perfil.png" alt="mi-perfil"></a>
                  <span class="col-xs-12 col-anar">MI PERFIL</span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  <!--Footer-->
  <?php include('include/footer.php');?>
  <!--Footer-->

</div>
<!-- /.panel-box -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
