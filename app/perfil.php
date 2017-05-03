<?php 
session_start();
include('models/basedatos.php');
include('controllers/perfil.php');
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
<!-- panel-box -->
<div class="panel--box">

  <!--Header-->
  <?php include('include/header.php');?>
  <!--Header-->

  <div class="panel--body">
      <div class="app-header">
        <div class="row">
          <div class="col-xs-12">
                <h2>NUEVO CLIENTE</h2>
          </div>
        </div>
      </div>  
      <div class="app-body">
          <!-- Panel Admin -->
          <div class="panel-adm">
            <form id="form_miperfil" >
                <div class="form-group">
                  <div class="row">
                      <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                        <label>NOMBRES</label>
                      </div>
                      <div class="col-sm-5 col-xs-12">
                        <?php echo $_SESSION['webuser_empresa'];?>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                      <label>NICK ANTIGUO</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" name="nickname1" id="nickname1" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                      <label>NUEVO NICK</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" id="nickname2" name="nickname2" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                      <label>CONTRASEÑA ANTIGUA</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" id="passwd1" name="passwd1" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                      <label>NUEVA CONTRASEÑA</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" id="passwd2" name="passwd2" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2 col-sm-offset-3 col-xs-12">
                      <label>CONFIRMAR CONTRASEÑA</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" name="passwd3" id="passwd3" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-5">
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                          <div class="col-sm-3 col-xs-12">
                            <div id="mensaje"></div>
                            <button type="button" class="btn btn-primary middle"  onclick="xajax_procesar_formulario(xajax.getFormValues('form_miperfil'))">Grabar</button>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-primary middle">Cancelar</button>
                          </div>
                      </div>
                    </div> 
                  </div>
                </div>
              </form>
          </div>
          <!-- End Panel Admin -->
        <div class="excel">
          <div class="row">
            <div class="col-sm-2 col-xs-12">
              <button type="button" onclick="javascript:window.location='panel.php';" class="btn btn-primary ">Atras</button>
            </div>
          </div>  
        </div>  
      </div>
  </div>

  <!--Footer-->
  <?php include('include/footer.php');?>
  <!--Footer-->

</div>
<!-- End panel-box -->



<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
