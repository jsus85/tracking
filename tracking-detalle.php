<?php 
session_start();
include("app/models/basedatos.php");
include("app/models/funciones.php");

  if($_POST['documento']=='usuario'){ 

    $rowcliente  = mysql_fetch_array(mysql_query("select * from clientes where clave = '".mysql_real_escape_string($_POST['factura'])."' "));   
    $rowtracking = mysql_fetch_array(mysql_query("select * from tracking where cliente_id = '".$rowcliente['id']."' order by id desc  "));  
    // obtener 
    
  }else{    
  
    $rowtracking = mysql_fetch_array(mysql_query("select * from tracking where ruc = '".mysql_real_escape_string($_POST['factura'])."' and
                                          tipo_documento = '".$_POST['documento']."' ")); 
    $rowcliente  = mysql_fetch_array(mysql_query("select * from clientes where id = '".$rowtracking['cliente_id']."' "));   
  
  
  } // ELSE
  
  
  // CALL ORIGEN 
  $rowOrigenUbigeo = mysql_fetch_array(db_query("select dpto,prov,dist from ubigeo where id = '".$rowtracking['origen_ubigeo']."' "));  
  $departamento = mysql_fetch_array(db_query("select nombre from ubigeo where dpto = '".$rowOrigenUbigeo['dpto']."' and  prov= '00' and dist= '00' order by nombre asc"));
  $provincia   =  mysql_fetch_array(db_query("select nombre from ubigeo where                               dpto = '".$rowOrigenUbigeo['dpto']."' and prov='".$rowOrigenUbigeo['prov']."'                               and dist='00'"));
  $distrito    = mysql_fetch_array(db_query("select * from ubigeo                           where   dpto='".$rowOrigenUbigeo['dpto']."' and prov='".$rowOrigenUbigeo['prov']."' and dist='".$rowOrigenUbigeo['dist']."'")); 

  // CALL DESTINO
  $rowDestinoUbigeo = mysql_fetch_array(db_query("select dpto,prov,dist from ubigeo where id = '".$rowtracking['destino_ubigeo']."' "));  
  $departamento2 = mysql_fetch_array(db_query("select nombre from ubigeo where dpto = '".$rowDestinoUbigeo['dpto']."' and  prov= '00' and dist= '00' order by nombre asc"));
  $provincia2   =  mysql_fetch_array(db_query("select nombre from ubigeo where                              dpto = '".$rowDestinoUbigeo['dpto']."' and prov='".$rowDestinoUbigeo['prov']."'                               and dist='00'"));
  $distrito2    = mysql_fetch_array(db_query("select *  from ubigeo                           where   dpto='".$rowDestinoUbigeo['dpto']."' and prov='".$rowDestinoUbigeo['prov']."' and dist='".$rowDestinoUbigeo['dist']."'")); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Transportes Alva</title>
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

</head>
<body class="hold-transition">
  <header>
    <div class="col-sm-6" style="top: 60px;">
      <a href="index.html"><img src="app/img/logo.png" alt=""></a>
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
            <a href="#"><img src="app/img/trackin.jpg" alt=""></a>
          </div>
          <div class="col-xs-12 col-sm-6">
            <a href="index.php"><img src="app/img/cotizacion.jpg" alt=""></a>
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
             <li><a href="acceso.php"><b>Acceso Personal</b></a></li>
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
      <!-- <div class="cont-right"> -->
        

        <div class="row">
<?php 
      $rs_menu = db_query("select tp.id,tp.nombres from 
                      tracking_menu_opciones tmopc , tracking_opciones tp
                where 
                    posicion = 'UP' and  
                    tmopc.tracking_opciones_id = tp.id order by tmopc.orden asc");
    
    while($rw_menu = mysql_fetch_array($rs_menu)){
      
      $rowdetalle = mysql_fetch_array(mysql_query("select * from tracking_opciones_detalle where tracking_id = '".$rowtracking['id']."' and tracking_opciones_id = '".$rw_menu['id']."' "));
      
      if($rowdetalle['valor']!=''){

?>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12 col-sm-5">
                  <?php echo utf8_encode($rw_menu['nombres']);?>:
                </div>
                <div class="col-xs-12 col-sm-7">
                  <b><?php echo strtoupper(utf8_encode($rowdetalle['valor']));?></b>
                </div>
              </div>
            </div>
          </div>  
<?php 
      
      }// IF

    }// while ?>

        </div>



        <div class="row">
          <div class="modalidad">
            <div class="col-xs-12 col-sm-3">
                <div class="lugar">
                  <?php echo $departamento['nombre'];?> / <?php echo $provincia['nombre'];?>
                  <?php echo $distrito['nombre']?>
                </div>
                <div class="fecha">
                  <p><?php echo $rowtracking['fecha_inicio'];?></p>
                  <span>
                    <?php echo $rowtracking['hora_salida'];?>
                  </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 text-center">
              <div class="mod">
<?php 
          $modalidad = mysql_fetch_array(db_query("select * from modalidades where id = '".$rowtracking['modalidad']."' "));

?>
                <p>MODALIDAD</p>
                <p><img  src="modalidades/<?=$modalidad['imagen']?>" /></p>
                <span></span>
                
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="lugar">
                  <?php echo $departamento2['nombre'];?> /
                  <?php echo $provincia2['nombre'];?> /
                  <?php echo $distrito2['nombre']?>
                </div>
                <div class="fecha">
                  <p><?php echo $rowtracking['fecha_fin'];?></p>
                  <span><?php echo $rowtracking['hora_llegada'];?></span>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="recepcion">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 col-sm-4">
                    <label for="">Recepcionado por :</label>
                  </div>
                  <div class="col-xs-12 col-sm-8">
                    <?php echo $rowtracking['recepcionado'];?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 col-sm-4">
                    <label for="">Detalle de la entrega : </label>
                  </div>
                  <div class="col-xs-12 col-sm-8">
                    <?=$rowtracking['comentario_entrega'];?>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 col-sm-4">
                    <label for="">Ver Archivo : </label>
                  </div>
                  <div class="col-xs-12 col-sm-8">
                    <a target="_blank" href="img/documentos/<?=$rowtracking['archivo'];?>">Descargar</a>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                  <th>producto</th>
                  <th>modalidad</th>
                  <th>origen</th>
                  <th>fecha</th>
                  <th>comentario</th>
              </tr>
            </thead>
            <tbody>

<?php 
    $rs_tracking_opciones = db_query("select * from tracking_detalle where tracking_id = '".$rowtracking['id']."' order by id asc ");
    while($rw_tracking_opciones = mysql_fetch_array($rs_tracking_opciones)){
  ?>          
        <tr>          
          <td><?php echo $rw_tracking_opciones['producto'];?></td>
          <td><?php echo $rw_tracking_opciones['modalidad'];?></td>
          <td><?php echo $rw_tracking_opciones['origen'];?></td>
          <td><?php echo $rw_tracking_opciones['fecha'];?></td>
          <td><?php echo $rw_tracking_opciones['comentario'];?></td>            
        </tr>
  <?php }?> 

            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-sm-2 col-xs-12">
            <button type="button" class="btn btn-primary " onclick="javascript:window.location='index.php'">Atras</button>
          </div>
        </div>
      <!-- </div> -->
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
