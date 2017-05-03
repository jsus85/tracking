<?php
	session_start();
	include "models/basedatos.php";
	include "models/funciones.php";
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=tracking_".date('Y-m-d').".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<b>REPORTE MONEDA SOLES</b><br /><br />


<table width="100%" border="1" bordercolor="#D3C9C9" cellpadding="3" cellspacing="3">
  <tr bgcolor="#EBEBEB">
    <td width="28%"><b>Cliente</b></td>
    <td align="center" width="10%"><b>Origen</b></td>
    <td align="center" width="7%"><b>Destino</b></td>
    <td align="center" width="12%"><b>Tipo Documento</b></td>
    <td  align="center" width="12%"><b>N. Documento</b></td>
    <td align="center" width="10%"><b>Modalidad</b></td>
    <td width="11%" align="center"><b>Fecha Salida</b></td>
    <td width="11%" align="center"><b>Fecha Llegada</b></td>    
    <td align="center" width="10%"><b>Monto</b></td>
  </tr>
<?php   	
	
	$rs_pedido = mysql_query($_SESSION['SQL']);
	$suma = 0;
  	while( $rowPedido = mysql_fetch_array($rs_pedido)){ 	
	$suma +=$rowPedido['monto']; 
	
?>
		<?php 
		$row_usuario = mysql_fetch_array(db_query("select * from clientes where id = '".$rowPedido['cliente_id']."' "))
		?>
  <tr>
    <td><?=$row_usuario['nombres'];?></td>
    <td align="center"><?=$rowPedido['origen'];?></td>
    <td align="center"><?=$rowPedido['destino'];?></td>
    <td align="center"><?=$rowPedido['tipo_documento'];?></td>
    <td align="center"><?=$rowPedido['ruc'];?></td>
    <td align="center"><?php
		$rowmodalidades = mysql_fetch_array(db_query("select * from modalidades where id = '".$rowPedido['modalidad']."' "));
    	echo $rowmodalidades['nombres']	;
	?></td>
    <td align="center"><?=$rowPedido['fecha_inicio'];?></td>
    <td align="center"><?=$rowPedido['fecha_fin'];?></td>    
    <td align="center"><?=$rowPedido['moneda']." ".$rowPedido['monto'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b>MONTO:</b></td>
    <td align="center"><b>S/. <?php echo $suma;?></b></td>
  </tr>
</table>
<br />
<b>REPORTE MONEDA DOLARES</b><br /><br />


<table width="100%" border="1" bordercolor="#D3C9C9" cellpadding="3" cellspacing="3">
  <tr bgcolor="#EBEBEB">
    <td width="28%"><b>Cliente</b></td>
    <td align="center" width="10%"><b>Origen</b></td>
    <td align="center" width="7%"><b>Destino</b></td>
    <td align="center" width="12%"><b>Tipo Documento</b></td>
    <td  align="center" width="12%"><b>N. Documento</b></td>
    <td align="center" width="10%"><b>Modalidad</b></td>
    <td width="11%" align="center"><b>Fecha Salida</b></td>
    <td width="11%" align="center"><b>Fecha Llegada</b></td>    
    <td align="center" width="10%"><b>Monto</b></td>
  </tr>
<?php   	
	$rs_pedido = mysql_query($_SESSION['SQL2']);
	$suma = 0;
  	while( $rowPedido = mysql_fetch_array($rs_pedido)){ 	
	$suma +=$rowPedido['monto']; 
	
?>
		<?php 
		$row_usuario = mysql_fetch_array(db_query("select * from clientes where id = '".$rowPedido['cliente_id']."' "))
		?>
  <tr>
    <td><?=$row_usuario['nombres'];?></td>
    <td align="center"><?=$rowPedido['origen'];?></td>
    <td align="center"><?=$rowPedido['destino'];?></td>
    <td align="center"><?=$rowPedido['tipo_documento'];?></td>
    <td align="center"><?=$rowPedido['ruc'];?></td>
    <td align="center"><?php
		$rowmodalidades = mysql_fetch_array(db_query("select * from modalidades where id = '".$rowPedido['modalidad']."' "));
    	echo $rowmodalidades['nombres']	;
	?></td>
    <td align="center"><?=$rowPedido['fecha_inicio'];?></td>
    <td align="center"><?=$rowPedido['fecha_fin'];?></td>
    <td align="center"><?=$rowPedido['moneda']." ".$rowPedido['monto'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td align="right"><b>MONTO</b></td>
    <td align="center"><b>$ <?php echo $suma;?></b></td>
  </tr>
</table><br />

<center><img src="http://alba.com.pe/imagenes/generales/logo.png" /></center>