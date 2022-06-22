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
include_once "../../clases/habitacion.php";

$conexion = new conexion();
$url_sitio = $conexion->url_sitio;
$Tipo_empresa = $conexion->nombre_empresa_panel_control;

$habitacion = new habitacion();

$vectorusuario = Seguridad();
$errores='';
$mensaje = "";

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
	if ($mensaje != "")
		EjecutarCorrecto();
}

if (isset($_POST['aux'])) {
    $habitacion_CodPK = str_replace("'", "\"", $_POST['habitacion_CodPK']);
    $habitacion_CodPK = str_replace("\"", "", $habitacion_CodPK);
    $habitacion_Tipo = str_replace("'", "\"", $_POST['habitacion_Tipo']);
    $habitacion_Tipo = str_replace("\"", "", $habitacion_Tipo);
    $habitacion_Precio = str_replace("'", "\"", $_POST['habitacion_Precio']);
    $habitacion_Precio = str_replace("\"", "", $habitacion_Precio);
    $habitacion_Observaciones = str_replace("'", "\"", $_POST['habitacion_Observaciones']);
    $habitacion_Observaciones = str_replace("\"", "", $habitacion_Observaciones);
    $habitacion_Estado = str_replace("'", "\"", $_POST['habitacion_Estado']);
    $habitacion_Estado = str_replace("\"", "", $habitacion_Estado);

    //repetido Tipo 
    $sqlRepetido = "SELECT * FROM habitacion WHERE habitacion_CodPK!=0
	    AND habitacion_Tipo LIKE '" . $habitacion_Tipo . "'";
    if ($habitacion_CodPK != 0)
        $sqlRepetido = $sqlRepetido . " AND habitacion_CodPK!=" . $habitacion_CodPK;

    $resRepetido = $conexion->BD_Consulta($sqlRepetido);
    $tuplaRepetido = $conexion->BD_GetTupla($resRepetido);

    if ($tuplaRepetido != NULL)
        $errores = $errores . "Error: El nombre se encuentra repetido.<br/>";

    if (trim($errores) != "") {
        $mensaje = $errores;
        EjecutarError();
    } //fin del if(trim($errores)!="")
    else {
        if ($habitacion_CodPK == 0) {
            //INSERTAR
            $res = $habitacion->insertar($habitacion_Tipo, $habitacion_Precio,$habitacion_Observaciones, $habitacion_Estado);

            if ($res == true) {
                print("<script>document.location.href='index.php?mensaje= Habitacion insertada.'</script>");
                exit();
            } else {
                $mensaje = "Error: Habitacion NO insertado.";
                EjecutarError();
            }
        } //fin del if($habitacion_CodPK==0)
        else {
            //MODIFICAR
            $res = $habitacion->modificar($habitacion_Tipo, $habitacion_Precio,$habitacion_Observaciones, $habitacion_Estado, $habitacion_CodPK);

            if ($res == true) {
                print("<script>document.location.href='index.php?mensaje= Habitacion modificada.'</script>");
                exit();
            } else {
                $mensaje = "Error: Habitacion NO modificada.";
                EjecutarError();
            }
        } //fin del else if($habitacion_CodPK==0)
    } //fin del else del if(trim($errores)!="")
} //fin del if(isset($_POST['aux']))   
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Panel de control</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<!-- ===== FAVICON =====-->
	<link rel="shortcut icon" href="../favicon.ico">
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
		<?PHP imprime_sidebar("habitacion"); ?>
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
						</div>
						<div class="l-box-body">
						<div>
                                <form role="form" class="form-inline pull-right" name="buscador_form" id="buscador_form" method="post" action="index.php">
                                    <div class="col-md-12">
                                        <br />
                                        <a data-toggle="modal" data-target="#basicModalAdd" class="btn btn-primary btn-lg pull-right"><i class="fa fa-plus"></i> Añadir</a>
                                    </div>
                                </form>
                            </div>
						<div>
			    
                            
						<div id="dataTableId_wrapper" class="dataTables_wrapper">
                                <table id="dataTableId" cellspacing="0" width="100%" class="display dataTable" role="grid" aria-describedby="dataTableId_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th rowspan="1" colspan="1">Tipo</th>
                                            <th rowspan="1" colspan="1">Precio</th>
                                            <th rowspan="1" colspan="1">Observaciones</th>
                                            <th rowspan="1" colspan="1">Estado</th>
                                            <th id="impresion_invisible" rowspan="1" colspan="1" align="center" style="width: 180px;text-align:center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr role="row">
                                            <th rowspan="1" colspan="1">Tipo</th>
                                            <th rowspan="1" colspan="1">Precio</th>
                                            <th rowspan="1" colspan="1">Observaciones</th>
                                            <th rowspan="1" colspan="1">Estado</th>
                                            <th rowspan="1" colspan="1" align="center" style="width: 180px;text-align:center;">Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?PHP
                                        $sqlhabit = "SELECT * FROM habitacion";
                                        $reshabit = $conexion->BD_Consulta($sqlhabit);
                                        $tuplahabitacion = $conexion->BD_GetTupla($reshabit);
                                        $i = 0;
                                        $modalMod = "";

                                        while ($tuplahabitacion != NULL) {
                                            $i++;
                                            print("<tr role=\"row\" class=\"odd\">
							                        <td class=\"sorting_1\">" . $tuplahabitacion['habitacion_Tipo'] . "</td>							
							                        <td>" . $tuplahabitacion['habitacion_Precio'] . " €</td>
							                        <td>" . $tuplahabitacion['habitacion_Observaciones'] . " </td>
                                                    
                                                    ");
                                            if ($tuplahabitacion['habitacion_Estado'] == "Activo") {
                                                print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"1\">
                                                        <span title=\"Active\" class=\"label label-success\">Activo</span>
                                                    </td>");
                                            } //fin del if ($tuplahabitacion['habitacion_Estado'] == "Si")
                                            else {
                                                print("<td style=\"text-align: center;\" class=\"footable-visible footable-last-column\" data-value=\"3\">
                                                        <span title=\"Suspended\" class=\"label label-danger\">No_Activo</span>
                                                    </td>");
                                            } //fin del else ($tuplahabitacion['habitacion_Estado'] == "Si")
                                            print("							
							                        <td id=\"impresion_invisible\" style=\"text-align:center;\">");

                                            if ($tuplahabitacion['habitacion_CodPK'] != 0)
                                                print("<a data-toggle=\"modal\" data-target=\"#basicModalMod" . $i . "\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-pencil\"></i> Editar</a>");
                                            print("</td>
						                    </tr>");

                                            $modalMod = $modalMod . "<div id=\"basicModalMod" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
                                            <div class=\"modal-dialog\">
                                                <div class=\"modal-content\">
                                                <div class=\"modal-header\">
                                                    <button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
                                                    <h4 id=\"basicModalLabel\" class=\"modal-title\">Modificar habitacion</h4>
                                                </div>
                                                <form class=\"form-horizontal\" name=\"formInsertar\" id=\"formInsertar\" method=\"post\" action=\"index.php\">
                                                    <input type=\"hidden\" name=\"aux\" id=\"aux\" />
                                                    <input type=\"hidden\" name=\"habitacion_CodPK\" id=\"habitacion_CodPK\" value=\"" . $tuplahabitacion['habitacion_CodPK'] . "\" />
                                                    <div class=\"modal-body\">
                                                    <div class=\"form-group\">
                                                        <label for=\"habitacion_Tipo\" class=\"col-sm-2 control-label\">Tipo *</label>
                                                        <div class=\"col-sm-10\">
                                                        <input id=\"habitacion_Tipo\" value=\"" . $tuplahabitacion['habitacion_Tipo'] . "\" name=\"habitacion_Tipo\" type=\"text\" class=\"form-control\" aria-required=\"true\" required />
                                                        
                                                        </div>
                                                    </div>
                                                    <div class=\"form-group\">
                                                        <label for=\"habitacion_Precio\" class=\"col-sm-2 control-label\">Precio *</label>
                                                        <div class=\"col-sm-3\">
                                                        <input id=\"habitacion_Precio\" value=\"" . $tuplahabitacion['habitacion_Precio'] . "\" name=\"habitacion_Precio\" type=\"number\" class=\"form-control\" aria-required=\"true\" required />
                
                                                        </div>
                                                    </div>
                                                    <div class=\"form-group\">
                                                        <label for=\"habitacion_Observaciones\" class=\"col-sm-2 control-label\">Precio *</label>
                                                        <div class=\"col-sm-3\">
                                                        <textarea name=\"habitacion_Observaciones\" id=\"habitacion_Observaciones\" cols=\"30\" rows=\"10\" style=\"width: 395px; height: 118px;\">".$tuplahabitacion['habitacion_Observaciones']."</textarea>
                
                                                        </div>
                                                    </div>
                                                    <div class=\"form-group\">
                                                    <label for=\"habitacion_Estado\" class=\"col-sm-2 control-label\">Estado </label>
                                                    <div class=\"col-sm-10\">
                                                    <select name=\"habitacion_Estado\" id=\"habitacion_Estado\" class=\"form-control\">" . estado($tuplahabitacion['habitacion_Estado']) . "
                                                    
                                                </select>                    
                                                    </div>
                                                </div>											
                                                    </div>
                                                    <div class=\"modal-footer\">
                                                    <button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-danger\">Cerrar</button>
                                                    <button type=\"submit\" class=\"btn btn-success\">Guardar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>";

                                            $tuplahabitacion = $conexion->BD_GetTupla($reshabit);
                                        } //fin del while($tuplahabitacion!=NULL)
                                        ?>
                                    </tbody>
                                </table>
                            </div>
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
					<!--FOOTER-->
					<div id="basicModalAdd" role="dialog" aria-labelledby="basicModalLabel" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            <h4 id="basicModalLabel" class="modal-title">Insertar habitacion</h4>
                        </div>
                        <form class="form-horizontal" name="formInsertar" id="formInsertar" method="post" action="index.php">
                            <input type="hidden" name="aux" id="aux" />
                            <input type="hidden" name="habitacion_CodPK" id="habitacion_CodPK" value="0" />
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="habitacion_Tipo" class="col-sm-2 control-label">Tipo *</label>
                                    <div class="col-sm-10">
                                        <input id="habitacion_Tipo" value="" name="habitacion_Tipo" type="text" class="form-control" aria-required="true" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="habitacion_Precio" class="col-sm-2 control-label" >Precio *</label>
                                    <div class="col-sm-3">
                                        <input id="habitacion_Precio" value="" name="habitacion_Precio" type="number"  class="form-control"  aria-required="true" required/> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="habitacion_Observaciones" class="col-sm-2 control-label" >Observaciones</label>
                                    <div class="col-sm-3">
                                    <textarea name="habitacion_Observaciones" id="habitacion_Observaciones" cols="30" rows="10" style="width: 395px; height: 118px;"></textarea>                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="habitacion_Estado" class="col-sm-2 control-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select name="habitacion_Estado" id="habitacion_Estado" class="form-control">
                                            <option value="Activo" selected="selected">Activo</option>
                                            <option value="No_Activo">No_Activo</option>"

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button style="float:left" type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?PHP print($modalMod); ?>

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