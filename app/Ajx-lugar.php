<?php
	include("models/basedatos.php");

	if(isset($_POST['accion'])){
		
		if($_POST['accion']=='provincia'){	
		
			$sql_prov = "select prov as codigo,nombre 
														from
															 ubigeo 
														where 
															dpto = '".$_POST['departamento']."' and prov<>'00' 
															and dist='00'";
			$rs_prov  = db_query($sql_prov) or die(mysql_error());
?>	
	 <select id="provincia" name="provincia" class="form-control mar-tb" onChange="show_distrito(this.value);">		
     <option value="--">[Provincia]</option>   	
<?php	
	while($rw_prov = mysql_fetch_array($rs_prov)){?>	
	<option value="<?=$rw_prov['codigo']?>"><?php echo utf8_encode($rw_prov['nombre']);?></option>
<?php	}// WHILE?>	
		</select>		
<?php
			}else if($_POST['accion']=='distrito'){// IF
			
			$sql_distrito = "select 
									dist as codigo,nombre, id 
														from 
															ubigeo 
														where 
															dpto='".$_POST['departamento']."' and prov='".$_POST['provincia']."' and dist<>'00'";
			
			$rs_distrito  = db_query($sql_distrito) or die(mysql_error());
			?>
				<select id="distrito" name="distrito" class="form-control mar-tb">		
				<option value="--">[Distrito]</option>   	
				<?php	while($rw_distrito = mysql_fetch_array($rs_distrito)){?>	
				<option value="<?=$rw_distrito['id']?>"><?=$rw_distrito['nombre']?></option>
				<?php	}// WHILE?>	
				</select>	
            
           <? } else if($_POST['accion']=='provincia2'){	
		
			$sql_prov = "select prov as codigo,nombre 
														from
															 ubigeo 
														where 
															dpto = '".$_POST['departamento']."' and prov<>'00' 
															and dist='00'";
			$rs_prov  = db_query($sql_prov) or die(mysql_error());
?>	
	 <select id="provincia2" name="provincia2" class="form-control mar-tb" onChange="show_distrito2(this.value);">		
     <option value="--">[Provincia]</option>   	
<?php	while($rw_prov = mysql_fetch_array($rs_prov)){?>	
	<option value="<?=$rw_prov['codigo']?>"><?php echo utf8_encode($rw_prov['nombre']);?></option>
<?php	}// WHILE?>	
		</select>		
<?php
			}else if($_POST['accion']=='distrito2'){// IF
			
			$sql_distrito = "select 
									dist as codigo,nombre, id 
														from 
															ubigeo 
														where 
															dpto='".$_POST['departamento']."' and prov='".$_POST['provincia']."' and dist<>'00'";
			
			$rs_distrito  = db_query($sql_distrito) or die(mysql_error());
			?>
				 <select id="distrito2" class="form-control mar-tb" name="distrito2">		
     <option value="--">[Distrito]</option>   	
<?php	while($rw_distrito = mysql_fetch_array($rs_distrito)){?>	
	<option value="<?=$rw_distrito['id']?>"><?php echo utf8_encode($rw_distrito['nombre']);?></option>
<?php	}// WHILE?>	
		</select>	
            
           <? } // IF
	}// IF
?>