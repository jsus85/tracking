<?php
session_start();
include('models/basedatos.php');
include('models/funciones.php');
include('controllers/tracking.php');
include('models/estado_usuario.php');

if(isset($_POST['id_persona'])){

    $rowcliente = mysql_fetch_array(mysql_query("select * from clientes where id = '".$_POST['id_persona']."' "));
    exit;
  }

  $rowdia = date("Y-m-d");

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
        <input name="id_pedido" id="id_pedido" type="hidden" value="<?=$_GET['id_pedido'];?>" />
        <input name="HddMail" id="HddMail" type="hidden" value="<?=$rowUsuario['email'];?>" />
        <input name="id_usuario" id="id_usuario" type="hidden" value="" />
        <input name="id_persona" id="id_persona" type="hidden" value="<?=($_POST['id_persona'])?$_POST['id_persona']:'';?>" />
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
                          <input type="text" name="suggestBox3" id="suggestBox3" onkeypress="if(event.keyCode == '13'){return false;}"  class="form-control" placeholder="">
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
                            <option value="Factura">Factura</option>
                            <option value="Boleta">Boleta</option>
                            <option value="guia-remision">Gua de remisi&oacute;n</option>
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
                          <input type="text" onblur="xajax_comprobar_documento(this.value);" name="ruc" id="ruc" class="form-control" placeholder="">
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
                                <option value="S/.">S/.</option>
                                <option value="$">$</option>       
                                </select>

                            </div>
                            <div class="col-sm-9 col-xs-12">
                              <input type="text" id="monto" name="monto" class="form-control mar-tb" placeholder="">
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
                        <option value="<?=$rw_modalidad['id'];?>">
                        <?=$rw_modalidad['nombres'];?>
                        </option>
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
                  <option value="<?php echo $rw_OrigenUbigeo['dpto']?>"><?php echo $rw_OrigenUbigeo['nombre']?></option>
                  <?php }?>
                  </select>


                      </div>
                      

                      <div class="col-sm-4 col-xs-12" id="Ajx_provincia">
                        <select class="form-control mar-tb" id="provincia" name="provincia">
                         <option value="--">[Provincia]</option> 
                       </select>  
                      </div>



                      <div id="Ajx_distrito" class="col-sm-4 col-xs-12">
                        <select id="distrito" name="distrito" class="form-control mar-tb">
                        <option value="--">[Distrito]</option> 
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
                        <input type="text" id="origen" name="origen" class="form-control" placeholder="Ingrese Origen">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">FECHA DE INICIO</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" name="fechaRegistro" value="<?php echo date("Y-m-d");?>" id="fechaRegistro"  class="form-control" placeholder="">
                      </div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">HORA DE SALIDA</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" id="hora_salida" name="hora_salida" class="form-control" placeholder="">
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
                           <option value="<?php echo $rw_OrigenUbigeo['dpto']?>"><?php echo $rw_OrigenUbigeo['nombre']?></option>
                        <?php }?>
                        </select>
                      </div>
                      

                      <div id="Ajx_provincia2" class="col-sm-4 col-xs-12">
                        <select id="provincia2" name="provincia2" class="form-control mar-tb">
                               <option value="--">[Provincia]</option>    
                        </select>  
                      </div>
                      <div id="Ajx_distrito2" class="col-sm-4 col-xs-12">
                        <select name="distrito2" id="distrito2" class="form-control mar-tb"> 
                          <option value="--">[Ditrito]</option>
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
                        <input type="text" id="destino" name="destino" class="form-control" placeholder="Ingrese destino">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <label for="">FECHA DE LLEGADA</label>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="fecha_llegada" name="fecha_llegada" placeholder="">
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
                 
         

                  $tabla .= "
                    <div class='row'>
                          <div class='col-sm-4 col-xs-2 text-right'>
                          <label><input name='idopc2[]' type='checkbox' value='".$rw_opciones['id']."' /></label>
                          </div>
                          <div class='col-sm-4 col-xs-6'>
                          <input size='30' class='txtbox' id='texto2".$rw_opciones['id']."' name='texto2".$rw_opciones['id']."' type='text' value='' />
                          </div>

                          <div class='col-sm-4 col-xs-4'>
                          ".utf8_encode($rw_opciones['nombres'])."
                          </div>                    
                    </div>";


                     $i++;
                  }

                  echo $tabla;
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

                 <center> <span id="mensaje"></span></center>
              <div class="btn-opt">

                <div class="col-sm-6 col-xs-12">


                  <button type="button" onclick = "xajax_procesar_formulario(xajax.getFormValues('formpdetalle'));" class="btn btn-primary middle">Aceptar</button>
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

  jQuery.getJSON("http://<?=$_SERVER['HTTP_HOST'];?>/alba/app/countryCodes.php",                                               
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
