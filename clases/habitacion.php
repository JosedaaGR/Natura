<?PHP 
	
include_once("conexion.php");

class habitacion {

var $conexion;

function __construct()
{
	$this->conexion= new conexion();

}	
	
	function insertar($habitacion_Tipo,$habitacion_Precio,$habitacion_Observaciones,$habitacion_Estado){
		$consulta = "INSERT INTO habitacion(habitacion_Tipo,habitacion_Precio,habitacion_Observaciones,habitacion_Estado) VALUES('$habitacion_Tipo','$habitacion_Precio','$habitacion_Observaciones','$habitacion_Estado')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function eliminar($condicion) {
		$consulta = "DELETE FROM habitacion $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function modificar($habitacion_Tipo,$habitacion_Precio,$habitacion_Observaciones,$habitacion_Estado, $habitacion_CodPK) {
		$consulta = "UPDATE habitacion SET habitacion_Tipo='$habitacion_Tipo', habitacion_Precio='$habitacion_Precio',habitacion_Observaciones='$habitacion_Observaciones',habitacion_Estado='$habitacion_Estado' WHERE habitacion_CodPK='$habitacion_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtener(){
		$consulta  = "SELECT * FROM habitacion";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function obtenerConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM habitacion $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM habitacion $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM habitacion $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM habitacion";
						}				
			  }
		}
		
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtenerPaginados(){
		$consulta  = "SELECT * FROM habitacion";
		return($consulta);	
	}
	
	
	function obtenerPaginadosConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM habitacion $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM habitacion $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM habitacion $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM habitacion";
						}				
			  }
		}
		return($consulta);	
	}
	
	
} 
?>