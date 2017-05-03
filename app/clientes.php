<?php
session_start();
include('models/basedatos.php');
include('controllers/login.php');
include('models/estado_usuario.php');

 /********************* SQL CLIENTES ****************/

 /******************** Cambiar estado de personas ******************************/
if($_GET['id_mod'])
{ 
  
  $sqlestado  = db_query("SELECT estado FROM clientes
                                                     WHERE id='".$_GET['id_mod']."'");
  $row        = db_fetch_array($sqlestado);
  
  $estado=($row['estado']=='1')?'0':'1';  

  db_query("UPDATE clientes SET estado = '".$estado."' 
                                                      WHERE id='".$_GET['id_mod']."'");

}

/*********** CLIENTES ************/
if($_GET['id_del'])
{   
  db_query("DELETE FROM clientes WHERE id='".$_GET['id_del']."'");
//  db_query("DELETE FROM webpermisos WHERE codigo_persona='".$_GET['id_del']."'"); 
}



  // CONSULTA

  if($_POST['nombre']!='' && isset($_POST['nombre']))
    $cadFecha =" and nombres like '%".$_POST['nombre']."%'";
    
  if($_POST['condicion']!='0' && isset($_POST['condicion']))
    $condi    = " and condicion = '".$_POST['condicion']."' ";
  
  $sqlPersona= " SELECT * FROM clientes where 1=1 ".$cadFecha.$condi." ORDER BY id desc"; 
  $_SESSION['SQL_USUARIOS'] = $sqlPersona;
    $query = db_query($sqlPersona);
  $total = db_num_rows($query);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alba Transportes - Clientes</title>
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
</head>
<body class="hold-transition login-page">
<!-- panel-box -->
<div class="panel--box">
  
  <!--Header-->
  <?php include('include/header.php');?>
  <!--Header-->

  <div class="panel--body">
    <form name="frm_usuarios" method="post" action="clientes.php">
      <div class="app-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-sm-8 col-xs-12">
                <h2>GESTIÓN DE CLIENTES</h2>
              </div>
              <div class="col-sm-4 col-xs-12 pull-right">
                <div class="select-op">
                  <div class="row">
                    <div class="col-xs-6"><a  href="clientesNuevo.php"><i class="fa fa-lg fa-fw fa-file-o"></i> NUEVO</a></div>
                    <div class="col-xs-6"><a onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar registro(s)?'); return willSubmit;"><i class="fa fa-lg fa-fw fa-times-circle-o"></i>ELIMINAR</a></div>
                  </div>
                </div>  
              </div> 
            </div>
          </div>
        </div>
      </div>  
      <div class="app-body">
          <!-- Panel Admin -->
          <div class="panel-adm">
            <div class="row">

                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-9 col-xs-12">
                        <div class="row">
                          <div class="col-sm-3 col-xs-12">
                            <label>NOMBRES</label>
                          </div>
                          <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                        <select class="form-control mar-tb" name="condicion" id="condicion">
                              <option <?php if($_POST['condicion']=='0'){?> selected="selected" <?php } ?> value="0">[ Todos ]</option>
                              <option <?php if($_POST['condicion']=='N'){?> selected="selected" <?php } ?> value="N">Natural</option>
                              <option <?php if($_POST['condicion']=='J'){?> selected="selected" <?php } ?> value="J">Jurídico</option>
                          </select>
                    </div>
                    </div>
                  </div>                  
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                        <label>FECHA DE REGISTRO</label>
                      </div>
                      <div class="col-sm-5 col-xs-12">
                          <input type="text" id="fecha" name="fecha" class="form-control" placeholder="">
                      </div>
                      <div class="col-sm-3 col-xs-12">
                        <button type="submit" class="btn btn-primary ">Buscar</button>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </div>
          <!-- End Panel Admin -->
          <!-- Basic Table -->
          <div class="panel panel-default">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th><label><input type="checkbox" name="allreg" type="checkbox" onclick="checktodo(this)" /></label></th>                
                              <th>Nombres</th>
                              <th>Condicion</th>
                              <th>Clave</th>
                              <th>RUC</th>
                              <th>E-mail</th>
                              <th>Fecha</th>

                              <th>Estado</th>
                              <th>Opciones</th>

                          </tr>
                      </thead>
                      <tbody>
<?php

$pag    = $_POST['pg'];
  if ($pag=='') $pag = 1;
  $numPags = ceil($total/VAR_NROITEMS);
  $reg     = ($pag-1) * VAR_NROITEMS;
  $rs      = db_query($sqlPersona ." LIMIT " .$reg." , ".VAR_NROITEMS);
  
    if ($total=='0')
  { 

    echo "<tr class='tdrow1'><td colspan='10' align='center' height='30'>No se encontr 
      registros en esta consulta</td></tr>"; }
   
  else
  { 
  
  while ($row = db_fetch_array($rs))
    { 
?>

                          <tr>
                              <td><label><input name="id[<?=$row['id']?>]" type="checkbox" value="<?php echo $row['id'];?>" /></label></td>
                              <td><?php echo $row['nombres']; ?></td>
                              <td><?php echo ($row['condicion']=='N')?'Natural':'Jurídico'?></td>
                              <td><?php echo $row['clave']?></td>
                              <td><?php echo $row['ruc']?></td>
                              <td><?php echo $row['email']?></td>
                              <td><?php echo substr($row['ctime'],0,10);?></td>
                              <?php  $estado=($row['estado']=='1')?"fa-check":"fa-times";
                             
                              ?>
                            
                              <td class="text-center"><a href="clientes.php?id_mod=<?php echo $row['id'];?>"><i class="fa fa-fw  <?php echo $estado;?> fa-2x"></i></a></td>
                              <td class="action text-center">
                               <a href="clientesEditar.php?id_cliente=<?=$row['id']?>" title="Modificar"><i class="fa fa-fw fa-edit fa-2x"></i></a>
                               <a onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar este registro?'); return willSubmit;" href="clientes.php?id_del=<?=$row['id']?>" title="Eliminar"> <i class="fa fa-fw fa-trash-o fa-2x"></i></a>
                              </td>
                          </tr>
<?    }    //while
   }  // else ?>
<?php 

    if($total > 0){

    ?>
        <tr>
        <td  height="25" colspan="9"><?php include "sisweb_incpaginacion.php"; ?></td>
    </tr>
<?  } ?>  
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- End  Basic Table  -->
        
        <div class="total">
          <div class="row">
            <div class="col-sm-4 col-xs-12">

            </div>
            <div class="col-sm-4 col-xs-12">

            </div>
            <div class="col-sm-4 col-xs-12">
             <p><a href="rpt_xls_usuarios.php" target="_blank">Reporte en Excel <a><img src="img/i-excel.png" alt=""></a></p>
            </div>
          </div>  
        </div>

        <div class="excel">
          <div class="row">
            <div class="col-sm-2 col-xs-12">
              <button type="button"  onclick="javascript:window.location='panel.php'"  class="btn btn-primary ">Atras</button>
            </div>
          </div>  
        </div>  

      </form>
      </div>


  <!--Footer-->
  <?php include('include/footer.php');?>
  <!--Footer-->

      
  </div>
  
  
</div>
<!-- End panel-box -->



<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Calendar-->
<script src="plugins/calendar/bootstrap-datepicker.js"></script>
<script type="text/javascript">
   $(function() {
      $('#fecha').datepicker({format: "yyyy-mm-dd" });  
  });
</script>
</body>
</html>
