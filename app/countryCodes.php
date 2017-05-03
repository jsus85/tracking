<?php 	
session_start();
include "models/basedatos.php";
include "models/estado_usario.php";
?>
[
<?php
  	$rslocal = db_query("select * from clientes order by nombres asc");
	$nro = mysql_num_rows($rslocal);
	$i=1;
	while($rwlocal = mysql_fetch_array($rslocal)){
		$precio = "";		
?>
{"id":"<?=$rwlocal['id'];?>","text":"<?=utf8_encode($rwlocal['nombres']);?>","extra":"<?=$precio;?>"}	<?php if($i!=$nro){?>,<?php } ?>
<?php 
		$i++;
	} 
?>
] 