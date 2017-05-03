<?php
session_start();
include('models/basedatos.php');
include('models/funciones.php');
include('controllers/clientes.php');
include('models/estado_usuario.php');

$sql_select   = "SELECT * FROM clientes WHERE id='".$_GET['id_cliente']."'";
$query_select = db_query($sql_select);
$row          = db_fetch_array($query_select);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alba Transports - Clientes</title>
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
                <h2>EDITAR CLIENTE</h2>
          </div>
        </div>
      </div>  
      <div class="app-body">
          <!-- Panel Admin -->
          <div class="panel-adm">
          <form id="formpersona" name="formpersona">  
            <input name="id_cliente" type="hidden" value="<?=$row['id'];?>" />
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <div class="row">
                      <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                        <label>NOMBRES</label>
                      </div>
                      <div class="col-sm-5 col-xs-12">
                        <input value="<?=$row['nombres'];?>" type="text" name="nombres" class="form-control" placeholder="">
                      </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>CLAVE</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input value="<?=$row['clave'];?>" type="text" name="clave" id="clave" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>RUC</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" value="<?=$row['ruc'];?>" name="ruc" id="ruc" placeholder="">
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>E-MAIL</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" name="email" value="<?=$row['email'];?>" id="email" placeholder="">
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>DNI</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" value="<?=$row['dni'];?>" name="dni" id="dni" placeholder="" />
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>TELÉFONOS</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="text" class="form-control" value="<?=$row['telefonos'];?>" name="telefonos" id="telefonos" placeholder="">
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-1 col-sm-offset-4 col-xs-12">
                      <label>CONDICIÓN</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <div class="row">
                        <div class="col-sm-3 col-xs-5">
                          <label>
                            <input type="radio" <?php if($row['condicion']=='N'){?>checked="checked"<?php } ?> name="condicion" id="condicion" value="N" checked="">
                            Natural
                          </label>
                        </div>
                        <div class="col-sm-3 col-xs-5">
                          <label>
                            <input type="radio" <?php if($row['condicion']=='J'){?>checked="checked"<?php } ?> name="condicion" id="condicion" value="J" checked="">
                            Jurídico
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-xs-12">            
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-5">
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div id="mensaje"></div>
                          <div class="col-sm-3 col-xs-12">
                            <button type="button" onclick="xajax_procesar_editar(xajax.getFormValues('formpersona'))"  class="btn btn-primary middle">Grabar</button>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <button type="button" onclick="javascript:window.location='clientes.php'" class="btn btn-primary middle">Cancelar</button>
                          </div>
                      </div>
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
              <button type="button" class="btn btn-primary" onclick="javascript:window.location='panel.php'">Regresar Panel</button>
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
