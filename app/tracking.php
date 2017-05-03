<?php
session_start();
include('models/basedatos.php');
include('models/funciones.php');
include('controllers/login.php');
include('models/estado_usuario.php');

$meses = array_meses();

/* cambiar estado del tracking*/
if($_GET['id_mod']){  
  $sqlestado  = db_query("SELECT estado FROM tracking WHERE id = '".$_GET['id_mod']."'");
  $row        = mysql_fetch_array($sqlestado);
  $estado = ($row['estado']=='0')?'1':'0';
  
  db_query("UPDATE tracking  SET estado = '".$estado."'    WHERE     id = '".$_GET['id_mod']."'");
}

/* borrar tracking */
if (isset($_GET['id_del'])){

  db_query("DELETE FROM tracking   WHERE id = '".$_GET['id_del']."' ") or die(mysql_error()) ;
  db_query("DELETE FROM tracking_detalle   WHERE tracking_id = '".$_GET['id_del']."' ") or die(mysql_error()) ;
  db_query("DELETE FROM tracking_opciones_detalle  WHERE tracking_id = '".$_GET['id_del']."' ") or die(mysql_error()) ;

}

  
   if(isset($_POST["id"])){

    foreach($_POST["id"] as $id_pedido=>$valor){  
      if($_POST["id"]){

         db_query("DELETE FROM tracking  WHERE id = '". $id_pedido."' ") or die(mysql_error()) ;
       }

    }   // foreach
} 

/* SQL PRINCIPAL */
  if($_POST['clientes']!='0' && isset($_POST['clientes']))      $filtro[1] = " and tk.cliente_id = '".$_POST['clientes']."'";
  if($_POST['modalidad']!='0' && isset($_POST['modalidad']))      $filtro[2] = " tk.modalidad = '".$_POST['modalidad']."'";
  if($_POST['fechaRegistro']!='' && isset($_POST['fechaRegistro'])) $filtro[3] = " substring(tk.ctime,1,10) BETWEEN '".$_POST['fechaRegistro']."' AND '".$_POST['fechaFin']."' ";


  if($_POST['origen']!='' && isset($_POST['origen']))         $filtro[4] = " tk.origen       = '".trim($_POST['origen'])."' ";
  if($_POST['destino']!='' && isset($_POST['destino']))         $filtro[5] = " tk.destino      = '".trim($_POST['destino'])."' ";
  if($_POST['ruc']!='' && isset($_POST['ruc']))             $filtro[6] = " c.ruc         = '".trim($_POST['ruc'])."' ";
  if($_POST['documento']!='0' && isset($_POST['documento']))      $filtro[7] = " tk.tipo_documento = '".$_POST['documento']."'";
  if($_POST['numero']!='' && isset($_POST['numero']))         $filtro[8] = " tk.ruc        = '".trim($_POST['numero'])."' ";
  if($_POST['estado']!='--' && isset($_POST['estado']))         $filtro[9] = " tk.estado       = '".$_POST['estado']."' ";


  for( $i=2;$i<=13;++$i){
      if($filtro[$i-1]!="") ++$j;
      if($filtro[$i]!="" && $j==0) $filtro[$i] = " AND ".$filtro[$i];           
      if($filtro[$i]!="" && $j!=0) $filtro[$i] = " AND ".$filtro[$i];         
  }
  
  $order = 'desc';
  $campo = (isset($_GET['campo']))?$_GET['campo']:'tk.id';
  
  if(isset($_GET['orden'])){
    if($_GET['orden'] == 'desc'){
      $order = 'asc';
    }else if($_GET['orden'] == 'asc') {
      $order = 'desc';  
    }
  }


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Alba Transportes - Tracking</title>
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
    <form   action='tracking.php' method='post' enctype="multipart/form-data" name='form_menu'>
      <div class="app-header">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-sm-8 col-xs-12">
                <h2>GESTIÓN DE ENTREGAS</h2>
              </div>
              <div class="col-sm-4 col-xs-12 pull-right">
                <div class="select-op">
                  <div class="row">
                    <div class="col-xs-6"><a href="trackingNuevo.php"><i class="fa fa-lg fa-fw fa-file-o"></i> NUEVO</a></div>
                    <div class="col-xs-6"><a onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar registro(s)?'); return document.form_menu.submit();"><i class="fa fa-lg fa-fw fa-times-circle-o"></i>ELIMINAR</a></div>
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
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>RUC</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" title="RUC CLIENTE" value="<?=$_POST['ruc'];?>" type="text" onkeypress="if(event.keyCode == '13'){this.form.submit();return false;}" name="ruc" id="ruc" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>                  
                </div>  
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>CLIENTES</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <?php 
                        $rs_clientes = db_query("select * from clientes order by nombres asc");
                        ?>
                        <select name="clientes" style="width:100%" id="clientes">
                        <option value="0">[Todos]</option>
                        <?php 
                        while($rw_clientes = mysql_fetch_array($rs_clientes)){
                        ?>
                        <option <?php if($_POST['clientes']==$rw_clientes['id']){?> selected="selected" <?php } ?> value="<?php echo $rw_clientes['id'];?>"><?php echo $rw_clientes['nombres'];?></option>      
                        <?php }  ?>      
                        </select>
                      </div>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                        <label>MODALIDAD</label>
                      </div>
                      <div class="col-sm-8 col-xs-12">
                      <select   name="modalidad" id="modalidad">
                      <option value="0" >[ Todos ]</option>
                      <?php 
                      $rs_modalidad = mysql_query("select * from modalidades order by nombres asc");
                      while($rw_modalidad = mysql_fetch_array($rs_modalidad)){
                      ?>
                      <option <?php if($_POST['modalidad']==$rw_modalidad['id']){?> selected="selected"<?php } ?>  value="<?=$rw_modalidad['id'];?>"><?=$rw_modalidad['nombres'];?></option>
                      <?php
                      }
                      ?>
                      </select>
                      </div>
                    </div>
                  </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>ORIGEN</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" value="<?=$_POST['origen'];?>" type="text" onkeypress="if(event.keyCode == '13'){this.form.submit();return false;}" name="origen" id="origen" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>  
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>DESTINO</label>
                      </div>
                      <div class="col-sm-9
                       col-xs-12">
                        <input type="text" value="<?=$_POST['destino']?>" onkeypress="if(event.keyCode == '13'){this.form.submit();return false;}" name="destino" id="destino" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                        <label>FECHA</label>
                      </div>
                      <div class="col-sm-8 col-xs-12">

                         <input type="text" name="fechaRegistro" value="<?=(isset($_POST['fechaRegistro']))?$_POST['fechaRegistro']:date("Y")."-01-01";?>"  size="12" id="fechaRegistro" class="txtbox" onkeypress="if(event.keyCode == '13'){return false;}" />
                        
                         <input type="text" name="fechaFin" value="<?=(isset($_POST['fechaFin']))?$_POST['fechaFin']:date("Y-m-d");?>"  size="12" id="fechaFin" class="txtbox" onkeypress="if(event.keyCode == '13'){return false;}"/>

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>TIPO</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <select name="documento" id="documento" style="width:100%">
                        <option <?php if($_POST['documento']=='0'){?>selected="selected"<?php } ?> value="0">[ Todos Documentos ]</option>
                        <option <?php if($_POST['documento']=='Factura'){?>selected="selected"<?php } ?> value="Factura">Factura</option>
                        <option <?php if($_POST['documento']=='Boleta'){?>selected="selected"<?php } ?> value="Boleta">Boleta</option>
                        <option <?php if($_POST['documento']=='guia-remision'){?>selected="selected"<?php } ?>    value="guia-remision">Gua de remisión</option>
                        </select>
                      </div>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label>N° DOC</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" title="Ingresar Número de documento" value="<?=$_POST['numero'];?>"  onkeypress="if(event.keyCode == '13'){this.form.submit();return false;}" name="numero" id="numero" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                          <select name="estado" id="estado">
                          <option <?php if($_POST['estado']=='--'){?>selected="selected"<?php } ?> value="--">TOOOS</option>
                          <option <?php if($_POST['estado']=='1'){?>selected="selected"<?php } ?>value="1">TERMINADOS</option>
                          <option <?php if($_POST['estado']=='0'){?>selected="selected"<?php } ?>value="0">PENDIENTES</option>

                          </select>
                      </div>
                      <div class="col-sm-8 col-xs-12">
                        <div class="row">
                          <div class="col-sm-6 col-xs-12">  
                            <button type="submit" class="btn btn-primary ">Buscar</button>
                          </div>
                          <div class="col-sm-6 col-xs-12">  
                            <button type="button" onclick="javascript:window.location='tracking.php'" class="btn btn-primary ">Limpiar</button>
                          </div>
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
                              <th><label><input name="allreg" type="checkbox" onclick="checktodo(this)" /></label></th>
                              <th>Cliente</th>
                              <th>Origen</th>
                              <th>Destino</th>
                              <th>Tipo</th>
                              <th>Documento</th>
                              <th>Modalidad</th>
                              <th>Monto</th>
                              <th>Fecha</th>
                              <th>Archivo</th>
                              <th>Estado</th>
                              <th>Opciones</th>

                          </tr>
                      </thead>
                      <tbody>
<?php
  
   $sqlPedido  = "select 
                          tk.fecha_inicio,tk.id,tk.cliente_id,tk.origen,tk.destino,tk.tipo_documento ,tk.ruc , tk.modalidad ,tk.moneda,tk.monto,tk.ctime,tk.archivo,tk.estado
                          from 
                              tracking tk , clientes c 
                          where 
                                tk.cliente_id = c.id  ".$filtro[1].$filtro[2].$filtro[3].$filtro[4].$filtro[5].$filtro[6].$filtro[7].$filtro[8].$filtro[9]." order by ".$campo." ".$order;  
  
  
  #################### Se envia el SQL en SESSION para el reporte en excel.                 
  ## SOLES
  $sql_reportSoles = "select 
              tk.fecha_inicio,tk.id,tk.cliente_id,tk.origen,tk.destino,tk.tipo_documento ,tk.ruc , tk.modalidad ,tk.moneda,tk.monto,tk.ctime,tk.archivo,tk.estado
            from 
                tracking tk , clientes c 
            where 
                moneda = 'S/.' and tk.cliente_id = c.id ".$filtro[1].$filtro[2].$filtro[3].$filtro[4].$filtro[5].$filtro[6].$filtro[7].$filtro[8].$filtro[9]." order by id desc";
  $_SESSION['SQL'] = $sql_reportSoles;
  ## DOLARES
  $sql_reportDolar = "select 
            tk.fecha_inicio,tk.id,tk.cliente_id,tk.origen,tk.destino,tk.tipo_documento ,tk.ruc , tk.modalidad ,tk.moneda,tk.monto,tk.ctime,tk.archivo,tk.estado
            from 
                tracking tk , clientes c 
            where 
                moneda = '$' and tk.cliente_id = c.id ".$filtro[1].$filtro[2].$filtro[3].$filtro[4].$filtro[5].$filtro[6].$filtro[7].$filtro[8].$filtro[9]." order by id desc";
  $_SESSION['SQL2'] = $sql_reportDolar;
  
  
  
  $query_menu = db_query($sqlPedido); 
  $total    = mysql_num_rows($query_menu);
  $pag        = $_POST['pg'];
  if ($pag=='') $pag = 1;
  $numPags    = ceil($total/VAR_NROITEMS);
  $reg      = ($pag-1) * VAR_NROITEMS;
  $rs       = db_query($sqlPedido ." LIMIT " .$reg.",".VAR_NROITEMS);


    if ($total  == '0'){ 

     echo "<tr ><td class='tdrow1' colspan='12' align='center' height='30'>No se encontr pedidos registrados</td></tr>";


  }else{  

  while ( $rowPedido = mysql_fetch_array($rs)){       

      $estado=($rowPedido['estado']=='1')?"fa-check":"fa-times";
      $title  = ($rowPedido['estado']=='1')?"Activado":"Desactivado";
      //  obtener cliente
      $row_usuario = mysql_fetch_array(db_query("select * from clientes where id = '".$rowPedido['cliente_id']."' "));
      //  obtener modalidad
      $modalidad = mysql_fetch_array(db_query("select * from modalidades where id = '".$rowPedido['modalidad']."' "));
      

    ?>
  


                          <tr>
                              <td><label><input name="id[<?=$rowPedido['id']?>]" type="checkbox" value="<?=$rowPedido['id']?>" /></label></td>
                              <td><b><?php echo $row_usuario['nombres'];?></b></td>
                              <td><?php echo utf8_encode($rowPedido['origen']);?></td>
                              <td><?php echo $rowPedido['destino'];?></td>
                              <td><?php echo $rowPedido['tipo_documento'];?></td>
                              <td><?php echo $rowPedido['ruc'];?></td>
                              <td><?php echo $modalidad['nombres'];?></td>
                              <td><b><? echo $rowPedido['moneda']." ".$rowPedido['monto'];?></b></td>
                              <td><?php echo $rowPedido['ctime'];?></td>
                              <td class="text-center"><a href="../img/documentos/<?php echo $rowPedido['archivo'];?>" target="_blank">Descargar</a></td>
                              <td class="text-center"><a href="tracking.php?id_mod=<?php echo $rowPedido['id'];?>" title="Cambiar Estado"><i class="fa fa-fw <?php echo $estado;?> fa-2x"></i></a></td>
                              <td class="action text-center">
                                
                                <a title="Editar" href="trackingEditar.php?id_tracking=<?php echo $rowPedido['id'];?>"><i class="fa fa-fw fa-edit fa-2x"></i></a>

                                <a title="Eliminar" onclick="willSubmit=confirm('&iquest;Esta seguro de eliminar este registro?'); return willSubmit;" href="tracking.php?id_del=<?php echo $rowPedido['id'];?>"><i class="fa fa-fw fa-trash-o fa-2x"></i></a>

                              </td>
                          </tr>
<?php     
   
    } // while 

  } //else  
?>
      <?php 

    if($total > 0){

    ?>
        <tr>
        <td  height="25" colspan="12"><?php include "sisweb_incpaginacion.php"; ?></td>
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
              <p><a href="rpt_xls_tracking.php" target="_blank">Reporte en Excel <img src="img/i-excel.png" alt=""></a></p>
            </div>
          </div>  
        </div>
        <div class="excel">
          <div class="row">
            <div class="col-sm-2 col-xs-12">
              <button type="button" onclick="javascript:window.location='panel.php'" class="btn btn-primary ">Atras</button>
            </div>
          </div>  
        </div>  
      </div>
    </form>
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

<!-- Calendar-->
<script src="plugins/calendar/bootstrap-datepicker.js"></script>
<script type="text/javascript">
   $(function() {
      $('#fechaRegistro').datepicker({format: "yyyy-mm-dd" });  
      $('#fechaFin').datepicker({format: "yyyy-mm-dd" });  
   });
</script>
</body>
</html>
