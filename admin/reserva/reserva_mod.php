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
$vectorUsuario = Seguridad();
$nombre_empresa = $conexion->nombre_empresa_panel_control;

$reserva = new reserva();

if (isset($_GET['reserva_CodPK']))
    $reserva_CodPK = $_GET['reserva_CodPK'];

$mensaje = "";
$errores = "";

if (isset($_GET['mensaje'])) {
    $errores = $_GET['mensaje'];
    if ($errores != "") {
        EjecutarCorrecto();
    }
}

if (isset($_POST['aux'])) {
    $reserva_UsuarioFK=str_replace("'","\"",$_POST['reserva_UsuarioFK']);
    $reserva_HabitacionFK=str_replace("'","\"",$_POST['reserva_HabitacionFK']);
    $reserva_CamaFK=str_replace("'","\"",$_POST['reserva_CamaFK']);
    $reserva_ServicioFK=str_replace("'","\"",$_POST['reserva_ServicioFK']);
    $reserva_Finicio=str_replace("'","\"",$_POST['reserva_Finicio']);
    $reserva_Ffin=str_replace("'","\"",$_POST['reserva_Ffin']);
    $reserva_Npersonas=str_replace("'","\"",$_POST['reserva_Npersonas']);
    $reserva_CodPK = $_POST['reserva_CodPK'];

    if ($reserva_Ffin<$reserva_Finicio)
        $errores = $errores . "La fecha de salida tiene que ser posterior a la de entrada";

    $sqlReserva = "SELECT COUNT(*) todo FROM reserva WHERE reserva_Finicio<='".$reserva_Ffin."' AND reserva_Ffin>='".$reserva_Finicio."'  AND reserva_HabitacionFK='".$reserva_HabitacionFK."'AND reserva_Estado='Activo'";
        $resReserva = $conexion->BD_Consulta($sqlReserva);
        $vectorReserva = $conexion->BD_GetTupla($resReserva);

        if ($vectorReserva['todo']>=3)
            $errores = $errores . "La habitacion no esta disponible, escoja otra";
            

    if ($errores == "") {
        $res = $reserva->modificar($reserva_UsuarioFK, $reserva_HabitacionFK, $reserva_CamaFK,$reserva_Finicio,$reserva_Ffin, $reserva_ServicioFK, $reserva_Npersonas,'Activo',$reserva_CodPK);

        if ($res == true) {
            print("<script>document.location.href='reserva_mod.php?reserva_CodPK=" . $reserva_CodPK . "&mensaje=Reserva modificada.'</script>");
            exit();
        } else {
            $mensaje = "• Error: Reserva NO modificada";
            EjecutarError();
        }
    } //fin del if($errores=="")
    else
        EjecutarError();
} //fin del if(isset($_POST['aux']))

$sqlreserva = "SELECT * FROM reserva WHERE reserva_CodPK=" . $reserva_CodPK;
$resreserva = $conexion->BD_Consulta($sqlreserva);
$tuplaReserva = $conexion->BD_GetTupla($resreserva);
//SI NO EXISTE EL USUARIO CON EL CODPK, REDIMENSIONA A INDEX
if ($tuplaReserva == NULL)
    print("<script>document.location.href='index.php'</script>");

$reserva_UsuarioFK = $tuplaReserva['reserva_UsuarioFK'];
$reserva_HabitacionFK = $tuplaReserva['reserva_HabitacionFK'];
$reserva_CamaFK = $tuplaReserva['reserva_CamaFK'];
$reserva_ServicioFK = $tuplaReserva['reserva_ServicioFK'];
$reserva_Finicio = $tuplaReserva['reserva_Finicio'];
$reserva_Ffin = $tuplaReserva['reserva_Ffin'];
$reserva_Npersonas = $tuplaReserva['reserva_Npersonas'];

?>
<html lang="es">

<head>
    <title>Panel de control</title>
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
    <!-- Specific-->
    <link rel="stylesheet" href="../css/addons/theme/summernote.css" class="style-theme-addon" />
    <!--[if lt IE 9]>
    <script src="../js/basic/respond.min.js"></script>
    <script src="../js/basic/html5shiv.min.js"></script>
    <![endif]-->
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
            <?PHP imprime_header($vectorUsuario); ?>
            <div class="resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                <div class="l-row l-spaced-bottom">
                    <div class="l-box">
                        <div class="l-box-header">
                            <h2 class="l-box-title">Modificar Reserva</h2>
                            <ul class="l-box-options">
                                <li><a href="#" data-ason-type="fullscreen" data-ason-target=".l-box" data-ason-content="true" class="ason-widget"><i class="fa fa-expand"></i></a></li>
                                <li><a href="#" data-ason-type="refresh" data-ason-target=".l-box" data-ason-duration="1000" class="ason-widget"><i class="fa fa-rotate-right"></i></a></li>
                                <li><a href="#" data-ason-type="toggle" data-ason-find=".l-box" data-ason-target=".l-box-body" data-ason-content="true" data-ason-duration="200" class="ason-widget"><i class="fa fa-chevron-down"></i></a></li>
                            </ul>
                        </div>
                        <div class="l-box-body l-spaced">
                        <form id="validateDefault" role="form" class="form-horizontal validate"  method="post" action="reserva_mod.php" data-parsley-validate>
                                <input type="hidden" name="aux">
                                <input type="hidden" name="reserva_CodPK" id="reserva_CodPK" value="<?PHP print($reserva_CodPK); ?>" />

                            <div role="application" class="wizard clearfix" id="steps-uid-1">
                                    <h3>Datos</h3>
                                    <div class="form-group">

                                        <div class="col-sm-3">
                                        <label for="reserva_UsuarioFK" class=" control-label">Usuario</label>
                                           <select name="reserva_UsuarioFK" id="reserva_UsuarioFK" class="form-control">
                                           <?PHP
											$sqlreserva = "SELECT * FROM usuario WHERE usuario_Estado='Activo' AND usuario_Tipo='Cliente' ORDER BY usuario_Nombre ASC";
											$resreserva = $conexion->BD_Consulta($sqlreserva);
											$tuplauser = $conexion->BD_GetTupla($resreserva);

											while ($tuplauser != NULL) {

                                                if ($tuplauser['usuario_CodPK'] == $reserva_UsuarioFK)
                                                print("<option value=\"" . $tuplauser['usuario_CodPK'] . "\" selected>" . $tuplauser['usuario_Nombre'] . " ".$tuplauser['usuario_Apellidos']."</option>");
                                                else
                                            print("<option value=\"" . $tuplauser['usuario_CodPK'] . "\">" . $tuplauser['usuario_Nombre'] . " ".$tuplauser['usuario_Apellidos']."</option>");
												

												$tuplauser = $conexion->BD_GetTupla($resreserva);
											} //fin del while($tuplauser!=NULL)
											?>
                                           </select>
                                        </div>

                                        <div class="col-sm-3">
                                        <label for="reserva_HabitacionFK" class=" control-label">Habitacion</label>
                                           <select name="reserva_HabitacionFK" id="reserva_HabitacionFK" class="form-control">
                                           <?PHP
											$sqlHabi = "SELECT * FROM habitacion WHERE habitacion_Estado='Activo' ORDER BY habitacion_Tipo ASC";
											$resHabi = $conexion->BD_Consulta($sqlHabi);
											$tuplahabi = $conexion->BD_GetTupla($resHabi);

											while ($tuplahabi != NULL) {
												if ($tuplahabi['habitacion_CodPK'] == $reserva_HabitacionFK)
                                                print("<option value=\"" . $tuplahabi['habitacion_CodPK'] . "\" selected>" . $tuplahabi['habitacion_Tipo'] ."</option>");
                                                else
													print("<option value=\"" . $tuplahabi['habitacion_CodPK'] . "\">" . $tuplahabi['habitacion_Tipo'] ."</option>");

												$tuplahabi = $conexion->BD_GetTupla($resHabi);
											} //fin del while($tuplahabi!=NULL)
											?>
                                           </select>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3">
                                        <label for="reserva_CamaFK" class="">Cama</label>
                                           <select name="reserva_CamaFK" id="reserva_CamaFK" class="form-control">
                                           <?PHP
											$sqlCama = "SELECT * FROM cama WHERE cama_Estado='Activo' ORDER BY cama_Tipo ASC";
											$resCama = $conexion->BD_Consulta($sqlCama);
											$tuplacama = $conexion->BD_GetTupla($resCama);

											while ($tuplacama != NULL) {
												if ($tuplacama['cama_CodPK'] == $reserva_CamaFK)
                                                print("<option value=\"" . $tuplacama['cama_CodPK'] . "\" selected>" . $tuplacama['cama_Tipo'] ."</option>");
                                                else
													print("<option value=\"" . $tuplacama['cama_CodPK'] . "\">" . $tuplacama['cama_Tipo'] ."</option>");

												$tuplacama = $conexion->BD_GetTupla($resCama);
											} //fin del while($tuplacama!=NULL)
											?>
                                           </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="reserva_ServicioFK" class="control-label">Servicio</label>
                                           <select name="reserva_ServicioFK" id="reserva_ServicioFK" style="width: 55%;" class="form-control">
                                           <?PHP
											$sqlserv = "SELECT * FROM servicio WHERE servicio_Estado='Activo' ORDER BY servicio_Nombre ASC";
											$resserv = $conexion->BD_Consulta($sqlserv);
											$tuplaserv = $conexion->BD_GetTupla($resserv);

											while ($tuplaserv != NULL) {
												if ($tuplaserv['servicio_CodPK'] == $reserva_ServicioFK)
                                                print("<option value=\"" . $tuplaserv['servicio_CodPK'] . "\" selected>" . $tuplaserv['servicio_Nombre'] ."</option>");
                                                else
													print("<option value=\"" . $tuplaserv['servicio_CodPK'] . "\">" . $tuplaserv['servicio_Nombre'] ."</option>");

												$tuplaserv = $conexion->BD_GetTupla($resserv);
											} //fin del while($tuplaserv!=NULL)
											?>
                                           </select>
                                        </div>
                                        <div class="col-sm-2">
                                        <label for="reserva_Finicio" class="control-label">F.Inicio</label>
                                            <input id="reserva_Finicio" style="width: 60%;" value="<?PHP print($reserva_Finicio); ?>" name="reserva_Finicio" type="date" class="form-control" required>
                                        </div>
                                        <!-- <div class="col-sm-2"></div> -->

                                        <div class="col-sm-2">
                                        <label for="reserva_Ffin" class="control-label">F.Fin</label>
                                            <input id="reserva_Ffin" style="width: 60%;" value="<?PHP print($reserva_Ffin); ?>" name="reserva_Ffin" type="date" class="form-control" required>
                                        </div>
                                        <div class="col-sm-2">
                                        <label for="reserva_Npersonas" class="control-label">Nº Personas</label>
                                            <input id="reserva_Npersonas" style="width: 60%;" value="<?PHP print($reserva_Npersonas); ?>" name="reserva_Npersonas" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-7 col-sm-9">
                                            <button type="button" onclick="document.location.href='index.php'" class="btn btn-dark">Atras</button>
                                            <button type="submit" class="btn btn-dark">Guardar</button>
                                        </div>
                                     </div>
                                </div>
                            </form>
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
    <!-- MENSAJE-->
    <script src="../js/plugins/notifications/jquery.toastr.min.js"></script>
    <?php notification($errores) ?>
    <!-- Specific-->
    <script src="../js/shared/classie.js"></script>
    <script src="../js/shared/jquery.cookie.min.js"></script>
    <script src="../js/shared/perfect-scrollbar.min.js"></script>
    <script src="../js/plugins/accordions/jquery.collapsible.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.bootstrap-touchspin.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.checkBo.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.checkradios.min.js"></script>
    <script src="../js/plugins/forms/upload/jquery.ui.widget.js"></script>
    <script src="../js/plugins/forms/upload/jquery.tmpl.min.js"></script>
    <script src="../js/plugins/forms/upload/jquery.load-image.all.min.js"></script>
    <script src="../js/plugins/forms/upload/jquery.canvas-to-blob.min.js"></script>
    <script src="../js/plugins/forms/upload/jquery.blueimp-gallery.min.js"></script>
    <script src="../js/plugins/forms/upload/jquery.iframe-transport.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-process.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-image.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-audio.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-video.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-validate.js"></script>
    <script src="../js/plugins/forms/upload/jquery.fileupload-ui.js"></script>
    <script src="../js/plugins/forms/upload/jquery.summernote.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.switchery.min.js"></script>
    <script src="../js/plugins/tooltip/jquery.tooltipster.min.js"></script>
    <script src="../js/calls/form.upload.js"></script>
    <script src="../js/calls/part.header.1.js"></script>
    <script src="../js/calls/part.sidebar.2.js"></script>
    <script src="../js/calls/part.theme.setting.js"></script>

    <script src="../js/plugins/forms/validation/jquery.parsley.min.js"></script>
    <script src="../js/plugins/forms/validation/jquery.validate.min.js"></script>
    <script>
        function runValidate(form, type) {
            $(form).validate({
                rules: {
                    nombre: "required",
                    login: {
                        required: true,
                        minlength: 2
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    rPassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                },
                messages: {
                    login: {
                        minlength: "Su login de usuario debe constar de al menos 2 caracteres"
                    },
                    password: {
                        minlength: "Su contraseña debe tener al menos 5 caracteres"
                    },
                    rPassword: {
                        minlength: "Su contraseña debe tener al menos 5 caracteres",
                        equalTo: "Ingrese la misma contraseña que anteriormente"
                    },
                }
            });
        }

        function runCheckradios(input) {
            $(input).checkradios({
                checkbox: {
                    iconClass: 'fa fa-check'
                },
                radio: {
                    iconClass: 'fa fa-circle'
                }
            });
        }
        $(function() {
            // Variables
            var validateDefault = '#validateDefault',
                checkradios = '.checkradios';

            runValidate(validateDefault, 'default');
            runCheckradios(checkradios);
        });
    </script>

</body>

</html>