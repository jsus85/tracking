<?php
	session_start();
	include "models/basedatos.php";
	include "models/funciones.php";
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=usuarios_".date('Y-m-d').".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<b>REPORTE USUARIOS</b>
<table width="100%" border="0">
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="28%"><b>Nombres</b></td>
    <td align="center" width="10%"><b>Condici&oacute;n</b></td>
    <td align="center" width="7%"><b>Clave</b></td>
    <td align="center" width="12%"><b>RUC</b></td>
    <td  align="center" width="12%"><b>E-mail</b></td>
    <td width="11%" align="center"><b>Fecha</b></td>
  </tr>
<?php   	
	
	$rs_pedido = mysql_query($_SESSION['SQL_USUARIOS']);
	
  	while( $rowPedido = mysql_fetch_array($rs_pedido)){ 	
	
?>
		
  <tr>
    <td><?=$rowPedido['nombres'];?></td>
    <td align="center"><?=($rowPedido['condicion']=='N')?'Natural':'Jurídico'?></td>
    <td align="center"><?=$rowPedido['clave'];?></td>
    <td align="center"><?=$rowPedido['ruc'];?></td>
    <td align="center"><?=$rowPedido['email'];?></td>
    <td align="center"><?=$rowPedido['ctime'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<br />
