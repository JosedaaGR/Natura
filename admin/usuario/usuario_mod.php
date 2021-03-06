<!DOCTYPE html>
<head>
<link rel="shortcut icon" href="../favicon.png">
</head>

<?PHP

session_start();

include_once "../../clases/fun_aux_menu_intranet.php";
include_once "../../clases/fechas.php";
include_once "../../clases/conexion.php";
include_once "../../clases/comprobar_usuario.php";

include_once "../../clases/usuario.php";
include_once "../../clases/ui.notificacion.php";

$conexion = new conexion();
$url_sitio = $conexion->url_sitio;
$vectorUsuario = Seguridad();
$nombre_empresa = $conexion->nombre_empresa_panel_control;

$usuario = new usuario();

if (isset($_GET['usuario_CodPK']))
    $usuario_CodPK = $_GET['usuario_CodPK'];

$mensaje = "";
$errores = "";

if (isset($_GET['mensaje'])) {
    $errores = $_GET['mensaje'];
    if ($errores != "") {
        EjecutarCorrecto();
    }
}

if (isset($_POST['aux'])) {
    $usuario_Nombre=str_replace("'","\"",$_POST['usuario_Nombre']);
    $usuario_Apellidos=str_replace("'","\"",$_POST['usuario_Apellidos']);
    $usuario_DNI=str_replace("'","\"",$_POST['usuario_DNI']);
    $usuario_Usuario=str_replace("'","\"",$_POST['usuario_Usuario']);
    $usuario_Direccion=str_replace("'","\"",$_POST['usuario_Direccion']);
    $usuario_Telefono=str_replace("'","\"",$_POST['usuario_Telefono']);
    $usuario_Email=str_replace("'","\"",$_POST['usuario_Email']);
    $usuario_Pass=str_replace("'","\"",$_POST['usuario_Pass']);
    $rusuario_Pass=str_replace("'","\"",$_POST['rusuario_Pass']);
    $usuario_CodPK = $_POST['usuario_CodPK'];

    if (trim($usuario_Email) == "")
        $errores = $errores . "Email no puede estar vacio";
    else {
        $sqlEmail = "SELECT * FROM usuario WHERE (usuario_Email='" . $usuario_Email . "' OR usuario_Usuario='" . $usuario_Usuario . "') AND usuario_Estado='Activo' AND usuario_CodPK!=" . $usuario_CodPK;
        $resEmail = $conexion->BD_Consulta($sqlEmail);
        $vectorEmail = $conexion->BD_GetTupla($resEmail);

        if ($vectorEmail != NULL)
            $errores = $errores . "Email o Usuario ya utilizados";
    } //fin del else del if (trim($candidato_Email)== "")

    if ($usuario_Pass != $rusuario_Pass)
        $errores = $errores . "??? Error: Las contrase??as no son iguales.</br>";


    if ($errores == "") {
        $res = $usuario->modificar($usuario_Nombre, $usuario_Apellidos, $usuario_DNI, '','' ,$usuario_Direccion, $usuario_Telefono, $usuario_Email,$usuario_Usuario, $usuario_Pass, '', 'Cliente','Activo',$usuario_CodPK);

        if ($res == true) {
            print("<script>document.location.href='usuario_mod.php?usuario_CodPK=" . $usuario_CodPK . "&mensaje=Cliente modificado.'</script>");
            exit();
        } else {
            $mensaje = "??? Error: Cliente NO modificado";
            EjecutarError();
        }
    } //fin del if($errores=="")
    else
        EjecutarError();
} //fin del if(isset($_POST['aux']))

//SI NO EXISTE EL USUARIO CON EL CODPK, REDIMENSIONA A INDEX
$sqlUsuario = "SELECT * FROM usuario WHERE usuario_CodPK=" . $usuario_CodPK;
$resUsuario = $conexion->BD_Consulta($sqlUsuario);
$tuplaUsuario = $conexion->BD_GetTupla($resUsuario);
//SI NO EXISTE EL USUARIO CON EL CODPK, REDIMENSIONA A INDEX
if ($tuplaUsuario == NULL)
    print("<script>document.location.href='index.php'</script>");

$usuario_Nombre = $tuplaUsuario['usuario_Nombre'];
$usuario_Apellidos = $tuplaUsuario['usuario_Apellidos'];
$usuario_DNI = $tuplaUsuario['usuario_DNI'];
$usuario_Direccion = $tuplaUsuario['usuario_Direccion'];
$usuario_Telefono = $tuplaUsuario['usuario_Telefono'];
$usuario_Email = $tuplaUsuario['usuario_Email'];
$usuario_Usuario = $tuplaUsuario['usuario_Usuario'];
$usuario_Pass = $tuplaUsuario['usuario_Pass'];

?>
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
    <!-- Specific-->
    <link rel="stylesheet" href="../css/addons/theme/summernote.css" class="style-theme-addon" />
    <!--[if lt IE 9]>
    <script src="../js/basic/respond.min.js"></script>
    <script src="../js/basic/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body class="l-dashboard">
    <!--[if lt IE 9]>
    <p class="browsehappy">Su versi??n de navegador est?? <strong>absoleta</strong> por favor <a href="http://browsehappy.com/">Actualiza tu navegador</a> y mejorar??s tu experiencia.</p>
    <![endif]-->
    <?PHP imprime_cabecera(); ?>

    <!--SECTION-->
    <section class="l-main-container">
        <!--Left Sidebar Content-->
        <?PHP imprime_sidebar("usuario"); ?>
        <!--Main Content-->
        <section class="l-container">
            <?PHP imprime_header($vectorUsuario); ?>
            <div class="resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                <div class="l-row l-spaced-bottom">
                    <div class="l-box">
                        <div class="l-box-header">
                            <h2 class="l-box-title">Modificar usuario</h2>
                            <ul class="l-box-options">
                                <li><a href="#" data-ason-type="fullscreen" data-ason-target=".l-box" data-ason-content="true" class="ason-widget"><i class="fa fa-expand"></i></a></li>
                                <li><a href="#" data-ason-type="refresh" data-ason-target=".l-box" data-ason-duration="1000" class="ason-widget"><i class="fa fa-rotate-right"></i></a></li>
                                <li><a href="#" data-ason-type="toggle" data-ason-find=".l-box" data-ason-target=".l-box-body" data-ason-content="true" data-ason-duration="200" class="ason-widget"><i class="fa fa-chevron-down"></i></a></li>
                            </ul>
                        </div>
                        <div class="l-box-body l-spaced">
                            <form id="validateDefault" role="form" class="form-horizontal validate" method="post" action="usuario_mod.php" data-parsley-validate>
                                <div role="application" class="wizard clearfix" id="steps-uid-1">
                                    <input type="hidden" name="aux" id="aux" />
                                    <input type="hidden" name="usuario_CodPK" id="usuario_CodPK" value="<?PHP print($usuario_CodPK); ?>" />
                                    <h3>Datos</h3>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="usuario_Nombre" class=" control-label">Nombre *</label>
                                            <input id="usuario_Nombre" name="usuario_Nombre" value="<?PHP print($usuario_Nombre); ?>" type="text" class="form-control required" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="usuario_Apellidos" class="control-label">Apellidos</label>
                                            <input id="usuario_Apellidos" name="usuario_Apellidos"value="<?PHP print($usuario_Apellidos); ?>" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="usuario_DNI" class=" control-label">DNI *</label>
                                            <input id="usuario_DNI" name="usuario_DNI" type="text"value="<?PHP print($usuario_DNI); ?>" class="form-control " required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        
                                        
                                        <div class="col-sm-4">
                                            <label for="usuario_Usuario" class=" control-label">Usuario *</label>
                                            <input id="usuario_Usuario" name="usuario_Usuario" value="<?PHP print($usuario_Usuario); ?>" type="text" class="form-control" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="usuario_Direccion" class=" control-label">Direccion</label>
                                            <input id="usuario_Direccion" name="usuario_Direccion" value="<?PHP print($usuario_Direccion); ?>" type="text" class="form-control">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="usuario_Telefono" class="control-label">Telefono</label>
                                            <input id="usuario_Telefono" name="usuario_Telefono" value="<?PHP print($usuario_Telefono); ?>" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        
                                         <div class="col-sm-3">
                                            <label for="usuario_Foto" class="control-label">Foto</label>
                                            <input id="usuario_Foto" name="usuario_Foto" type="text" class="form-control">
                                        </div> 
                                        
                                    </div> -->
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="usuario_Email" class=" control-label">Email *</label>
                                            <input id="usuario_Email" name="usuario_Email" type="usuario_Email" value="<?PHP print($usuario_Email); ?>" class="form-control required" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="usuario_Pass" class="control-label">Contrase??a *</label>
                                            <input id="usuario_Pass" name="usuario_Pass" type="password" value="<?PHP print($usuario_Pass); ?>" class="form-control required" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="rusuario_Pass" class="control-label">R. Contrase??a *</label>
                                            <input id="rusuario_Pass" name="rusuario_Pass" type="password" value="<?PHP print($usuario_Pass); ?>"  class="form-control required" aria-required="true" required>
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
    <script>
        $(document).ready(function() {
            $('#mostrar_contrasena').click(function() {
                if ($('#mostrar_contrasena').is(':checked')) {
                    $('#pass').attr('type', 'text');
                } else {
                    $('#pass').attr('type', 'password');
                }
            });
        });
        $(document).ready(function() {
            $('#mostrar_contrasena2').click(function() {
                if ($('#mostrar_contrasena2').is(':checked')) {
                    $('#passR').attr('type', 'text');
                } else {
                    $('#passR').attr('type', 'password');
                }
            });
        });
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
                        minlength: "Su contrase??a debe tener al menos 5 caracteres"
                    },
                    rPassword: {
                        minlength: "Su contrase??a debe tener al menos 5 caracteres",
                        equalTo: "Ingrese la misma contrase??a que anteriormente"
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