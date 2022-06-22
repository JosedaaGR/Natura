<?PHP 
//Clase generada automaticamente por NUBEADO

	
include_once("conexion.php");

class reserva {

var $conexion;

function __construct(){
	$this->conexion= new conexion();
}	
	
	
	function insertar($reserva_UsuarioFK, $reserva_HabitacionFK, $reserva_CamaFK,$reserva_ServicioFK ,$reserva_Finicio,$reserva_Ffin,$reserva_Npersonas) {
		$consulta = "INSERT INTO reserva(reserva_UsuarioFK, reserva_HabitacionFK, reserva_CamaFK, reserva_ServicioFK,reserva_Finicio,reserva_Ffin,reserva_Npersonas) VALUES('$reserva_UsuarioFK', '$reserva_HabitacionFK', '$reserva_CamaFK','$reserva_ServicioFK' ,'$reserva_Finicio','$reserva_Ffin','$reserva_Npersonas')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function eliminar($condicion) {
		$consulta = "DELETE FROM reserva $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	
	function modificarEstado($condicion)
	{
		$consulta = "UPDATE reserva SET $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return ($res);
	}
	
	function modificar($reserva_UsuarioFK, $reserva_HabitacionFK, $reserva_CamaFK, $reserva_Finicio,$reserva_Ffin,$reserva_ServicioFK,$reserva_Npersonas,$reserva_Estado, $reserva_CodPK) {
		$consulta = "UPDATE reserva SET reserva_UsuarioFK='$reserva_UsuarioFK',reserva_ServicioFK='$reserva_ServicioFK', reserva_HabitacionFK='$reserva_HabitacionFK', reserva_CamaFK='$reserva_CamaFK', reserva_Finicio='$reserva_Finicio',reserva_Ffin='$reserva_Ffin',reserva_Npersonas='$reserva_Npersonas',reserva_Estado='$reserva_Estado' WHERE reserva_CodPK='$reserva_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	
	function obtener(){
		$consulta  = "SELECT * FROM reserva";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	
	function obtenerConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM reserva $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM reserva $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM reserva $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM reserva";
						}				
			  }
		}
									  
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	
	function obtenerPaginados(){
		$consulta  = "SELECT * FROM reserva";
		return($consulta);	
	}
	
	
	function obtenerPaginadosConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM reserva $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM reserva $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM reserva $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM reserva";
						}				
			  }
		}
		return($consulta);	
	}
	
	
} 
?>