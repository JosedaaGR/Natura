<?PHP
function cambiaf_a_normal_formato($fecha){
    $mes_array = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    
    preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha);
    
    $mes_actual=$mifecha[2]*1;
    
    $lafecha=$mifecha[3]." ".$mes_array[$mes_actual]." ".$mifecha[1]; 
    return $lafecha; 
}

//////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal 
//////////////////////////////////////////////////// 
function cambiaf_a_normal($fecha){
    if(trim($fecha)!="" && strcmp($fecha, "0000-00-00")!=0)
    {
	preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha); 
	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
	return $lafecha; 
    }
    else
    {
	$lafecha="";
	return $lafecha; 
    }
} 
function obtener_anyo_mysql($fecha)
{
    $lafecha="";
    if($fecha!=NULL && trim($fecha)!="" && strcmp($fecha,"0000-00-00")!=0)
    {
	preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha); 
	$lafecha=$mifecha[1];
	$lafecha=str_replace("2020", "2#", $lafecha);
	$lafecha=str_replace("20", "", $lafecha);
	$lafecha=str_replace("2#", "20", $lafecha);
    }
    
    return $lafecha; 
}//fin del function obtener_anyo_mysql($fecha)

//////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal, y devuelve el a�o con dos cifras en vez de con 4
//////////////////////////////////////////////////// 
function cambiaf_a_normal2($fecha){ 
    preg_match('/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha); 
	
	$anyo=$mifecha[1];
	
	$anyo = substr ($anyo, -2);    // devuelve "05", si la cadena es 2005

	
    $lafecha=$mifecha[3].".".$mifecha[2].".".$anyo; 
    return $lafecha; 
} 

//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 

function cambiaf_a_mysql($fecha){
    if(trim($fecha)!="")
    {
	preg_match('~([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})~', $fecha, $mifecha); 
	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
	return $lafecha;
    }
    else
    {
	$lafecha="0000-00-00";
	return $lafecha;
    }
} 




//////////////////////////////////////////////////// 
//Compara fechas
//////////////////////////////////////////////////// 

function datecmp($f1, $f2) 
{ 
	//esto funcionara siempre que las fechas esten separadas por -, y sean de la form
	//anyo-mes-dia
	
	list($anyo1,$mes1,$dia1) = explode("-",$f1);
	list($anyo2,$mes2,$dia2) = explode("-",$f2);
	   
    //echo "a�o 1: ".$anyo1." --- a�o 2: ".$anyo2 . "<br>"; 
    if ($anyo1==$anyo2) 
    {        
       //echo "mes 1: ".$mes1." --- mes2: ".$mes2 . "<br>"; 
       if ($mes1==$mes2) 
       {           
          //echo "dia1 1: ".$dia1." --- dia2: ".$dia2 . "<br><br>"; 
          if ($dia1==$dia2) 
             return 0; 
          elseif ($dia1>$dia2) 
             return 1; 
          else 
             return -1; 
       } 
       elseif ($mes1>$mes2) 
          return 1; 
       else 
          return -1; 
       } 
    elseif ($anyo1>$anyo2) 
       return 1; 
    else 
       return -1; 
} 

# Obtener Mes 
# Restamos -1 para que el mes de Diciembre no sea el n�mero 11. 
# date('m'); # Devuelve el n�mero del mes actual. 

# Para hacerlo funcionar.. 
## $mes=date('m'); 
## print obtener_mes_by_num($mes); 
function obtener_mes_by_num($num) { 
    $meses=array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'); 
    if (!isset($meses[$num-1])) 
        return false; 
    return $meses[$num-1]; 
} 

//Fecha Actual en formato --> Lunes 16 Marzo 2008
function obtener_fecha_actual()
{	//Obtenemos la Fecha Actual
	$dia=date("d");
	$mes=date("m");
	$anio=date("Y");		
	
  //Ponemos la configuracion al espa�ol para que nos lo muestre como deseamos
  setlocale(LC_ALL, 'es-ES');
  $loc = setlocale(LC_TIME, NULL);
  //Imprimimos el formato
  $resultado= ucwords (strftime("%A %d %B %Y", mktime(0, 0, 0, $mes, $dia, $anio)));
  //Tiene un peque�o fallo con el sabado y lo arreglamos de esta forma
  $resultado=str_replace ("S?bado", "S�bado", $resultado); 
  //Devuelve la Fecha con el Formato --> Lunes 16 Marzo 2008
  return($resultado);
}

function obtener_fecha_actual_parametros_ingles($fecha)
{	
	
	list( $anio, $mes, $dia ) = split( '[-]', $fecha );

	
  //Ponemos la configuracion al espa�ol para que nos lo muestre como deseamos
  setlocale(LC_ALL, 'es-ES');
  $loc = setlocale(LC_TIME, NULL);
  //Imprimimos el formato
  $resultado= ucwords (strftime("%A %d %B %Y", mktime(0, 0, 0, $mes, $dia, $anio)));
  //Tiene un peque�o fallo con el sabado y lo arreglamos de esta forma
  $resultado=str_replace ("Monday", "Lunes", $resultado); 
  $resultado=str_replace ("Tuesday", "Martes", $resultado); 
  $resultado=str_replace ("Wednesday", "Miercoles", $resultado); 
  $resultado=str_replace ("Thursday", "Jueves", $resultado); 
  $resultado=str_replace ("Friday", "Viernes", $resultado); 
  $resultado=str_replace ("Saturday", "S&aacute;bado", $resultado); 
  $resultado=str_replace ("Sunday", "Domingo", $resultado); 
  
  
  //Meses
  $resultado=str_replace ("January", "Enero", $resultado); 
  $resultado=str_replace ("February", "Febrero", $resultado); 
  $resultado=str_replace ("March", "Marzo", $resultado); 
  $resultado=str_replace ("April", "Abril", $resultado); 
  $resultado=str_replace ("May", "Mayo", $resultado); 
  $resultado=str_replace ("June", "Junio", $resultado); 
  $resultado=str_replace ("July", "Julio", $resultado); 
  $resultado=str_replace ("August", "Agosto", $resultado); 
  $resultado=str_replace ("September", "Septiembre", $resultado); 
  $resultado=str_replace ("October", "Octubre", $resultado); 
  $resultado=str_replace ("November", "Noviembre", $resultado); 
  $resultado=str_replace ("December", "Diciembre", $resultado);           
  
  //Devuelve la Fecha con el Formato --> Lunes 16 Marzo 2008
  return($resultado);
}
?>