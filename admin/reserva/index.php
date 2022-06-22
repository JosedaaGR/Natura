<!DOCTYPE html>
<head>
<link rel="shortcut icon" href="../favicon.png">
</head>
<?PHP

session_start();

include_once "../../clases/fun_aux_menu_intranet.php";
include_once "../../clases/conexion.php";
include_once "../../clases/comprobar_usuario.php";
include_once "../../clases/ui.notificacion.php";
include_once "../../clases/usuario.php";
include_once "../../clases/reserva.php";
include_once "../../clases/fechas.php";

$conexion = new conexion();
$url_sitio = $conexion->url_sitio;
$nombre_empresa = $conexion->nombre_empresa_panel_control;

$reserva = new reserva();

$vectorUsuario = Seguridad();

$mensaje = "";

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
	if ($mensaje != "")
		EjecutarCorrecto();
}

if (isset($_GET['reserva_CodPK'])) {
	$reserva_CodPK = $_GET['reserva_CodPK'];
	if(isset($_GET['activa'])){
		$condicion = "reserva_Estado='Activo' WHERE reserva_CodPK=" . $reserva_CodPK;
		$reserva->modificarEstado($condicion);
		print("<script>document.location.href='index.php?mensaje=• Reserva activada correctamente'</script>");
	}else{
		$condicion = "reserva_Estado='No_Activo' WHERE reserva_CodPK=" . $reserva_CodPK;
		$reserva->modificarEstado($condicion);
		print("<script>document.location.href='index.php?mensaje=• Reserva eliminada correctamente'</script>");
	}
	

} //fin if(isset($_GET['reserva_CodPK']))


?>
<html lang="es">

<head>
	<title>Panel de control Natura</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<!-- ===== FAVICON =====-->
	<link rel="shortcut icon" href="../favicon.png">
	<!-- ===== CSS =====-->
	<!-- General-->
	<link rel="stylesheet" href="../css/basic.css">
	<link rel="stylesheet" href="../css/general.css">
	<link rel="stylesheet" href="../css/theme.css" class="style-theme">

	<!-- Specific-->
	<link rel="stylesheet" href="../css/addons/fonts/artill-clean-icons.css" />
	<!--[if lt IE 9]>
    <script src="../js/basic/respond.min.js"></script>
    <script src="../js/basic/html5shiv.min.js"></script>
    <![endif]-->

	<style>
		th,td{
			text-align: center;
		}
	</style>
</head>

<body class="l-dashboard">
	<!--[if lt IE 9]>
    <p class="browsehappy">Su versión de navegador está <strong>absoleta</strong> por favor <a href="http://browsehappy.com/">Actualiza tu navegador</a> y mejorarás tu experiencia.</p>
    <![endif]-->
	<?PHP imprime_cabecera(); ?>

	<!--SECTION-->
	<section class="l-main-container">
		<!--Left Sidebar Content-->
		<?PHP imprime_sidebar("reserva"); ?>
		<!--Main Content-->
		<section class="l-container">
			<?PHP imprime_header(); ?>
			<div class="resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
				<div class="l-row l-spaced-bottom">
					<div class="l-box">
						<div class="l-box-header">

							<ul class="l-box-options">
								<li><a href="#" data-ason-type="fullscreen" data-ason-target=".l-box" data-ason-content="true" class="ason-widget"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" data-ason-type="refresh" data-ason-target=".l-box" data-ason-duration="1000" class="ason-widget"><i class="fa fa-rotate-right"></i></a></li>
								<li><a href="#" data-ason-type="toggle" data-ason-find=".l-box" data-ason-target=".l-box-body" data-ason-content="true" data-ason-duration="200" class="ason-widget"><i class="fa fa-chevron-down"></i></a></li>
							</ul>
						</div>
						<!--Para que la funcion de impresion funcione hace falta el script imprimirFilas-->
						<div class="row">
						<div class="form-group">
							<div class="col-sm-2">
								<form role="form" name="imprimir_form" id="imprimir_form" method="post" action="../impresion_listado.php" target="_blank">
									<input type="hidden" name="filas" id="filas" value="" />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button title="Imprimir Listado" id="imprimirFilas" type="submit" class="btn btn-dark clear-filter mr-20">Imprimir Excel</button>
								</form>
							</div>
							</div>
						</div>
						<br><br>
						<div class="row">
						<form class="form-horizontal" name="form_buscador" id="form_buscador" method="get" action="index.php">
								<div class="form-group">
									<?php
									$fechaInicio = date("d/m/Y");
									if (isset($_GET['fechaInicio'])) {
										$fechaInicio = $_GET['fechaInicio'];
									}
									?>
									<label for="fechaInicio" class="col-sm-1 control-label">F. Inicio</label>
									<div class="col-sm-2">
										<input name="fechaInicio" type="text" id="fechaInicio" value="<?PHP print($fechaInicio); ?>" class="form-control daterangepicker_6" />
									</div>
									<?php
									$fechaFin = date("d/m/Y", strtotime('+7 days'));
									if (isset($_GET['fechaFin'])) {
										$fechaFin = $_GET['fechaFin'];
									}
									?>
									<label for="fechaFin" class="col-sm-1 control-label">F. Fin</label>
									<div class="col-sm-2">
										<input name="fechaFin" id="fechaFin" type="text" value="<?PHP print($fechaFin); ?>" class="form-control daterangepicker_6" />
									</div>
									<?php
									$habitacion_busca = 0;
									if (isset($_GET['habitacion_busca'])) {
										$habitacion_busca = $_GET['habitacion_busca'];
									}
									?>

									<label for="habitacion_busca" class="col-sm-1 control-label">Habitacion</label>
									<div class="col-sm-2">
										<select name="habitacion_busca" id="habitacion_busca" class="form-control">
											<option value="">Todos</option>

											<?PHP
											$sqlColor = "SELECT * FROM habitacion WHERE habitacion_Estado='Activo' ORDER BY habitacion_Tipo ASC";
											$resColor = $conexion->BD_Consulta($sqlColor);
											$tuplaColor = $conexion->BD_GetTupla($resColor);

											while ($tuplaColor != NULL) {
												if ($tuplaColor['habitacion_CodPK'] == $habitacion_busca)
													print("<option value=\"" . $tuplaColor['habitacion_CodPK'] . "\" selected=\"selected\">" . $tuplaColor['habitacion_Tipo'] . "</option>");
												else
													print("<option value=\"" . $tuplaColor['habitacion_CodPK'] . "\">" . $tuplaColor['habitacion_Tipo'] . "</option>");

												$tuplaColor = $conexion->BD_GetTupla($resColor);
											} //fin del while($tuplaColor!=NULL)
											?>
										</select>
									</div>

								</div>
								<div class="form-group">

									<?php
									$cama_busca =0;
									if (isset($_GET['cama_busca'])) {
										$cama_busca = $_GET['cama_busca'];
									}
									?>
									<label for="cama_busca" class="col-sm-1 control-label">Cama</label>
									<div class="col-sm-2">
										<select name="cama_busca" id="cama_busca" class="form-control">
											<option value="">Todos</option>

											<?PHP
											$sqlOpera = "SELECT * FROM cama WHERE cama_Estado='Activo' ORDER BY cama_Tipo ASC";
											$resOpera = $conexion->BD_Consulta($sqlOpera);
											$tuplaOpera = $conexion->BD_GetTupla($resOpera);

											while ($tuplaOpera != NULL) {
												if ($tuplaOpera['cama_CodPK'] == $cama_busca)
													print("<option value=\"" . $tuplaOpera['cama_CodPK'] . "\" selected=\"selected\">" . $tuplaOpera['cama_Tipo'] . " " . $tuplaOpera['operario_Apellidos'] . "</option>");
												else
													print("<option value=\"" . $tuplaOpera['cama_CodPK'] . "\">" . $tuplaOpera['cama_Tipo'] . " " . $tuplaOpera['operario_Apellidos'] . "</option>");

												$tuplaOpera = $conexion->BD_GetTupla($resOpera);
											} //fin del while($tuplaOpera!=NULL)
											?>
										</select>
									</div>
									<?php
									$servicio_busca = 0;
									if (isset($_GET['servicio_busca'])) {
										$servicio_busca = $_GET['servicio_busca'];
									}
									?>
									<label for="servicio_busca" class="col-sm-1 control-label">Vehiculo</label>
									<div class="col-sm-2">
										<select name="servicio_busca" id="servicio_busca" class="form-control">
											<option value="">Todos</option>
											<?PHP
											$sqlVehi = "SELECT * FROM servicio WHERE servicio_Estado='Activo' ORDER BY servicio_Nombre ASC";
											$resVehi = $conexion->BD_Consulta($sqlVehi);
											$tuplaVehi = $conexion->BD_GetTupla($resVehi);

											while ($tuplaVehi != NULL) {
												if ($tuplaVehi['servicio_CodPK'] == $servicio_busca)
													print("<option value=\"" . $tuplaVehi['servicio_CodPK'] . "\" selected=\"selected\">" . $tuplaVehi['servicio_Nombre'] . "</option>");
												else
													print("<option value=\"" . $tuplaVehi['servicio_CodPK'] . "\">" . $tuplaVehi['servicio_Nombre'] . "</option>");

												$tuplaVehi = $conexion->BD_GetTupla($resVehi);
											} //fin del while($tuplaVehi!=NULL)
											?>
										</select>
									</div>
									<?php
									$estado_busca = '';
									if (isset($_GET['estado_busca'])) {
										$estado_busca = $_GET['estado_busca'];
									}
									?>
									<label for="estado_busca" class="col-sm-1 control-label">Estado</label>
									<div class="col-sm-2">
										<select name="estado_busca" id="estado_busca" class="form-control">
											<?PHP
											if (trim($estado_busca) == "")
												print("<option value=\"\" selected=\"selected\">Todos</option>");
											else
												print("<option value=\"\">Todos</option>");

											if (strcmp($estado_busca, "Activo") == 0)
												print("<option value=\"Activo\" selected=\"selected\">Realizada</option>");
											else
												print("<option value=\"Activo\">Realizada</option>");

											if (strcmp($estado_busca, "No_Activo") == 0)
												print("<option value=\"No_Activo\" selected=\"selected\">Eliminada</option>");
											else
												print("<option value=\"No_Activo\">Eliminada</option>");

											?>
										</select>
									</div>
								</div>
								<div class="form-group" style="text-align: right">
									<button type="submit" style="margin-right: 50px" class="btn btn-dark">Buscar</button>
								</div>
							</form>
						</div>
						<div class="l-box-body">
							<div>
								<form role="form" class="form-inline pull-right" name="buscador_form" id="buscador_form" method="post" action="index.php">
									<div class="col-md-12">
										<br />
										<a href="reserva_add.php" class="btn btn-primary btn-lg pull-right"><i class="fa fa-plus"></i> Añadir</a>
									</div>
								</form>
							</div>
							<div id="dataTableId_wrapper" class="dataTables_wrapper">
							<table id="dataTableId" cellspacing="0" width="100%" class="display dataTable" role="grid" aria-describedby="dataTableId_info" style="width: 100%;">
										<thead>
											<tr role="row">
												<th rowspan="1" colspan="1">Usuario Reserva</th>
												<th rowspan="1" colspan="1">Habitacion</th>
												<th rowspan="1" colspan="1">Cama</th>
												<th rowspan="1" colspan="1">Fecha Inicio</th>
												<th rowspan="1" colspan="1">Fecha Fin</th>
												<th rowspan="1" colspan="1">Nº Personas</th>
												<th rowspan="1" colspan="1">Precio Total</th>
												<th rowspan="1" colspan="1">Estado</th>
												<th id="impresion_invisible" rowspan="1" colspan="1" align="center" style="width: 180px;text-align:center;">Acciones</th>
											</tr>
										</thead>
										<tfoot>
											<tr role="row">
											<th rowspan="1" colspan="1">Usuario Reserva</th>
												<th rowspan="1" colspan="1">Habitacion</th>
												<th rowspan="1" colspan="1">Cama</th>
												<th rowspan="1" colspan="1">Fecha Inicio</th>
												<th rowspan="1" colspan="1">Fecha Fin</th>
												<th rowspan="1" colspan="1">Nº Personas</th>
												<th rowspan="1" colspan="1">Precio</th>
												<th rowspan="1" colspan="1">Estado</th>
												<th id="impresion_invisible" rowspan="1" colspan="1" align="center" style="width: 180px;text-align:center;">Acciones</th>
											</tr>
										</tfoot>
										<tbody>
											<?PHP

											if (isset($_GET['fechaInicio'])) {

												$fechaInicio = $_GET['fechaInicio'];
												$fechaFin = $_GET['fechaFin'];
												$habitacion_busca = $_GET['habitacion_busca'];
												$cama_busca = $_GET['cama_busca'];
												$servicio_busca = $_GET['servicio_busca'];
												$estado_busca = $_GET['estado_busca'];

												$sqlreserva = "SELECT * FROM reserva INNER JOIN habitacion ON reserva_HabitacionFK=habitacion_CodPK
												INNER JOIN cama ON reserva_CamaFK=cama_CodPK INNER JOIN usuario ON reserva_UsuarioFK=usuario_CodPK INNER JOIN servicio ON reserva_ServicioFK=servicio_CodPK  WHERE 1=1";

												if (trim($fechaInicio) != "")
													$sqlreserva = $sqlreserva . " AND reserva_Finicio>='" . cambiaf_a_mysql($fechaInicio) . "'";

												if (trim($fechaFin) != "")
													$sqlreserva = $sqlreserva . " AND reserva_Finicio<='" . cambiaf_a_mysql($fechaFin) . "'";

												if (trim($habitacion_busca) != "")
													$sqlreserva = $sqlreserva . " AND habitacion_CodPK='" . $habitacion_busca . "'";

												if (trim($cama_busca) != "")
													$sqlreserva = $sqlreserva . " AND cama_CodPK='" . $cama_busca . "'";

												if (trim($servicio_busca) != "")
													$sqlreserva = $sqlreserva . " AND servicio_CodPK='" . $servicio_busca . "'";

												if (trim($estado_busca) != "")
													$sqlreserva = $sqlreserva . " AND reserva_Estado='" . $estado_busca . "'";

												$resreserva = $conexion->BD_Consulta($sqlreserva);
												$tuplareserva = $conexion->BD_GetTupla($resreserva);

												$i = 0;
												while ($tuplareserva != NULL) {

													if($tuplareserva['reserva_Finicio']!=$tuplareserva['reserva_Ffin']){
														$date1 = new DateTime($tuplareserva['reserva_Finicio']);
														$date2 = new DateTime($tuplareserva['reserva_Ffin']);
														$diff = $date1->diff($date2);
														$precio=(($tuplareserva['cama_Precio']+$tuplareserva['habitacion_Precio']+$tuplareserva['servicio_Precio'])*$tuplareserva['reserva_Npersonas'])*$diff->days;
														}else{
														$precio=(($tuplareserva['cama_Precio']+$tuplareserva['habitacion_Precio']+$tuplareserva['servicio_Precio'])*$tuplareserva['reserva_Npersonas']);
														}
													$i++;
												
													print("<tr role=\"row\" class=\"odd\">
													<td>" . $tuplareserva['usuario_Nombre'] . " ".$tuplareserva['usuario_Apellidos']."</td>
													<td >" . $tuplareserva['habitacion_Tipo'] . "</td>
													<td>" . $tuplareserva['cama_Tipo'] . "</td>
													<td>" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</td>
													<td >" . cambiaf_a_normal($tuplareserva['reserva_Ffin']) . "</td>
													<td>" . $tuplareserva['reserva_Npersonas'] . "</td>
													<td style=\"text-align: center;\">" . $precio . " €</td>");

													if ($tuplareserva['reserva_Estado'] == "No_Activo") {
														print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"2\">
													<span title=\"Suspended\" class=\"label label-danger\">Eliminada</span>
													</td>");
													}  else {
														print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"5\">
													<span title=\"Active\" class=\"label label-success\">Realizada</span>
													</td>");
													}

													print("<td id=\"impresion_invisible\" style=\"text-align:center;\">
													<a href=\"reserva_mod.php?reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Editar</a>");

													if ($tuplareserva['reserva_Estado'] == "Activo") {
														print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#basicModal" . $i . "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i> Eliminar</a>
														");
													} else {
														print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#AcbasicModal" . $i . "\" class=\"btn btn-info btn-sm\"><i class=\"fa fa-level-up\"></i> Activar</a>
														");
													}													
													print("</td>
													</tr>

													<div id=\"AcbasicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
													<div class=\"modal-dialog\">
														<div class=\"modal-content\">
														<div class=\"modal-header\">
															<button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
															<h4 id=\"basicModalLabel\" class=\"modal-title\">Activar reserva " . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</h4>
														</div>
														<div class=\"modal-body\">Está usted seguro de querer activar la reserva del <b>" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</b> al <b>".cambiaf_a_normal($tuplareserva['reserva_Ffin'])."</b></div>
															<div class=\"modal-footer\">
															<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
															<button type=\"button\" onclick=\"document.location.href='index.php?activa&reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "'\" class=\"btn btn-info\">Activar</button>
															</div>
														</div>
														</div>
													</div>
													</div>


													<div id=\"basicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
														<div class=\"modal-dialog\">
														<div class=\"modal-content\">
															<div class=\"modal-header\">
															<button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
															<h4 id=\"basicModalLabel\" class=\"modal-title\">Eliminar la reserva del dia " . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</h4>
															</div>
															<div class=\"modal-body\">Está usted seguro de querer eliminar la reserva del <b>" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</b> al <b>".cambiaf_a_normal($tuplareserva['reserva_Ffin'])."</b></div>
															<div class=\"modal-footer\">
															<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
															<button type=\"button\" onclick=\"document.location.href='index.php?reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "&eliminado'\" class=\"btn btn-danger\">Eliminar</button>
															</div>
														</div>
														</div>
													</div>");

													$tuplareserva = $conexion->BD_GetTupla($resreserva);
												} //fin del while($tuplareserva!=NULL)

											} else {

												$sqlreserva = "SELECT * FROM reserva INNER JOIN habitacion ON reserva_HabitacionFK=habitacion_CodPK
												INNER JOIN cama ON reserva_CamaFK=cama_CodPK INNER JOIN usuario ON reserva_UsuarioFK=usuario_CodPK INNER JOIN servicio ON reserva_ServicioFK=servicio_CodPK ";
												$resreserva = $conexion->BD_Consulta($sqlreserva);
												$tuplareserva = $conexion->BD_GetTupla($resreserva);
												$i = 0;

												while ($tuplareserva != NULL) {
													$i++;

													$date1 = new DateTime($tuplareserva['reserva_Finicio']);
													$date2 = new DateTime($tuplareserva['reserva_Ffin']);
													$diff = $date1->diff($date2);
													$precio=(($tuplareserva['cama_Precio']+$tuplareserva['habitacion_Precio']+$tuplareserva['servicio_Precio'])*$tuplareserva['reserva_Npersonas'])*$diff->days;

													print("<tr role=\"row\" class=\"odd\">
													<td style=\"text-align: center;\">" . $tuplareserva['usuario_Nombre'] . " ".$tuplareserva['usuario_Apellidos']."</td>
													<td style=\"text-align: center;\">" . $tuplareserva['habitacion_Tipo'] . "</td>
													<td style=\"text-align: center;\">" . $tuplareserva['cama_Tipo'] . "</td>
													<td style=\"text-align: center;\">" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</td>
													<td style=\"text-align: center;\">" . cambiaf_a_normal($tuplareserva['reserva_Ffin']) . "</td>
													<td style=\"text-align: center;\">" . $tuplareserva['reserva_Npersonas'] . "</td>
													<td style=\"text-align: center;\">" . $precio . " €</td>");
													if ($tuplareserva['reserva_Estado'] == "No_Activo") {
														print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"2\">
													<span title=\"Suspended\" class=\"label label-danger\">Eliminada</span>
													</td>");
													}  else {
														print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"5\">
													<span title=\"Active\" class=\"label label-success\">Realizada</span>
													</td>");
													}

													print("
													<td id=\"impresion_invisible\" style=\"text-align:center;\">
													<a href=\"reserva_mod.php?reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Editar</a>");
													
													if ($tuplareserva['reserva_Estado'] == "Activo") {
														print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#basicModal" . $i . "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i> Eliminar</a>
														");
													} else {
														print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#AcbasicModal" . $i . "\" class=\"btn btn-info btn-sm\"><i class=\"fa fa-level-up\"></i> Activar</a>
														");
													}	
													
													print("</td>
													</tr>


														<div id=\"AcbasicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
														<div class=\"modal-dialog\">
															<div class=\"modal-content\">
															<div class=\"modal-header\">
																<button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
																<h4 id=\"basicModalLabel\" class=\"modal-title\">Activar reserva " . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</h4>
															</div>
															<div class=\"modal-body\">Está usted seguro de querer activar la reserva del <b>" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</b> al <b>".cambiaf_a_normal($tuplareserva['reserva_Ffin'])."</b></div>
																<div class=\"modal-footer\">
																<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
																<button type=\"button\" onclick=\"document.location.href='index.php?activa&reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "'\" class=\"btn btn-info\">Activar</button>
																</div>
															</div>
															</div>
														</div>
														</div>

													<div id=\"basicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
														<div class=\"modal-dialog\">
														<div class=\"modal-content\">
															<div class=\"modal-header\">
															<button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
															<h4 id=\"basicModalLabel\" class=\"modal-title\">Eliminar la reserva del dia " . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</h4>
															</div>
															<div class=\"modal-body\">Está usted seguro de querer eliminar la reserva del <b>" . cambiaf_a_normal($tuplareserva['reserva_Finicio']) . "</b> al <b>".cambiaf_a_normal($tuplareserva['reserva_Ffin'])."</b></div>
															<div class=\"modal-footer\">
															<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
															<button type=\"button\" onclick=\"document.location.href='index.php?reserva_CodPK=" . $tuplareserva['reserva_CodPK'] . "&eliminado'\" class=\"btn btn-danger\">Eliminar</button>
															</div>
														</div>
														</div>
													</div>");

													$tuplareserva = $conexion->BD_GetTupla($resreserva);
												} //fin del while($tuplareserva!=NULL)
											}
											?>
										</tbody>
									</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--FOOTER-->

			<?PHP imprime_pie(); ?>

		</section>

	</section>

	<!-- ===== JS =====-->
	<!-- jQuery-->
	<script src="../js/basic/jquery.min.js"></script>
	<script src="../js/basic/jquery-migrate.min.js"></script>
	<!-- General-->
	<script src="../js/basic/modernizr.min.js"></script>
	<script src="../js/basic/bootstrap.min.js"></script>
	<script src="../js/shared/jquery.asonWidget.js"></script>
	<script src="../js/plugins/plugins.js"></script>
	<script src="../js/general.js"></script>
	<script>
		$(document).ready(function () {
    $('#dataTableId').DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
    });
});
	</script>
	<script>
		//Hacer que se impriman solo las columnas deseadas.
		//Debes poner id='invisible' en thead, tfoot y td
		$(document).ready(function() {
			$('#imprimirFilas').click(function() {
				var e = $('#dataTableId_wrapper').clone();
				$('#impresion_invisible', e).remove();
				var datosFilas = e.html();
				$('#filas').val('' + datosFilas);
			});
		});

		//Hacer que se impriman solo las columnas deseadas.
		//Debes poner id='invisible' en thead, tfoot y td
		$(document).ready(function() {
			$('#imprimirFilasPDF').click(function() {
				var e = $('#dataTableId_wrapper').clone();
				$('#impresion_invisible', e).remove();
				var datosFilas = e.html();
				$('#filasPDF').val('' + datosFilas);
			});
		});
	</script>
	<!-- Semi general-->
	<script type="text/javascript">
		var paceSemiGeneral = {
			restartOnPushState: false
		};
		if (typeof paceSpecific != 'undefined') {
			var paceOptions = $.extend({}, paceSemiGeneral, paceSpecific);
			paceOptions = paceOptions;
		} else {
			paceOptions = paceSemiGeneral;
		}
	</script>

	<script src="../js/plugins/pageprogressbar/pace.min.js"></script>
	<script src="../js/plugins/pageprogressbar/pace.min.js"></script>
	<!-- Mensajes emergentes-->
	<script src="../js/plugins/notifications/jquery.toastr.min.js"></script>
	<!-- MENSAJES -->
	<?php notification($mensaje) ?>

	<script src="../js/plugins/datetime/bootstrap-datepicker.min.js"></script>
    <script src="../js/shared/moment.min.js"></script>
    <script src="../js/plugins/datetime/daterangepicker.js"></script>
    <script src="../js/calls/ui.datetime.js"></script>

	<!-- Specific-->
	<script src="../js/shared/classie.js"></script>
	<script src="../js/shared/jquery.cookie.min.js"></script>
	<script src="../js/shared/perfect-scrollbar.min.js"></script>
	<script src="../js/plugins/accordions/jquery.collapsible.min.js"></script>
	<script src="../js/plugins/forms/elements/jquery.bootstrap-touchspin.min.js"></script>
	<script src="../js/plugins/forms/elements/jquery.checkBo.min.js"></script>
	<script src="../js/plugins/forms/elements/jquery.switchery.min.js"></script>
	<script src="../js/plugins/table/jquery.dataTables.min.js"></script>
	<script src="../js/plugins/tabs/jquery.easyResponsiveTabs.js"></script>
	<script src="../js/plugins/tooltip/jquery.tooltipster.min.js"></script>
	<script src="../js/calls/part.header.1.js"></script>
	<script src="../js/calls/part.sidebar.2.js"></script>
	<script src="../js/calls/part.theme.setting.js"></script>
	<script src="../js/calls/table.data.js"></script>
	<script src="../js/plugins/table/dataTables.autoFill.min.js"></script>
	<script src="../js/plugins/table/dataTables.colReorder.min.js"></script>
	<script src="../js/plugins/table/dataTables.colVis.min.js"></script>
	<script src="../js/plugins/table/dataTables.responsive.min.js"></script>
	
</body>

</html>