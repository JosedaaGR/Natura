<?PHP 
	
include_once("conexion.php");

class cama {

var $conexion;

function __construct()
{
	$this->conexion= new conexion();

}	
	
	function insertar($cama_Tipo,$cama_Precio,$cama_Observaciones,$cama_Estado){
		$consulta = "INSERT INTO cama(cama_Tipo,cama_Precio,cama_Observaciones,cama_Estado) VALUES('$cama_Tipo','$cama_Precio','$cama_Observaciones','$cama_Estado')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function eliminar($condicion) {
		$consulta = "DELETE FROM cama $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function modificar($cama_Tipo,$cama_Precio,$cama_Observaciones,$cama_Estado, $cama_CodPK) {
		$consulta = "UPDATE cama SET cama_Tipo='$cama_Tipo', cama_Precio='$cama_Precio',cama_Observaciones='$cama_Observaciones',cama_Estado='$cama_Estado' WHERE cama_CodPK='$cama_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtener(){
		$consulta  = "SELECT * FROM cama";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function obtenerConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM cama $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM cama $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM cama $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM cama";
						}				
			  }
		}
		
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtenerPaginados(){
		$consulta  = "SELECT * FROM cama";
		return($consulta);	
	}
	
	
	function obtenerPaginadosConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM cama $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM cama $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM cama $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM cama";
						}				
			  }
		}
		return($consulta);	
	}
	
	
} 
?>