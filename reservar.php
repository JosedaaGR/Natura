<?PHP
session_start();

include_once "clases/fun_aux_menu_intranet.php";
include_once "clases/conexion.php";
include_once "clases/comprobar_usuario.php";
include_once "clases/fechas.php";
include_once "clases/reserva.php";
require "clases/xajax/xajax_core/xajax.inc.php";
$conexion = new conexion();
$reserva = new reserva();
$tuplaUsuario = usuario_logueado();

$mensaje_alerta = "";

if ($tuplaUsuario == NULL) {
	print("<script>document.location.href='index.php'</script>");
	exit();
}

$habitacion_CodPK = 0;
if (isset($_GET['habitacion_CodPK']))
	$habitacion_CodPK = $_GET['habitacion_CodPK'];


if (isset($_POST['aux'])) {
	$reserva_HabitacionFK = str_replace("'", "\"", $_POST['reserva_HabitacionFK']);
	$reserva_CamaFK = str_replace("'", "\"", $_POST['reserva_CamaFK']);
	$reserva_Finicio = str_replace("'", "\"", $_POST['reserva_Finicio']);
	$reserva_Ffin = str_replace("'", "\"", $_POST['reserva_Ffin']);
	$reserva_Npersonas = str_replace("'", "\"", $_POST['reserva_Npersonas']);
	$reserva_ServicioFK = str_replace("'", "\"", $_POST['reserva_ServicioFK']);
	$reserva_UsuarioFK = $tuplaUsuario['usuario_CodPK'];

	if($reserva_Ffin<$reserva_Finicio){
		$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
              <p>La fecha de salida no puede ser anterior a la de entrada</p>		
              </div>
            </div>
          </div>
        </div>";
	}
	else{

	$sqlReserva = "SELECT COUNT(*) todo FROM reserva WHERE reserva_Finicio<='" . $reserva_Ffin . "' AND reserva_Ffin>='" . $reserva_Finicio . "'  AND reserva_HabitacionFK='" . $reserva_HabitacionFK . "'AND reserva_Estado='Activo'";
	$resReserva = $conexion->BD_Consulta($sqlReserva);
	$vectorReserva = $conexion->BD_GetTupla($resReserva);


	if ($vectorReserva['todo'] >= 3) {
		$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
              <p>La habitacion no se encuentra disponible, por favor escoja otra</p>		
              </div>
            </div>
          </div>
        </div>";
	} else {
		if ($tuplaUsuario['usuario_DNI'] == '') {
			$mensaje_alerta = "
            <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
              <div class=\"modal-dialog\">
                <!-- Modal content-->
                <div class=\"modal-content\">
                <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                  </div>
                  <div class=\"modal-body\" style=\"padding:15px;\">			      
                  <p>Debes rellenar tus datos personales, después realizar la reserva</p>		
                  </div>
                </div>
              </div>
            </div>";
		} else {
			$res = $reserva->insertar($reserva_UsuarioFK, $reserva_HabitacionFK, $reserva_CamaFK, $reserva_ServicioFK, $reserva_Finicio, $reserva_Ffin, $reserva_Npersonas);
			if ($res == true)
				$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p>Reserva Realizada Correctamente</p>		
              </div>
            </div>
          </div>
        </div>";
			else {
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
}
}


?>
<!doctype html>
<html lang="es">

<head>
	<title>NATURA</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

			<form id="reserva_cliente" name="registro_cliente" method="post" action="reservar.php">
				<input type="hidden" name="aux" id="aux" />
				<input type="hidden" name="reserva_Usuario" id="reserva_Usuario" value="<?PHP print($tuplausuario['usuario_CodPK']); ?>" />


				<div class="row">
					<div class="col-md-12 text-center">
						<h3 class="title-section">Realizar una Reserva</h3>
					</div>
					<br>
					<br>
					<br>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="form-group">
							<label>Habitacion *</label>
							<select name="reserva_HabitacionFK" id="reserva_HabitacionFK" class="form-control" style="margin-top: 5px;">
								<?PHP
								$sqlHabi = "SELECT * FROM habitacion
								WHERE habitacion_Estado='Activo'
								ORDER BY habitacion_Tipo";
								$resHabi = $conexion->BD_Consulta($sqlHabi);
								$tuplaHabi = $conexion->BD_GetTupla($resHabi);

								while ($tuplaHabi != NULL) {
									if ($tuplaHabi['habitacion_CodPK'] == $habitacion_CodPK)
										print("<option selected=\"selected\" value=\"" . $tuplaHabi['habitacion_CodPK'] . "\">" . $tuplaHabi['habitacion_Tipo'] . " - " . $tuplaHabi['habitacion_Precio'] . "€</option>");
									else
										print("<option value=\"" . $tuplaHabi['habitacion_CodPK'] . "\">" . $tuplaHabi['habitacion_Tipo'] . " - " . $tuplaHabi['habitacion_Precio'] . "€</option>");

									$tuplaHabi = $conexion->BD_GetTupla($resHabi);
								} //fin del while($tuplaHabi!=NULL)
								?>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-3">
						<div class="form-group">
							<label>Tipo Servicio *</label>
							<select name="reserva_ServicioFK" id="reserva_ServicioFK" class="form-control" style="margin-top: 5px;">
								<?PHP
								$sqlTipoServicio = "SELECT * FROM servicio ORDER BY servicio_Nombre";
								$resTipoServicio = $conexion->BD_Consulta($sqlTipoServicio);
								$tuplaTipoServicio = $conexion->BD_GetTupla($resTipoServicio);

								while ($tuplaTipoServicio != NULL) {
									if ($tuplaTipoServicio['servicio_CodPK'] == $reserva_ServicioFK)
										print("<option selected=\"selected\" value=\"" . $tuplaTipoServicio['servicio_CodPK'] . "\">" . $tuplaTipoServicio['servicio_Nombre'] . " - " . $tuplaTipoServicio['servicio_Precio'] . "€</option>");
									else
										print("<option value=\"" . $tuplaTipoServicio['servicio_CodPK'] . "\">" . $tuplaTipoServicio['servicio_Nombre'] . " - " . $tuplaTipoServicio['servicio_Precio'] . "€</option>");

									$tuplaTipoServicio = $conexion->BD_GetTupla($resTipoServicio);
								} //fin del while($tuplaTipoServicio!=NULL)
								?>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-3">
						<div class="form-group">
							<label>Cama *</label>
							<select name="reserva_CamaFK" id="reserva_CamaFK" class="form-control" style="margin-top: 5px;">
								<?PHP
								$sqlCama = "SELECT * FROM cama
								WHERE cama_Estado='Activo'
								ORDER BY cama_Tipo";
								$resCama = $conexion->BD_Consulta($sqlCama);
								$tuplaCama = $conexion->BD_GetTupla($resCama);

								while ($tuplaCama != NULL) {
									if ($tuplaCama['cama_CodPK'] == $reserva_CamaFK)
										print("<option selected=\"selected\" value=\"" . $tuplaCama['cama_CodPK'] . "\">" . $tuplaCama['cama_Tipo'] . " - " . $tuplaCama['cama_Precio'] . "€</option>");
									else
										print("<option value=\"" . $tuplaCama['cama_CodPK'] . "\">" . $tuplaCama['cama_Tipo'] . " - " . $tuplaCama['cama_Precio'] . "€</option>");

									$tuplaCama = $conexion->BD_GetTupla($resCama);
								} //fin del while($tuplaCama!=NULL)
								?>
							</select>
						</div>
					</div>
					<br><br><br><br><br>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
					</div>
					<div class="col-xs-12 colsm-12 col-md-2 col-lg-3">
						<div class="form-group">
							<label>Entrada *</label>
							<div class="input-group date" id="datetimepicker1">
								<input type="date" name="reserva_Finicio" id="reserva_Finicio" class="form-control" required />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="col-xs-12 colsm-12 col-md-2 col-lg-3">
						<div class="form-group">
							<label>Salida *</label>
							<div class="input-group date" id="datetimepicker1">
								<input type="date" name="reserva_Ffin" id="reserva_Ffin" class="form-control" required />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Personas*</label>
							<input type="number" class="form-control" name="reserva_Npersonas" id="reserva_Npersonas" required />
						</div>
					</div>


					<div style="clear: both;"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br /><br />
						<div class="text-right">
							<a href="index.php" class="btn btn-danger">CANCELAR</a>
							<button class="btn " style="background-color: #2B475C;color:white;">RESERVAR</button>
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
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<script src="js/responsiveslides.min.js"></script>

	<!-- //smooth scrolling -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>



</body>

</html>