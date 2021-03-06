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
    $admin = new usuario();
    $url_sitio=$conexion->url_sitio;

    $vectorUsuario=Seguridad();

    $usuario_Nombre_empresa=$conexion->nombre_empresa_panel_control;
    
    $errores="";
    $mensaje="";
    
    if(isset($_GET['mensaje']))
    {
	$mensaje=$_GET['mensaje'];
	if ($mensaje != "")
	    EjecutarCorrecto();	
    }
    
    if(isset($_POST['aux']))
    {
        $usuario_Nombre=str_replace("'","\"",$_POST['usuario_Nombre']);
        $usuario_Usuario=str_replace("'","\"",$_POST['usuario_Usuario']);
        $usuario_Email=str_replace("'","\"",$_POST['usuario_Email']);
        $usuario_Pass=str_replace("'","\"",$_POST['usuario_Pass']);
        $rusuario_Pass=str_replace("'","\"",$_POST['rusuario_Pass']);

        if (trim($usuario_Email) == "")
        $errores = $errores . "Email no puede estar vacio";
    else {
        $sqlEmail = "SELECT * FROM usuario WHERE (usuario_Email='" . $usuario_Email . "' OR usuario_Usuario='" . $usuario_Usuario . "') AND usuario_Estado='Activo'";
        $resEmail = $conexion->BD_Consulta($sqlEmail);
        $vectorEmail = $conexion->BD_GetTupla($resEmail);

        if ($vectorEmail != NULL)
            $errores = $errores . "Email o Usuario ya utilizados";
        

    } //fin del else del if (trim($candidato_Email)== "")
        
        if ($usuario_Pass != $rusuario_Pass)
            $errores=$errores."• Error: Las contraseñas no son iguales.</br>";
        
        if($errores=="")
        {
            $res = $admin->insertarAdmin($usuario_Nombre, $usuario_Email,$usuario_Usuario, $usuario_Pass,'Admin');
            
            if ($res==true)
                print("<script>document.location.href='admin_add.php?mensaje=• Admin registrado.'</script>");
            else
            {
                $mensaje="• Error: Admin NO registrado.";
                EjecutarError();
            }
            
        }//fin del if($errores=="")
        else
        {
            $mensaje = $errores;
            EjecutarError();
        }
    } //fin if(isset($_POST['aux']))
    

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
    <link rel="stylesheet" href="../css/addons/fonts/artill-clean-icons.css"/>
    <!-- Specific-->
    <link rel="stylesheet" href="../css/addons/theme/summernote.css" class="style-theme-addon"/>
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
    <?PHP imprime_sidebar("admin"); ?>
    <!--Main Content-->
        <section class="l-container">
            <?PHP imprime_header($vectorUsuario); ?>
            <div class="resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                <div class="l-row l-spaced-bottom">
                    <div class="l-box">
                        <div class="l-box-header">
                            <h2 class="l-box-title">Añadir Admin</h2>
                            <ul class="l-box-options">
                                <li><a href="#" data-ason-type="fullscreen" data-ason-target=".l-box" data-ason-content="true" class="ason-widget"><i class="fa fa-expand"></i></a></li>
                                <li><a href="#" data-ason-type="refresh" data-ason-target=".l-box" data-ason-duration="1000" class="ason-widget"><i class="fa fa-rotate-right"></i></a></li>
                                <li><a href="#" data-ason-type="toggle" data-ason-find=".l-box" data-ason-target=".l-box-body" data-ason-content="true" data-ason-duration="200" class="ason-widget"><i class="fa fa-chevron-down"></i></a></li>
                            </ul>
                        </div>
                        <div class="l-box-body l-spaced">
                            <form id="validateDefault" role="form" class="form-horizontal validate"  method="post" action="admin_add.php" data-parsley-validate>
                                <input type="hidden" name="aux">
                            <div role="application" class="wizard clearfix" id="steps-uid-1">
                                    <h3>Datos</h3>
                                    <div class="form-group">

                                        <div class="col-sm-4">
                                            <label for="usuario_Nombre" class=" control-label">Nombre *</label>
                                            <input id="usuario_Nombre" name="usuario_Nombre" type="text" class="form-control required" aria-required="true" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="usuario_Email" class="control-label">Email *</label>
                                            <input id="usuario_Email" name="usuario_Email" type="email" class="form-control" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="usuario_Usuario" class=" control-label">Usuario *</label>
                                            <input id="usuario_Usuario" name="usuario_Usuario" type="text" class="form-control required" aria-required="true" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                        <label for="usuario_Pass" class="control-label">Contraseña *</label>
                                            <input id="usuario_Pass" name="usuario_Pass" type="password" class="form-control" required>
                                        </div>
                                        <div class="col-sm-6">
                                        <label for="rusuario_Pass" class="control-label">R. Contraseña *</label>
                                            <input id="rusuario_Pass" name="rusuario_Pass" type="password" class="form-control" required>
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
      var paceSemiGeneral = { restartOnPushState: false };
      if (typeof paceSpecific != 'undefined'){
      	var paceOptions = $.extend( {}, paceSemiGeneral, paceSpecific );
      	paceOptions = paceOptions;
      }else{
      	paceOptions = paceSemiGeneral;
      }

    </script>
    <script src="../js/plugins/pageprogressbar/pace.min.js"></script>
    
    <!-- MENSAJES -->
    <script src="../js/plugins/notifications/jquery.toastr.min.js"></script>
    <?php notification($mensaje) ?>
    
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
    
    <!--validador-->
    <script src="../js/plugins/forms/validation/jquery.parsley.min.js"></script>
    <script src="../js/plugins/forms/validation/jquery.validate.min.js"></script>
    <script>
	function runValidate(form,type){
	    $(form).validate({
		rules: {
		    usuario_Nombre: "required",
		    usuario_Email: {
			required: true,
			minlength: 2
		    },
		    usuario_Pass: {
			required: true,
			minlength: 5
		    },
		    rusuario_Pass: {
			required: true,
			minlength: 5,
			equalTo: "#usuario_Pass"
		    },
		},
		messages: {
		    usuario_Email: {
			minlength: "Su usuario_Email de usuario debe constar de al menos 2 caracteres"
		    },
		    usuario_Pass: {
			minlength: "Su contraseña debe tener al menos 5 caracteres"
		    },
		    rusuario_Pass: {
			minlength: "Su contraseña debe tener al menos 5 caracteres",
			equalTo: "Ingrese la misma contraseña que anteriormente"
		    },
		}
	    });
	}
	function runCheckradios(input){
	    $(input).checkradios({
		checkbox: {
		    iconClass:'fa fa-check'
		},
		radio: {
		    iconClass:'fa fa-circle'
		}
	    });
	}
	$(function(){
	    // Variables
	    var validateDefault  = '#validateDefault',
		checkradios = '.checkradios';
	    
	    runValidate(validateDefault,'default');
	    runCheckradios(checkradios);
	});
    </script>
  </body>
</html>

