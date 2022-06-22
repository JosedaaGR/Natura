<?PHP 
//Clase generada automaticamente por Awisoft Software y Sistemas SL

	
include_once("conexion.php");

class usuario {

var $conexion;

function __construct(){
	$this->conexion= new conexion();
}	
	
	
	function insertar($usuario_Nombre, $usuario_Apellidos, $usuario_DNI, $usuario_Provincia,$usuario_Poblacion ,$usuario_Direccion, $usuario_Telefono, $usuario_Email,$usuario_Usuario, $usuario_Pass, $usuario_Foto, $usuario_Tipo, $usuario_Estado) {
		$consulta = "INSERT INTO usuario(usuario_Nombre, usuario_Apellidos, usuario_DNI, usuario_Provincia, usuario_Poblacion,usuario_Direccion, usuario_Telefono, usuario_Email, usuario_Usuario,usuario_Pass, usuario_Foto, usuario_Tipo, usuario_Estado)
				VALUES('$usuario_Nombre', '$usuario_Apellidos', '$usuario_DNI', '$usuario_Provincia','$usuario_Poblacion' ,'$usuario_Direccion', '$usuario_Telefono', '$usuario_Email','$usuario_Usuario', '$usuario_Pass', '$usuario_Foto', '$usuario_Tipo', '$usuario_Estado')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}

	function insertarAdmin($usuario_Nombre, $usuario_Email,$usuario_Usuario, $usuario_Pass, $usuario_Tipo) {
		$consulta = "INSERT INTO usuario(usuario_Nombre,usuario_Email, usuario_Usuario,usuario_Pass, usuario_Tipo)
				VALUES('$usuario_Nombre', '$usuario_Email','$usuario_Usuario', '$usuario_Pass','$usuario_Tipo')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	function registroCliente($usuario_Nombre, $usuario_Email,$usuario_Usuario, $usuario_Pass, $usuario_Tipo) {
		$consulta = "INSERT INTO usuario(usuario_Nombre,usuario_Email, usuario_Usuario,usuario_Pass, usuario_Tipo)
				VALUES('$usuario_Nombre', '$usuario_Email','$usuario_Usuario', '$usuario_Pass','$usuario_Tipo')";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	function eliminar($condicion) {
		$consulta = "DELETE FROM usuario ".$condicion;
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	function modificar($usuario_Nombre, $usuario_Apellidos, $usuario_DNI, $usuario_Provincia,$usuario_Poblacion ,$usuario_Direccion, $usuario_Telefono, $usuario_Email,$usuario_Usuario, $usuario_Pass, $usuario_Foto, $usuario_Tipo, $usuario_Estado,$usuario_CodPK) {
		$consulta = "UPDATE usuario SET usuario_Nombre='$usuario_Nombre', usuario_Apellidos='$usuario_Apellidos', usuario_DNI='$usuario_DNI', usuario_Provincia='$usuario_Provincia', usuario_Poblacion='$usuario_Poblacion',usuario_Direccion='$usuario_Direccion', usuario_Telefono='$usuario_Telefono',
						usuario_Email='$usuario_Email',usuario_Usuario='$usuario_Usuario',usuario_Pass='$usuario_Pass', usuario_Foto='$usuario_Foto', usuario_Tipo='$usuario_Tipo', usuario_Estado='$usuario_Estado'
						  WHERE usuario_CodPK='$usuario_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	function modificarAdmin($usuario_Nombre,$usuario_Email,$usuario_Usuario, $usuario_Pass,$usuario_CodPK) {
		$consulta = "UPDATE usuario SET usuario_Nombre='$usuario_Nombre',
						usuario_Email='$usuario_Email',usuario_Usuario='$usuario_Usuario',usuario_Pass='$usuario_Pass'
						  WHERE usuario_CodPK='$usuario_CodPK'";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);
	}
	
	function obtener(){
		$consulta  = "SELECT * FROM usuario";
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	function modificarEstado($condicion)
	{
		$consulta = "UPDATE usuario SET $condicion";
		$res = $this->conexion->BD_Consulta($consulta);
		return ($res);
	}
	
	function obtenerConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM usuario $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM usuario $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM usuario $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM usuario";
						}				
			  }
		}
									  
		$res = $this->conexion->BD_Consulta($consulta);
		return($res);	
	}
	
	
	function obtenerPaginados(){
		$consulta  = "SELECT * FROM usuario";
		return($consulta);	
	}
	
	
	function obtenerPaginadosConFiltro($condicion,$order){
		 if($condicion=="" && $order!="")
				$consulta  = "SELECT * FROM usuario $order";				
		 else{
			 if($order=="" && $condicion!="")
					$consulta  = "SELECT * FROM usuario $condicion";				
			 else{
				  if($order!="" && $condicion!="")		 
					$consulta  = "SELECT * FROM usuario $condicion $order";
					else{
						if($order=="" && $condicion=="")		 
							$consulta  = "SELECT * FROM usuario";
						}				
			  }
		}
		return($consulta);	
	}
	
	
} 
?>