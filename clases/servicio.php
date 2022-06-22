<?PHP 
	
include_once("conexion.php");

class servicio {

var $conexion;

function __construct()
{
	$this->conexion= new conexion();

}	
	
	function insertar($servicio_Nombre,$servicio_Precio,$servicio_Estado){
		$consulta = "INSERT INTO servicio(servicio_Nombre,servicio_Precio,servicio_Estado) VALUES('$servicio_Nombre','$servicio_Precio','$servicio_Estado')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function eliminar($condicion) {
		$consulta = "DELETE FROM servicio $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function modificar($servicio_Nombre,$servicio_Precio,$servicio_Estado, $servicio_CodPK) {
		$consulta = "UPDATE servicio SET servicio_Nombre='$servicio_Nombre', servicio_Precio='$servicio_Precio',servicio_Estado='$servicio_Estado' WHERE servicio_CodPK='$servicio_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtener(){
		$consulta  = "SELECT * FROM servicio";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function obtenerConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM servicio $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM servicio $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM servicio $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM servicio";
						}				
			  }
		}
		
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtenerPaginados(){
		$consulta  = "SELECT * FROM servicio";
		return($consulta);	
	}
	
	
	function obtenerPaginadosConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM servicio $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM servicio $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM servicio $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM servicio";
						}				
			  }
		}
		return($consulta);	
	}
	
	
} 
?>