<?
//*************** letras
function validar_amigable($cadena)
{	if(ereg("^[a-zA-Z0-9\_\-]+$",$cadena))	return true;
	else 								return false;
}

function validar_letras($cadena)
{	if(ereg("^[a-zA-ZáéíóúñÑ\ ]+$",$cadena))	return true;
	else 								return false;
}
function validar_letrasbd($cadena)
{	if(ereg("^[a-zA-Z0-9\ \/]+$",$cadena))		return true;	
	else 							return false;
}
function validar_cadena($cadena)
{	if(ereg("^[a-zA-Z0-9\ ]+$",$cadena))	return true;	
	else 									return false;
}

// *************** numeros
function validar_alfanum($cadena)
{	if(ereg("^[a-zA-Z0-9áéíóúñÑ\@\_\,\.\:\ \?\-]+$",$cadena))	return true;
	else 								return false;
}


function validar_numero($cadena)
{	if(ereg("^[0-9]+$",$cadena))		return true;	
	else 							return false;
}
function validar_telefono($cadena)
{	if(ereg("^[0-9\(\)\-\ ]+$",$cadena))		return true;	
	else 							return false;
}


function validar_decimal($cadena)
{	if(ereg("^[0-9]+\.[0-9]+$",$cadena))		return true;	
	else 							return false;
}

function validar_rpm($cadena)
{	if(ereg("^#[0-9]+$",$cadena))		return true;	
	else 							return false;
}

// ****************************************

function tep_redirect($url)
{
	echo "<script language:javascript>";
	echo "window.location.href='".$url."';";
	echo "</script>";
}

function validar_fechaActual($fecha)
{	
	 $diaSistema=date('d');
	 $añoSistema=date('Y');
	 $mesSistema=date('m');
	
	 $anho= substr($fecha,0,4);
	 $mes = substr($fecha,5,2);
	 $dia = substr($fecha,8,2);
	
		
		if($añoSistema>$anho) 
			return false;	
		 
		else if($mesSistema>$mes)
			return false;	
		 
		else if($diaSistema>$dia  && $mesSistema==$mes)
			return false;
		else
			return true;
}	

function  comparar_fecha($fecha)
{
 	$diaSis=date('d'); 	$añoSis=date('Y'); 	$mesSis=date('m');
	
	$anho= substr($fecha,0,4);
	$mes = substr($fecha,5,2);
	$dia = substr($fecha,8,2);
		
	if($añoSis>$anho) 
	    return false;	
		 
	else if($mesSis>$mes)
		return false;	
		 
	else if($diaSis>$dia  && $mesSis==$mes)
		return false;	
	else 
		return true;
}	

function validar_fecha($cadena)
{	
	$anho= substr($cadena,0,4);
	$mes = substr($cadena,5,2);
	$dia = substr($cadena,8,2);
	if(!ereg("^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})+$",$cadena))	{	return false;	}
	else	{

		if($anho<1930 )  {		return false;	}
		else 			 {

	switch ($mes) { 
    		case '01': 
			        if($dia>=1 && $dia<=31) return true;
					else					 return false;
		    break; 
		    case '02': 
					if($anho%4==0 && $anho%100!=0 || $anho%400==0) 
					{	if($dia>=1 && $dia<=29)	return true;
						else						return false;
					}
					else 								
					{	if($dia>=1 && $dia<=28)	 return true;
						else					   	  	 return false;
					}
			break;
	 
    		case '03': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
			break; 
		
			case '04': 
        			if($dia>=1 && $dia<=30) return true;
					else					   return false;
			break; 	
		
			case '05': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
	        break; 		
		
			case '06': 
			        if($dia>=1 && $dia<=30) return true;
					else					   return false;
		    break; 
		
			case '07': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break; 	

			case '08': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
	        break; 	
		
			case '09': 
	 			   if($dia>=1 && $dia<=30) return true;
				   else					   return false;
	        break; 	
			
			case '10': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break; 	
		
			case '11': 
        			if($dia>=1 && $dia<=30) return true;
					else					   return false;
		   	break; 	
		
			case '12': 
			        if($dia>=1 && $dia<=31) return true;
					else					   return false;
		    break; 							
		 	} // switch
		}//else
	 } // else
	
}

function fecha_spanish($date){
	$date=substr($date,0,10);
	$date=split("-",$date);
	$month="Ene,Feb,Mar,Abr,May,Jun,Jul,Ago,Set,Oct,Nov,Dic";
	$month=split(",",$month);
	foreach($month as $key => $value){
		if(($key+1)==(int)$date[1]){
			$m=$value;
		}				
	}
	$y=substr($date[0],2);
	$d=$date[2];
	$date=$d." ".$m." ".$y;
	return $date;	
}	


function validar_passwd($cadena)
{	if(ereg("^[a-zA-Z0-9]+$",$cadena))	return true;
	else 								return false;
}

function validar_email($address)
{	if(ereg("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-\.]+$",$address))		return true;
	else		return false;
}
function comprobar_email($email){ 
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 

          //miro si tiene caracter . 

          if (substr_count($email,".")>= 1){ 

             //obtengo la terminacion del dominio 
             $term_dom = substr(strrchr ($email, '.'),1); 

             //compruebo que la terminaci?n del dominio sea correcta 
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 

                //compruebo que lo de antes del dominio sea correcto 
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 

                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 

                if ($caracter_ult != "@" && $caracter_ult != "."){ 
                   $mail_correcto = 1; 
                } 

             } 

          } 

       } 

    } 
    if ($mail_correcto) 
       return 1; 
    else 
       return 0; 
} 

function validar_nick($cadena)
{	if(ereg("^[a-zA-Z0-9\_]+$",$cadena))		return true;	
	else 									return false;
}
function validar_alfanumerico($cadena)
{	if(ereg("^[a-zA-Z0-9\_]+$",$cadena))		return true;	
	else 									return false;
}



function validar_web($cadena)
{	if(ereg("^www.[a-zA-Z0-9\_\.]+$",$cadena))		return true;	
	else 							return false;
}

function validar_pagweb($cadena)
{	if(ereg("^[a-zA-Z0-9\_\.]+$",$cadena))		return true;	
	else 							return false;
}


	function restaFechas($dFecIni, $dFecFin = "")
	{
	$dFecFin = (empty($dFecFin))?date("d-m-Y"):$dFecFin; 
	
		$dFecIni = str_replace("-","",$dFecIni);
		$dFecIni = str_replace("/","",$dFecIni);
		$dFecFin = str_replace("-","",$dFecFin);
		$dFecFin = str_replace("/","",$dFecFin);
		
		ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
		ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);
		
		$date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
		$date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);
		return round(($date2 - $date1) / (60 * 60 * 24));
	}
	
function parse(& $cadena){
	$cadena = str_replace("'","&#39",$cadena);
	$cadena = str_replace("ó","&oacute;",$cadena);
	return utf8_decode($cadena);
}

function fnRenameUpload($image,$dir = ''){
	$array = explode('.',$image);
	$ext = '.'.$array[count($array)-1];
	$nombre = basename($image,$ext);
	$var_file = $dir.$image;
	while(is_file($dir.$image)){
		$con++;
		$image = $nombre.'('.$con.')'.$ext;
	}
	$string = htmlentities($image);
	$string = preg_replace("/\&(.)[^;]*;/", "\\1", $string);
	$string = preg_replace("/[ ]/", "_", $string);
	$string = preg_replace("/[!]/", "", $string);

	return $string;
}

function tipoArchivo($elArchivo)
{
$laExtension=strtolower(end(explode('.',$elArchivo)));
return $laExtension;
}

function array_meses(){
	$valor = array();

	$valor['1'] = "Enero";
	$valor['2'] = "Febrero";
	$valor['3'] = "Marzo";
	$valor['4'] = "Abril";
	$valor['5'] = "Mayo";
	$valor['6'] = "Junio";
	$valor['7'] = "Julio";
	$valor['8'] = "Agosto";
	$valor['9'] = "Setiembre";
	$valor['10'] = "Octubre";
	$valor['11'] = "Noviembre";
	$valor['12'] = "Diciembre";

	return $valor;
}
/**------------------------------------------------------------------- */
/**
 * @return array()
 * @param string $tabla
 * @param string $columna
 * @desc Extra una columna entera de la tabla.
*/
function inc_color($sw){
	if($sw==1){
		
		return "#F7F7F7";
	}else{
		
		return "#FFFFFF";
	}
}

/** @return string
*  @param string $p_mensaje
*  @desc reeemplaza caracteres especiales tildes, ñ, etc y los reemplaza por el contenido estandar
*  Autor : Minaya leon juan */
/*------------------------------------------------------------------- */
function inc_caracteres_especiales($p_mensaje)
{
	$p_mensaje=str_replace("á","&aacute;",$p_mensaje);	
	$p_mensaje=str_replace("Á","&Aacute;",$p_mensaje);			
	$p_mensaje=str_replace("é","&eacute;",$p_mensaje);	
	$p_mensaje=str_replace("É","&Eacute;",$p_mensaje);			
	$p_mensaje=str_replace("í","&iacute;",$p_mensaje);	
	$p_mensaje=str_replace("Í","&Iacute;",$p_mensaje);			
	$p_mensaje=str_replace("ó","&oacute;",$p_mensaje);	
	$p_mensaje=str_replace("Ó","&Oacute;",$p_mensaje);			
	$p_mensaje=str_replace("ú","&uacute;",$p_mensaje);	
	$p_mensaje=str_replace("Ú","&Uacute;",$p_mensaje);		
	$p_mensaje=str_replace("Ñ","&Ntilde;",$p_mensaje);			
	$p_mensaje=str_replace("ñ","&ntilde;",$p_mensaje);			
	$p_mensaje=str_replace("¿","&iquest;",$p_mensaje);				
	$p_mensaje=str_replace('\"',"&ldquo;",$p_mensaje);					
	$p_mensaje=str_replace('\'',"&#8217;",$p_mensaje);		
	
	return $p_mensaje;	
}


function array_proovedores(){
	$valor = array();

	$valor['1'] = "Automotriz";
	$valor['2'] = "Electricidad e Iluminacion";
	$valor['3'] = "Ferreteria";
	$valor['4'] = "Baños y Cocinas";
	$valor['5'] = "Herramientas";
	$valor['6'] = "Jardineria";
	$valor['7'] = "Limpieza";

	return $valor;
}

function urls_amigables($url) {
	// Tranformamos todo a minusculas
	$url = strtolower($url);
	//Rememplazamos caracteres especiales latinos
	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
	$repl = array('a', 'e', 'i', 'o', 'u', 'n');
	$url = str_replace ($find, $repl, $url);
	// Añaadimos los guiones
	$find = array(' ', '&', '\r\n', '\n', '+');
	$url = str_replace ($find, '-', $url);
	// Eliminamos y Reemplazamos demás caracteres especiales
	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '_', '');
	$url = preg_replace ($find, $repl, $url);
	return $url;
}

function quitar_caracteres($caracter){
	
	$caracter = str_replace("'","",$caracter);
	$caracter = str_replace("?","",$caracter);
	$caracter = str_replace("¿","",$caracter);
	$caracter = str_replace("<","",$caracter);
	$caracter = str_replace(">","",$caracter);
	$caracter = str_replace("&","",$caracter);
	$caracter = str_replace("%","",$caracter);
	$caracter = str_replace("$","",$caracter);
	$caracter = str_replace(")","",$caracter);
	$caracter = str_replace("(","",$caracter);
	$caracter = str_replace(",","",$caracter);
	$caracter = str_replace("=","",$caracter);
	
	return $caracter;	
}
?>