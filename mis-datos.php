<?PHP
session_start();

include_once "clases/fun_aux_menu_intranet.php";
include_once "clases/conexion.php";
include_once "clases/comprobar_usuario.php";
include_once "clases/fechas.php";
include_once "clases/usuario.php";
require "clases/xajax/xajax_core/xajax.inc.php";
$conexion = new conexion();
$usuario = new usuario();
$tuplaUsuario = usuario_logueado();

$mensaje_alerta = "";

if ($tuplaUsuario == NULL) {
	print("<script>document.location.href='index.php'</script>");
	exit();
} else {
	$usuario_CodPK = $tuplaUsuario['usuario_CodPK'];
	$usuario_Nombre = $tuplaUsuario['usuario_Nombre'];
	$usuario_Apellidos = $tuplaUsuario['usuario_Apellidos'];
	$usuario_DNI = $tuplaUsuario['usuario_DNI'];
	$usuario_Provincia = $tuplaUsuario['usuario_Provincia'];
	$usuario_Poblacion = $tuplaUsuario['usuario_Poblacion'];
	$usuario_Direccion = $tuplaUsuario['usuario_Direccion'];
	$usuario_Email = $tuplaUsuario['usuario_Email'];
	$usuario_Pass = $tuplaUsuario['usuario_Pass'];
	$usuario_Usuario = $tuplaUsuario['usuario_Usuario'];
	$usuario_Telefono = $tuplaUsuario['usuario_Telefono'];
}


if (isset($_POST['aux'])) {
	$usuario_Nombre = str_replace("'", "\"", $_POST['usuario_Nombre']);
	$usuario_Apellidos = str_replace("'", "\"", $_POST['usuario_Apellidos']);
	$usuario_DNI = str_replace("'", "\"", $_POST['usuario_DNI']);
	$usuario_Provincia = str_replace("'", "\"", $_POST['usuario_Provincia']);
	$usuario_Poblacion = str_replace("'", "\"", $_POST['usuario_Poblacion']);
	$usuario_Usuario = str_replace("'", "\"", $_POST['usuario_Usuario']);
	$usuario_Direccion = str_replace("'", "\"", $_POST['usuario_Direccion']);
	$usuario_Telefono = str_replace("'", "\"", $_POST['usuario_Telefono']);
	$usuario_Email = str_replace("'", "\"", $_POST['usuario_Email']);
	$usuario_Pass = str_replace("'", "\"", $_POST['usuario_Pass']);

	$sqlEmail = "SELECT * FROM usuario WHERE (usuario_Email='" . $usuario_Email . "' OR usuario_Usuario='" . $usuario_Usuario . "') AND usuario_CodPK !=" . $usuario_CodPK;
	$resEmail = $conexion->BD_Consulta($sqlEmail);
	$vectorEmail = $conexion->BD_GetTupla($resEmail);


	if ($vectorEmail != NULL) {
		$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p>Email o Usuario ya utilizados</p>		
              </div>
            </div>
          </div>
        </div>";
	} else {
		$res = $usuario->modificar($usuario_Nombre, $usuario_Apellidos, $usuario_DNI, $usuario_Provincia, $usuario_Poblacion, $usuario_Direccion, $usuario_Telefono, $usuario_Email, $usuario_Usuario, $usuario_Pass, '', 'Cliente', 'Activo', $usuario_CodPK);
		if ($res == true) {
			$username_pcontrol_new5 = str_replace("'", "", $usuario_Usuario);
			$username_pcontrol_new5 = str_replace("\"", "", $username_pcontrol_new5);
			$password_pcontrol_new5 = str_replace("'", "", $usuario_Pass);
			$password_pcontrol_new5 = str_replace("\"", "", $password_pcontrol_new5);

			$_SESSION['username_pcontrol_new5'] = $username_pcontrol_new5;
			$_SESSION['password_pcontrol_new5'] = $password_pcontrol_new5;

			$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p>Usuario Modificado Correctamente</p>		
              </div>
            </div>
          </div>
        </div>";
		} else {
			$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p>Ha ocurrido un error, por favor intentelo de nuevo</p>		
              </div>
            </div>
          </div>
        </div>";
		}
	}
}
$xajax = new xajax();
$xajax->configure('decodeUTF8Input', true);

if ($tuplaUsuario['usuario_Provincia'] == NULL) {

	$usuario_Provincia = 41;
	$usuario_Poblacion = 4088;
}


$sqlhojarutaSalida = "SELECT * FROM poblacion_provincia WHERE poblacion_CodPK=" . $usuario_Poblacion;
$reshojarutaSalida = $conexion->BD_Consulta($sqlhojarutaSalida);
$tuplahojarutaSalida = $conexion->BD_GetTupla($reshojarutaSalida);
if ($tuplahojarutaSalida != NULL)
	$usuario_Provincia = $tuplahojarutaSalida['poblacion_ProvinciaFK'];

function select_prov($poblacion_ProvinciaFK)
{
	$conexion = new conexion();
	$nuevo_select = "<select id='usuario_Poblacion' name='usuario_Poblacion' class='form-control'>";
	$consultasql = "SELECT * FROM poblacion_provincia WHERE poblacion_ProvinciaFK=" . $poblacion_ProvinciaFK . " ORDER BY poblacion_Nombre";
	$resconsql = $conexion->BD_Consulta($consultasql);
	$tuplaPobla = $conexion->BD_GetTupla($resconsql);

	while ($tuplaPobla != NULL) {
		$nuevo_select .= '<option value="' . $tuplaPobla['poblacion_CodPK'] . '">' . $tuplaPobla['poblacion_Nombre'] . '</option>';
		$tuplaPobla = $conexion->BD_GetTupla($resconsql);
	}
	$nuevo_select .= "</select>";
	return $nuevo_select;
}
function generar_select($provincia_CodPK)
{
	$respuesta = new xajaxResponse();

	$nuevo_select = select_prov($provincia_CodPK);

	$respuesta->Assign("seleccombinado", "innerHTML", $nuevo_select);

	return $respuesta;
}


//Registramos la funcion de esta manera ya que registerFunction no funciona
$xajax->register(XAJAX_FUNCTION, 'generar_select');

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

?>
<!doctype html>
<html lang="es">

<head>
	<title>NATURA</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="shortcut icon" href="favicon/favicon.ico">

	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<!--//fonts-->
	<?PHP
	//Esta línea no cambia porque el printJavascript sigue recibiendo 
	//la ruta a la carpeta raíz donde están las librerías xajax.
	$xajax->printJavascript("xajax/");
	?>
</head>

<body>
	<!-- header -->
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header ">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Navegacion</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="inicio.php"> HOTEL <span>NATURA</span>
							<p class="logo_w3l_agile_caption">Tu resort de ensueño</p>
						</a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item"><a href="inicio.php#about" class="menu__link scroll">Acerca de</a></li>
							<li class="menu__item"><a href="inicio.php#team" class="menu__link scroll">Equipo</a></li>
							<li class="menu__item"><a href="inicio.php#gallery" class="menu__link scroll">Galería</a></li>
							<li class="menu__item"><a href="inicio.php#rooms" class="menu__link scroll">Habitaciones</a></li>
							<li class="menu__item"><a href="./reservar.php" class="menu__link scroll">Reservar</a></li>
							<li class="menu__item  dropdown"> <a class="menu__link scroll dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user"></i> <?php print("" . $tuplaUsuario['usuario_Usuario'] . ""); ?></a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<ul class="nav navbar-nav menu__list">
										<li class="menu__item"><a href="./mis-datos.php" class="menu__link scroll">Mis Datos</a></li>
										<li class="menu__item"><a href="./mis-reservas.php" class="menu__link scroll">Mis Reservas</a></li>
										<li class="menu__item"><a href="#" data-toggle="modal" data-target="#cerrar-sesion" class="menu__link scroll">Cerrar Sesion</a></li>

									</ul>
								</div>

							</li>

						</ul>
					</nav>

				</div>

			</nav>

		</div>
	</div>
	<!-- //header -->
	<br>
	<br>



	<div class="wrapper">

		<div class="container">

			<?PHP print($mensaje_alerta); ?>

			<form id="reserva_cliente" name="registro_cliente" method="post" action="mis-datos.php">
				<input type="hidden" name="aux" id="aux" />
				<input type="hidden" name="reserva_Usuario" id="reserva_Usuario" value="<?PHP print($usuario_CodPK); ?>" />


				<div class="row">
					<div class="col-md-12 text-center">
						<h3 class="title-section">Datos Personales</h3>
					</div>
					<br>
					<br>
					<br>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Nombre *</label>
							<input type="text" class="form-control" name="usuario_Nombre" id="usuario_Nombre" value="<?PHP print($usuario_Nombre); ?>" required />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Apellidos </label>
							<input type="text" class="form-control" name="usuario_Apellidos" id="usuario_Apellidos" value="<?PHP print($usuario_Apellidos); ?>" />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>DNI *</label>
							<input type="text" class="form-control" name="usuario_DNI" id="usuario_DNI" value="<?PHP print($usuario_DNI); ?>" required />
						</div>
					</div>

					<div class="col-xs-12 colsm-12 col-md-2 col-lg-4">
						<div class="form-group">
							<label>Provincia</label>

							<select onchange="xajax_generar_select(document.getElementById('usuario_Provincia').value)" name="usuario_Provincia" id="usuario_Provincia" style="width: 100%" class="form-control">
								<?PHP
								$sqlProvincia = "SELECT DISTINCT provincia_CodPK, provincia_Nombre FROM provincia INNER JOIN poblacion_provincia ON poblacion_ProvinciaFK=provincia_CodPK ORDER BY provincia_Nombre ASC";
								$resProvincia = $conexion->BD_Consulta($sqlProvincia);
								$tuplaProvincia = $conexion->BD_GetTupla($resProvincia);

								while ($tuplaProvincia != NULL) {
									if ($tuplaProvincia['provincia_CodPK'] == $usuario_Provincia)
										print("<option value=\"" . $tuplaProvincia['provincia_CodPK'] . "\" selected=\"selected\">" . $tuplaProvincia['provincia_Nombre'] . "</option>");
									else
										print("<option value=\"" . $tuplaProvincia['provincia_CodPK'] . "\">" . $tuplaProvincia['provincia_Nombre'] . "</option>");
									$tuplaProvincia = $conexion->BD_GetTupla($resProvincia);
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-xs-12 colsm-12 col-md-2 col-lg-4">
						<div class="form-group">
							<label>Poblacion </label>
							<div id="seleccombinado">
								<select id="usuario_Poblacion" name="usuario_Poblacion" class="form-control">
									<?PHP
									$sqlPoblacion = "SELECT * FROM poblacion_provincia WHERE poblacion_ProvinciaFK=" . $usuario_Provincia . " ORDER BY poblacion_Nombre";
									$resPoblacion = $conexion->BD_Consulta($sqlPoblacion);
									$tuplaPoblacion = $conexion->BD_GetTupla($resPoblacion);

									while ($tuplaPoblacion != NULL) {
										if ($tuplaPoblacion['poblacion_CodPK'] == $usuario_Poblacion)
											print("<option value=\"" . $tuplaPoblacion['poblacion_CodPK'] . "\" selected=\"selected\">" . ($tuplaPoblacion['poblacion_Nombre']) . "</option>");
										else
											print("<option value=\"" . $tuplaPoblacion['poblacion_CodPK'] . "\">" . ($tuplaPoblacion['poblacion_Nombre']) . "</option>");

										$tuplaPoblacion = $conexion->BD_GetTupla($resPoblacion);
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Direccion </label>
							<input type="text" class="form-control" name="usuario_Direccion" id="usuario_Direccion" value="<?PHP print($usuario_Direccion); ?>" />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
						<div class="form-group">
							<label>Telefono </label>
							<input type="text" class="form-control" name="usuario_Telefono" id="usuario_Telefono" value="<?PHP print($usuario_Telefono); ?>" />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="form-group">
							<label>Email * </label>
							<input type="email" class="form-control" name="usuario_Email" id="usuario_Email" value="<?PHP print($usuario_Email); ?>" required />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="form-group">
							<label>Usuario * </label>
							<input type="text" class="form-control" name="usuario_Usuario" id="usuario_Usuario" value="<?PHP print($usuario_Usuario); ?>" required />
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="form-group">
							<label>Contraseña * </label>
							<input type="password" class="form-control" name="usuario_Pass" id="usuario_Pass" value="<?PHP print($usuario_Pass); ?>" required />

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
						<div class="form-group">
							<label for=""></label>
							<input type="button" style="background-color:#5E8A75 ;color:white;" class="btn btn-pill" value="Mostrar" onclick="mostrarContrasena(this);">

						</div>

					</div>


					<div style="clear: both;"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br /><br />
						<div class="text-right">
							<a href="index.php" class="btn btn-danger">CANCELAR</a>
							<button class="btn " style="background-color: #2B475C;color:white;">GUARDAR</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br><br><br><br>



	<div class="modal fade" id="cerrar-sesion" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document" style="margin:6.75rem auto;">
			<div class="modal-content" style="width: 75%;margin:auto; ">

				<div class="modal-body text-center">
					<h3>¿Quiere cerrar sesión?</h3><br>

					<div class="text-center">
						<button onclick="document.location.href='desconectar.php'" class="btn " style="color:white;cursor: pointer;width:45%;background-color:#2B475C;"> SI</button>
						<button class="btn btn-default" data-dismiss="modal" style="cursor: pointer;width:45%;"> NO</button>
					</div>

				</div>

			</div>
		</div>
	</div>
	<br><br>
	<!-- <div class="copy" style="bottom: 0;">
		<p>© 2002 <a href="inicio.php">NATURA</a> </p>
	</div> -->
	<!-- 
	<script>
		$(function() {
			$('#datetimepicker1').datetimepicker();
		});
	</script> -->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--script para la firma a mano-->
	<?PHP
	print($mensaje_alerta);

	if (trim($mensaje_alerta) != "") {
	?>
		<script type="text/javascript">
			$(window).on('load', function() {
				$('#ModalAlert').modal('show');
			});

			setTimeout(function() {
				$('#ModalAlert').modal('hide');
			}, 4000);
		</script>
	<?PHP

	} //fin del if(trim($mensaje_alerta)!="")
	?>
	<script>
		function mostrarContrasena(boton) {
			var contrasena = document.getElementById("usuario_Pass");
			// var boton = document.getElementById("boton_mostrar_contrasena");

			if (contrasena.type == "password") {
				contrasena.type = "text";
				boton.value = "Ocultar";
			} else {
				contrasena.type = "password";
				boton.value = "Mostrar";
			}
		}
	</script>
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<script src="js/responsiveslides.min.js"></script>

	<!-- //smooth scrolling -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>



</body>

</html>