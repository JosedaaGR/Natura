<?PHP
session_start();

include_once "./clases/conexion.php";
include_once "./clases/fechas.php";
include_once "./clases/fun_aux_menu_intranet.php";
include_once "./clases/comprobar_usuario.php";
include_once "./clases/usuario.php";

$conexion = new conexion();
$usuario = new usuario();
$tuplaUsuario = usuario_logueado();

if ($tuplaUsuario != NULL) 
{
    //************************************************** DEPENDE DEL TIPO DE USUARIO **************************************************
    if (strcmp($tuplaUsuario['usuario_Tipo'], "Admin") == 0) 
        print("<script>document.location.href='./admin/inicio/index.php'</script>");
    
    if (strcmp($tuplaUsuario['usuario_Tipo'], "Cliente") == 0) 
        print("<script>document.location.href='inicio.php'</script>");

    exit();
} //fin del if($tuplaUsuario!=NULL)

$mensaje_alerta = "";

if(isset($_POST['aux']))
{
    $usuario_Nombre=str_replace("'","\"",$_POST['usuario_Nombre']);
    $usuario_Usuario=str_replace("'","\"",$_POST['usuario_Usuario']);
    $usuario_Email=str_replace("'","\"",$_POST['usuario_Email']);
    $usuario_Pass=str_replace("'","\"",$_POST['usuario_Pass']);

    if (trim($usuario_Email) == ""){
    $mensaje_alerta = "
    <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
      <div class=\"modal-dialog\">
        <!-- Modal content-->
        <div class=\"modal-content\">
        <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
          </div>
          <div class=\"modal-body\" style=\"padding:15px;\">			      
        <p><i class=\"fa fa-warning\"></i> El email no puede estar vacio</p>		
          </div>
        </div>
      </div>
    </div>";}else {
    $sqlEmail = "SELECT * FROM usuario WHERE (usuario_Email='" . $usuario_Email . "' OR usuario_Usuario='" . $usuario_Usuario . "') AND usuario_Estado='Activo'";
    $resEmail = $conexion->BD_Consulta($sqlEmail);
    $vectorEmail = $conexion->BD_GetTupla($resEmail);

    if ($vectorEmail != NULL){
    $mensaje_alerta = "
    <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
      <div class=\"modal-dialog\">
        <!-- Modal content-->
        <div class=\"modal-content\">
        <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
          </div>
          <div class=\"modal-body\" style=\"padding:15px;\">			      
        <p><i class=\"fa fa-warning\"></i> Email o Usuario ya utilizados</p>		
          </div>
        </div>
      </div>
    </div>";
    }else{
        $res = $usuario->registroCliente($usuario_Nombre, $usuario_Email,$usuario_Usuario, $usuario_Pass,'Cliente');
        
        if ($res==true)
        $mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p><i class=\"fa fa-warning\"></i> Se ha registrado correctamente</p>		
              </div>
            </div>
          </div>
        </div>";
        else
        {
            $mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p><i class=\"fa fa-warning\"></i>Ha habido un error</p>		
              </div>
            </div>
          </div>
        </div>";
        }
    }
}
} //fin if(isset($_POST['aux']))

?>
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>NATURA | REGISTRO</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="favicon/favicon.ico">

    <!--begin::Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/css/pages/login/classic/login-2.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed">
    <!--begin::Main-->

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <!--begin::Content-->
                <div class="d-flex flex-center">

                    <div class="sombra login-form text-center p-7 position-relative overflow-hidden" style="background: white;">

                        <img src="assets/media/logo.png" title="" />

                        <!--begin::Login Sign in form-->
                        <div class="login-signin">
                            
                            <div class="mt-5 mb-5">
                            <?PHP print($mensaje_alerta);?>
                                <div class="text-muted font-weight-bold">Por favor introduzca sus datos:</div>
                            </div>
                            <form class="form" method="POST" action="registro.php">
                                <input type="hidden" name="aux">
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Nombre" name="usuario_Nombre" id="usuario_Nombre" autocomplete="off" required/>
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="email" placeholder="Email" name="usuario_Email" id="usuario_Email" autocomplete="off" required/>
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Usuario" name="usuario_Usuario" id="usuario_Usuario" autocomplete="off" required/>
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Contraseña" name="usuario_Pass" id="usuario_Pass" required/>
                                </div>

                                <input type="submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3" value="Registrarse">

                            </form>
        
                            <div class="mt-5">
                                <a href="index.php" id="" class="font-weight-bold">¿Ya tienes cuenta?</a>
                            </div>
                            <!--div class="mt-5">
                                <a href="#" id="" class=" font-weight-bold">¿Ha olvidado su contraseña?</a>
                            </div-->
                        </div>
                        <!--end::Login Sign in form-->

                        <div class="text-dark order-2 order-md-1 mt-10">
                            <span class="text-muted font-weight-bold">© NATURA </span>

                        </div>
                    </div>
                </div>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->


    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
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

</body>
<!--end::Body-->

</html>