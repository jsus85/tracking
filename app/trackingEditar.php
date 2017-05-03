<?php
session_start();
include('models/basedatos.php');
include('models/funciones.php');
include('controllers/tracking.php');
include('models/estado_usuario.php');

$rowentrega = mysql_fetch_array(mysql_query("select * from tracking where id = '".mysql_real_escape_string($_GET['id_tracking'])."' "));
  $rowcliente = mysql_fetch_array(mysql_query("select * from clientes where id = '".$rowentrega['cliente_id']."' "));

  // UBIGEO ORIGEN
  $rowUbigeo = mysql_fetch_array(db_query("select dpto,prov,dist from ubigeo where id = '".$rowentrega['origen_ubigeo']."' "));
  
  // UBIGEO DESTINO
  $rowUbigeo2 = mysql_fetch_array(db_query("select dpto,prov,dist from ubigeo where id = '".$rowentrega['destino_ubigeo']."' "));

  // EMPLEADO
  $rowEmpleado = mysql_fetch_assoc(db_query("select * from empleados where id = '".$rowentrega['empleado_id']."' "));
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
            <div class="row">
              <div class="col-sm-8 col-xs-12">
                <h2>GESTIÓN DE ENTREGAS</h2>
              </div>
              <div class="col-sm-4 col-xs-12 pull-right">
                <div class="select-op">
                  <div class="row">
                    
                  </div>
                </div>  
              </div> 
            </div>
          </div>
        </div>
      </div>  
      <div class="app-body">

        <form name='formpdetalle' id="formpdetalle" method='post' action=''>
        <input name="id_tracking" id="id_tracking" type="hidden" value="<?=$_GET['id_tracking'];?>" />
          <!-- Panel Admin -->
          <div class="panel-adm">
            <div class="sec-title-gray">
              <div class="row">
                <div class="col-xs-12">
                  <span>DATOS CLIENTE</span>
                </div>
              </div>
            </div> 
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>BUSCAR CLIENTE</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <?php echo $rowcliente['nombres'];?>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>E-MAIL</label>
                        </div>
                        <div class="col-sm-9 col-xs-12" id="HTML-email">
                          <?php echo $rowcliente['email'];?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>TELÉFONOS</label>
                        </div>
                        <div id="HTML-telefonos" class="col-sm-9 col-xs-12">
                          <?php echo $rowcliente['telefonos'];?>
                        </div>
                    </div>
                  </div>                        
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12" >
                          <label>DNI</label>
                        </div>
                        <div class="col-sm-9 col-xs-12" id="HTML-dni">
                        <?php echo $rowcliente['dni'];?>
                        </div>
                      </div>
                  </div>  
                </div>
            </div>

            <div class="sec-title-gray">
              <div class="row">
                <div class="col-xs-12">
                  <span>DETALLE DEL TRACKING</span>
                </div>
              </div>
            </div>

            <div class="row">

                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">                            
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>DOCUMENTO</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <select name="documento" id="documento" style="width:50%">
                            <option <?php if($rowentrega['tipo_documento']=='Factura'){?> selected="selected" <?php } ?> value="Factura">Factura</option>
                              <option <?php if($rowentrega['tipo_documento']=='Boleta'){?> selected="selected" <?php } ?> value="Boleta">Boleta</option>
                              <option<?php if($rowentrega['tipo_documento']=='guia-remision'){?> selected="selected" <?php } ?> value="guia-remision">Guía de remisión</option>
                          </select>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>N° DOCUMENTO</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <input type="text" value="<?=$rowentrega['ruc'];?>"  name="ruc" id="ruc" class="form-control" placeholder="">
                        </div>
                      </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>MONTO</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <div class="row">
                            <div class="col-sm-3 col-xs-12">
 

                                <select name="moneda" class="form-control " id="moneda">
                                <option <?php if($rowentrega['moneda']=='S/.'){?> selected="selected" <?php } ?> value="S/.">S/.</option>
                               <option <?php if($rowentrega['moneda']=='$'){?> selected="selected" <?php } ?> value="$">$</option>

                                </select>

                            </div>
                            <div class="col-sm-9 col-xs-12">
                              <input type="text" id="monto" name="monto" value="<?=$rowentrega['monto'];?>" class="form-control mar-tb" placeholder="">
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>MODALIDAD</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">

                        <select  class="form-control"  name="modalidad" id="modalidad">
                        <?php 
                        $rs_modalidad = mysql_query("select * from modalidades order by nombres asc");
                        while($rw_modalidad = mysql_fetch_array($rs_modalidad)){
                        ?>
                        <option <?php if($rowentrega['modalidad']==$rw_modalidad['id']){?> selected="selected" <?php } ?> value="<?=$rw_modalidad['id'];?>">
                        <?php echo $rw_modalidad['nombres'];?>
                        </option>
                        <?php
                        }// End if modalidad
                        ?>
                        </select>


                        </div>
                    </div>
                  </div>  
                </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="sec-title-oran">
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        ORIGEN
                      </div>
                    </div>
                  </div>
                <div class="box-ora">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                      
                      <select class="form-control mar-tb"  onchange="show_provincia(this.value);" name="departemento" id="departemento">
                      <?php 
                      $rs_OrigenUbigeo = db_query("select * from ubigeo where  prov= '00' and dist= '00' order by nombre asc");
                      ?>
                      <option value="--">[Departamento]</option>
                      <?
                      while($rw_OrigenUbigeo = mysql_fetch_array($rs_OrigenUbigeo)){
                      ?>
                      <option <?php if($rw_OrigenUbigeo['dpto'] == $rowUbigeo['dpto']){?> selected="selected"<?php } ?> value="<?php echo $rw_OrigenUbigeo['dpto']?>"><?php echo $rw_OrigenUbigeo['nombre']?></option>
                      <?php }?>

                      </select>


                      </div>
                      

                      <div class="col-sm-4 col-xs-12" id="Ajx_provincia">
                        
                      <?php 
                      // PROVINCIAS
                      $sql_prov = "select prov as codigo,nombre ,prov
                            from
                               ubigeo 
                            where 
                              dpto = '".$rowUbigeo['dpto']."' and prov<>'00' 
                              and dist='00'";
                      $rs_prov  = db_query($sql_prov) or die(mysql_error());    
                      ?>
                      <select class="form-control mar-tb" name="provincia" id="provincia">
                      <option value="--">Provincia</option>
                      <?php while($rw_prov = mysql_fetch_array($rs_prov)){?>  
                      <option <?php if($rowUbigeo['prov'] == $rw_prov['prov']){?> selected="selected"<?php } ?> value="<?=$rw_prov['codigo']?>">
                        <?php echo utf8_encode($rw_prov['nombre']);?></option>
                      <?php }// WHILE?>       
                      </select>


                      </div>



                      <div id="Ajx_distrito" class="col-sm-4 col-xs-12">
                         

                      <?php 
                      $sql_distrito = "select 
                      dist as codigo,nombre, id ,dist
                      from 
                      ubigeo 
                      where 
                      dpto='".$rowUbigeo['dpto']."' and prov='".$rowUbigeo['prov']."' and dist<>'00'";
                      $rs_distrito = db_query($sql_distrito);                           
                      ?>      
                      <select name="distrito" class="form-control mar-tb" id="distrito">
                      <option value="--">Distrito</option>
                      <?php while($rw_distrito = mysql_fetch_array($rs_distrito)){?>  
                      <option <?php if($rowUbigeo['dist'] == $rw_distrito['dist']){?> selected="selected"<?php } ?> value="<?=$rw_distrito['id']?>"><?=$rw_distrito['nombre']?></option>
                      <?php }// WHILE?> 
                      </select>  
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">DIRECCIÓN</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" id="origen" name="origen" value="<?php echo $rowentrega['origen'];?>" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">FECHA DE INICIO</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" name="fechaRegistro"  value="<?php echo $rowentrega['fecha_inicio'];?>"  id="fechaRegistro"  class="form-control" placeholder="">
                      </div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">HORA DE SALIDA</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" id="hora_salida" name="hora_salida" value="<?php echo $rowentrega['hora_salida'];?>" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>   
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="sec-title-oran">
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        DESTINO
                      </div>
                    </div>
                  </div>
                <div class="box-ora">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4 col-xs-12">
                        

                        <select class="form-control mar-tb"  onchange="show_provincia2(this.value);" name="departemento2" id="departemento2">
                        <?php 
                        $rs_OrigenUbigeo = db_query("select * from ubigeo where  prov= '00' and dist= '00' order by nombre asc");
                        ?>
                        <option value="--">[Departamento]</option>
                        <?
                        while($rw_OrigenUbigeo = mysql_fetch_array($rs_OrigenUbigeo)){
                        ?>
                        <option <?php if($rw_OrigenUbigeo['dpto']==$rowUbigeo2['dpto']){?> selected="selected"<?php } ?> value="<?php echo $rw_OrigenUbigeo['dpto']?>"><?php echo $rw_OrigenUbigeo['nombre']?></option>
                        <?php }?>

                        </select>
                      </div>
                      

                      <div id="Ajx_provincia2" class="col-sm-4 col-xs-12">

                        <?php 
                        // PROVINCIAS 2
                        $sql_prov = "select prov as codigo,nombre ,prov
                        from
                        ubigeo 
                        where 
                        dpto = '".$rowUbigeo2['dpto']."' and prov<>'00' 
                        and dist='00'";
                        $rs_prov  = db_query($sql_prov) or die(mysql_error());    
                        ?>      

                        <select name="provincia2" id="provincia2" class="form-control mar-tb">
                        <option value="--">Provincia</option>
                        <?php while($rw_prov = mysql_fetch_array($rs_prov)){?>  
                        <option <?php if($rowUbigeo2['prov'] == $rw_prov['prov']){?> selected="selected"<?php } ?> value="<?=$rw_prov['codigo']?>"><?=$rw_prov['nombre']?></option>
                        <?php }// WHILE?>       
                        </select>   



                      </div>
                      <div id="Ajx_distrito2" class="col-sm-4 col-xs-12">
                        <?php 
                        $sql_distrito = "select 
                        dist as codigo,nombre, id ,dist
                        from 
                        ubigeo 
                        where 
                        dpto='".$rowUbigeo2['dpto']."' and prov='".$rowUbigeo2['prov']."' and dist<>'00'";
                        $rs_distrito = db_query($sql_distrito);                           
                        ?>      
                        <select name="distrito2" id="distrito2" class="form-control mar-tb">
                        <option value="--">Distrito</option>
                        <?php while($rw_distrito = mysql_fetch_array($rs_distrito)){?>  
                        <option <?php if($rowUbigeo2['dist'] == $rw_distrito['dist']){?> selected="selected"<?php } ?> value="<?=$rw_distrito['id']?>"><?=$rw_distrito['nombre']?></option>
                        <?php }// WHILE?> 
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">DIRECCIÓN</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" id="destino" name="destino" value="<?php echo $rowentrega['destino'];?>" class="form-control" placeholder="Ingrese destino">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">FECHA DE LLEGADA</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="fecha_llegada" value="<?php echo $rowentrega['fecha_fin'];?>" name="fecha_llegada" placeholder="">
                      </div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for=""></label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                       
                      </div>
                    </div>
                  </div> 
                </div>
              </div>
            </div>


        <div class="sec-title-gray">
                      <div class="row">
                        <div class="col-xs-12">
                          <span>DETALLE DE ENTREGA</span>
                        </div>
                      </div>
                    </div>

            <div class="row">

                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">                            
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>HORA LLEGADA</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                          <?php echo $rowentrega['hora_llegada'];?>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>RECEPCIONADO POR:</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <?php echo $rowentrega['recepcionado'];?>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

        <div class="row">

                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">                            
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>COMENTARIO:</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <?php echo $rowentrega['comentario_entrega'];?>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">                            
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                          <label>EMPLEADO:</label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <?php echo $rowEmpleado['nombres'];?>
                        </div>
                    </div>
                  </div>
                </div>


      </div>




            <div class="sec-title-gray">
              <div class="row">
                <div class="col-xs-12">
                  <span>OPCIONES TRANCKING</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
<?php

                  $rs_opciones = db_query("select * from tracking_opciones ");
                  $tabla = "";

                  $i = 1;
                  while($rw_opciones = mysql_fetch_array($rs_opciones)){
                 
         
                  $rs2  = mysql_query("select * from tracking_opciones_detalle where tracking_opciones_id = '".$rw_opciones['id']."' and tracking_id = '".$_GET['id_tracking']."'");

                  $nro2 = mysql_num_rows($rs2);
                  $rw2 = "";
                 
                  if($nro2!='0'){
                   $rw2 = mysql_fetch_array($rs2);
                  }

?>


                    <div class="row">
                          <div class="col-sm-4 col-xs-2 text-right">
                          <label><input <?php if($nro2 == '1'){?> checked="checked" <?php } ?>  name="idopc2[]" type="checkbox" value="<?php echo $rw_opciones['id'];?>" /></label>
                          </div>
                          <div class="col-sm-4 col-xs-6">
                          <input size="30" class="txtbox" id="texto2<?php echo $rw_opciones['id'];?>" name="texto2<?php echo $rw_opciones['id'];?>" type="text" value="<?=$rw2['valor'];?>"  />
                          </div>

                          <div class='col-sm-4 col-xs-4'><?php echo utf8_encode($rw_opciones['nombres']);?></div>                    
                    </div>

<?php
                     $i++;
                  }

              
                  ?>
                </div>
              </div>
            </div>
            
            
                
           
            <div class="sec-title-gray">
              <div class="row">
                <div class="col-xs-12">
                  <span>HISTORIAL DE ENTREGA</span>
                </div>
              </div>
            </div>
            <!-- Basic Table -->
          <div class="panel panel-default">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>PRODUCTO</th>
                              <th>MODALIDAD</th>
                              <th>ORIGEN</th>
                              <th>FECHA</th>
                              <th>COMENTARIO</th>
                          </tr>
                      </thead>
                      <tbody>

 <?php 
 $rs_tracking_opciones = db_query("select * from tracking_detalle where tracking_id = '".$_GET['id_tracking']."' order by id asc ");
    $nro_registros      = mysql_num_rows($rs_tracking_opciones);
  ?>
      <input name="nro" type="hidden" value="<?php echo $nro_registros;?>" /> 
  <?  
  $j=1;
  while($rw_tracking_opciones = mysql_fetch_array($rs_tracking_opciones)){
  ?>
    <input name="id_track_opc<?=$j;?>" type="hidden" value="<?php echo $rw_tracking_opciones['id'];?>" />
  <tr>
    <td><input style="width:100%" value="<?php echo $rw_tracking_opciones['producto'];?>"   class="txtbox" type="text"  name="producto_<?=$j;?>" /></td>
    <td><input style="width:100%" value="<?php echo $rw_tracking_opciones['modalidad'];?>"  class="txtbox" type="text"  name="modalidad_<?=$j;?>" /></td>
    <td><input style="width:100%" value="<?php echo $rw_tracking_opciones['origen'];?>"   class="txtbox" type="text"  name="origen_<?=$j;?>" /></td>
    <td><input style="width:100%" value="<?php echo $rw_tracking_opciones['fecha'];?>"    class="txtbox" type="text"  name="fecha_<?=$j;?>" /></td>
    <td><input style="width:100%" value="<?php echo $rw_tracking_opciones['comentario'];?>" class="txtbox" type="text"  name="comentario_<?=$j;?>" /></td>
  </tr>
    <?php 
      $j++;
  } ?>

                    <tr id="new-imagen" ></tr>

                          
                      </tbody>
                  </table>
              </div>
          </div>
          <!-- End  Basic Table  -->
          <div class="form-group">
            <div class="btn-center">
              <div class="row">
                <div class="col-xs-12 ">  
                  <button type="button" onclick="addField()" class="btn btn-primary middle">Agregar Otra Fila</button>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="btn-opt">
                <div class="col-sm-6 col-xs-12">
                  <button type="button" onclick = "xajax_procesar_formularioEditar(xajax.getFormValues('formpdetalle'));" class="btn btn-primary middle">Aceptar</button>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <button type="button" onclick="javascript:window.location='tracking.php'" class="btn btn-primary middle">Cancelar</button>
                </div>
              </div>
            </div>
          </div>

   
      </div>
<input name="rowsnum" id="rowsnum" type="hidden" value="<?=$total;?>" />
      <input type="hidden" name="img" id="img" value="1" />
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

<!-- Suggest -->
<link rel="stylesheet" href="plugins/scripts/suggest/jsonSuggest.css" type="text/css" />
<script language="javascript" src="plugins/scripts/suggest/jquery.jsonSuggest.js"></script>
<script language="javascript" src="plugins/scripts/suggest/json2.js"></script>
<script language="javascript">



function callback(item) {
//  alert('You selected \'' + item.text + '\'\n\nHere is the full selected JSON object;\n' + JSON.stringify(item));
//  alert(item.id);
//  document.getElementById('servicio').value = item.id;

    jQuery.ajax({
    type: 'POST',
    url: 'AjxClientes.php',
    data: 'id_cliente='+item.id+'&accion=cliente',
    success: function(datos){
      cad = datos.split('*'); 
      if(cad[0]=='error'){
        alert(" * Error !!!!!");
      }else{
        jQuery('#HTML-email').html(cad[0]);   
        jQuery('#HTML-telefonos').html(cad[1]);   
        jQuery('#HTML-dni').html(cad[2]);   
        jQuery('#id_usuario').attr('value',cad[3]);                   
      }// ELSE
     }
   });  
  //window.location = item.text+'-'+item.id+'.html';

}

jQuery(function() {

  jQuery.getJSON("http://<?=$_SERVER['HTTP_HOST'];?>/alba/countryCodes.php",                                               
    function(data){
      jQuery('input#suggestBox3').jsonSuggest(data, {onSelect:callback,maxResults:20});
    }
  );

});

// Listado de COMBOS 1
function show_provincia(data){
    jQuery.ajax({
    type: 'POST',
    url: 'Ajx-lugar.php',
    data: 'departamento='+data+'&accion=provincia',
    success: function(datos){
      
       jQuery('#Ajx_provincia').html(datos);    
    
     }
   });    
}

function show_distrito(data){
    jQuery.ajax({
    type: 'POST',
    url: 'Ajx-lugar.php',
    data: 'provincia='+data+'&departamento='+jQuery('#departemento').val()+'&accion=distrito',
    success: function(datos){
      
       jQuery('#Ajx_distrito').html(datos);   
    
     }
   });    
}

// Listado de COMBOS 2
function show_provincia2(data){
    jQuery.ajax({
    type: 'POST',
    url: 'Ajx-lugar.php',
    data: 'departamento='+data+'&accion=provincia2',
    success: function(datos){     
       jQuery('#Ajx_provincia2').html(datos);   
    
     }
   });    
}

function show_distrito2(data){
    jQuery.ajax({
    type: 'POST',
    url: 'Ajx-lugar.php',
    data: 'provincia='+data+'&departamento='+jQuery('#departemento2').val()+'&accion=distrito2',
    success: function(datos){     
       jQuery('#Ajx_distrito2').html(datos);    
    
     }
   });    
}


</script>
<script type="text/javascript">
// agregar fila
function addField(){

  var num = parseInt(jQuery('#img').val());
    
    
    html = '<tr>';
    
    html += '<td><input style="width:100%" value="'+jQuery("#texto22").val()+'" class="txtbox" type="text"  name="producto_'+num+'" /></td>';

    html += '<td><input style="width:100%" value="'+jQuery('#modalidad option:selected').text()+'" class="txtbox" type="text"  name="modalidad_'+num+'" /></td>';
    
    html += '<td><input style="width:100%" value="'+jQuery("#origen").val()+'" class="txtbox" type="text"  name="origen_'+num+'" /></td>';
    html += '<td><input style="width:100%" value="<?=date("Y-m-d");?>" class="txtbox" type="text"  name="fecha_'+num+'" /></td>';
    
    html += '<td><input style="width:100%" value="" class="txtbox" type="text"  name="comentario_'+num+'" /></td>';
    
    html += '</tr>';
    
    jQuery('#new-imagen').before(html);
    jQuery('#img').val(num+1);
}

</script>
<!-- Calendar-->
<script src="plugins/calendar/bootstrap-datepicker.js"></script>
<script type="text/javascript">
   $(function() {
      $('#fechaRegistro').datepicker({format: "yyyy-mm-dd" });  
      $('#fecha_llegada').datepicker({format: "yyyy-mm-dd" });  

   });
</script>
</body>
</html>
