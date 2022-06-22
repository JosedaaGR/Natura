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

$conexion = new conexion();
$url_sitio = $conexion->url_sitio;
$nombre_empresa = $conexion->nombre_empresa_panel_control;

$usuario = new usuario();

$vectorUsuario = Seguridad();

$mensaje = "";

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
	if ($mensaje != "")
		EjecutarCorrecto();
}

if (isset($_GET['usuario_CodPK'])) {
	$usuario_CodPK = $_GET['usuario_CodPK'];
	if (isset($_GET['activa'])) {
		$condicion = "usuario_Estado='Activo' WHERE usuario_CodPK=" . $usuario_CodPK;
		$usuario->modificarEstado($condicion);
		print("<script>document.location.href='index.php?mensaje=• Usuario activado correctamente'</script>");
	} else {
		$condicion = "usuario_Estado='No_Activo' WHERE usuario_CodPK=" . $usuario_CodPK;
		$usuario->modificarEstado($condicion);
		print("<script>document.location.href='index.php?mensaje=• Usuario eliminado correctamente'</script>");
	}
} //fin if(isset($_GET['usuario_CodPK']))


$sqlCom = "SELECT * FROM usuario WHERE usuario_Usuario='" . $_SESSION['username_pcontrol_new5'] . "' AND usuario_Pass='" . $_SESSION['password_pcontrol_new5'] . "'";
$resCom = $conexion->BD_Consulta($sqlCom);
$tuplaCom = $conexion->BD_GetTupla($resCom);
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
		th,
		td {
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
		<?PHP imprime_sidebar("usuario"); ?>
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
						<div class="form-group">
							<div class="col-sm-1">
								<form role="form" name="imprimir_form" id="imprimir_form" method="post" action="../impresion_listado.php" target="_blank">
									<input type="hidden" name="filas" id="filas" value="" />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button title="Imprimir Listado" id="imprimirFilas" type="submit" class="btn btn-dark clear-filter mr-20">Imprimir Excel</button>
								</form>
							</div>
							<div class="col-sm-1"></div>
							
						</div>
						<div class="l-box-body">
							<div>
								<form role="form" class="form-inline pull-right" name="buscador_form" id="buscador_form" method="post" action="index.php">
									<div class="col-md-12">
										<br />
										<a href="usuario_add.php" class="btn btn-primary btn-lg pull-right"><i class="fa fa-plus"></i> Añadir</a>
									</div>
								</form>
							</div>
							<div id="dataTableId_wrapper" class="dataTables_wrapper">
								<table id="dataTableId" cellspacing="0" width="100%" class="display dataTable" role="grid" aria-describedby="dataTableId_info" style="width: 100%;">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Apellidos</th>
											<th rowspan="1" colspan="1">DNI</th>
											<th rowspan="1" colspan="1">Direccion</th>
											<th rowspan="1" colspan="1">Telefono</th>
											<th rowspan="1" colspan="1">Email</th>
											<th rowspan="1" colspan="1">Estado</th>
											<th id="impresion_invisible" rowspan="1" colspan="1" style="width: 180px;text-align:center;">Acciones</th>
										</tr>
									</thead>
									<tfoot>
										<tr role="row">
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Apellidos</th>
											<th rowspan="1" colspan="1">DNI</th>
											<th rowspan="1" colspan="1">Direccion</th>
											<th rowspan="1" colspan="1">Telefono</th>
											<th rowspan="1" colspan="1">Email</th>
											<th rowspan="1" colspan="1">Estado</th>
											<th id="impresion_invisible" rowspan="1" colspan="1" style="width: 180px;text-align:center;">Acciones</th>
										</tr>
									</tfoot>
									<tbody>
										<?PHP
										$sqlUsuario = "SELECT * FROM usuario WHERE usuario_Tipo='Cliente'";
										$resUsuario = $conexion->BD_Consulta($sqlUsuario);
										$tuplaUsuario = $conexion->BD_GetTupla($resUsuario);
										$i = 0;
										while ($tuplaUsuario != NULL) {
											$i++;
											print("<tr role=\"row\" class=\"odd\">
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_Nombre'] . "</td>
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_Apellidos'] . "</td>
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_DNI'] . "</td>
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_Direccion'] . "</td>
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_Telefono'] . "</td>
											<td class=\"sorting_1\">" . $tuplaUsuario['usuario_Email'] . "</td>
											");
											if ($tuplaUsuario['usuario_Estado'] == "Activo") {
												print("<td  class=\"footable-visible footable-last-column\" data-value=\"1\">
												<span title=\"Cobrado\" class=\"label label-success\">Activo</span>
												</td>");
											} else {
												print("<td  class=\"footable-visible footable-last-column\" data-value=\"2\">
											<span title=\"Active\" class=\"label label-danger\">Inactivo</span>
											</td>");
															}

											print("
												<td id=\"impresion_invisible\">
													<a href=\"usuario_mod.php?usuario_CodPK=" . $tuplaUsuario['usuario_CodPK'] . "\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Editar</a>

												");
											if ($tuplaUsuario['usuario_Estado'] == "Activo") {
												print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#basicModal" . $i . "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i> Eliminar</a>
													");
											} else {
												print("<a href=\"#\" data-toggle=\"modal\" data-target=\"#AcbasicModal" . $i . "\" class=\"btn btn-info btn-sm\"><i class=\"fa fa-level-up\"></i> Activar</a>
													");
											}

											print("
								</td>
						    </tr>

							<div id=\"AcbasicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
							<div class=\"modal-dialog\">
							    <div class=\"modal-content\">
								<div class=\"modal-header\">
								    <button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
								    <h4 id=\"basicModalLabel\" class=\"modal-title\">Activar a " . $tuplaUsuario['usuario_Nombre'] . "</h4>
								</div>
								<div class=\"modal-body\">Está usted seguro de querer activar: <b>" . $tuplaUsuario['usuario_Nombre'] . "</b></div>
								    <div class=\"modal-footer\">
									<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
									<button type=\"button\" onclick=\"document.location.href='index.php?activa&usuario_CodPK=" . $tuplaUsuario['usuario_CodPK'] . "'\" class=\"btn btn-info\">Activar</button>
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
								    <h4 id=\"basicModalLabel\" class=\"modal-title\">Eliminar a " . $tuplaUsuario['usuario_Nombre'] . "</h4>
								</div>
								<div class=\"modal-body\">Está usted seguro de querer eliminar: <b>" . $tuplaUsuario['usuario_Nombre'] . "</b></div>
								    <div class=\"modal-footer\">
									<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
									<button type=\"button\" onclick=\"document.location.href='index.php?elimina&usuario_CodPK=" . $tuplaUsuario['usuario_CodPK'] . "'\" class=\"btn btn-danger\">Eliminar</button>
								    </div>
								</div>
							    </div>
							</div>
						    </div>");
											$tuplaUsuario = $conexion->BD_GetTupla($resUsuario);
										} //fin del while($tuplaUsuario!=NULL)
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
		$(document).ready(function() {
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