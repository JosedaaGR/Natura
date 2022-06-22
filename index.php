<?PHP
session_start();

include_once "./clases/conexion.php";
include_once "./clases/fechas.php";
include_once "./clases/fun_aux_menu_intranet.php";
include_once "./clases/comprobar_usuario.php";
include_once "./clases/reserva.php";

$conexion = new conexion();
$reserva = new reserva();
$sqlCancela = "SELECT * FROM reserva ";
$resCancela = $conexion->BD_Consulta($sqlCancela);
$vesctorCancela = $conexion->BD_GetTupla($resCancela);

while ($vesctorCancela != NULL) {
    $hoy=date('Y-m-d');
    if($vesctorCancela['reserva_Ffin'] < $hoy){
        $condicion = "reserva_Estado='No_Activo' WHERE reserva_CodPK=" . $vesctorCancela['reserva_CodPK'];
		$reserva->modificarEstado($condicion);
    }
    
    $vesctorCancela = $conexion->BD_GetTupla($resCancela);
} // fin while ($vesctorCancela != NULL) 

$tuplaUsuario = usuario_logueado();

if ($tuplaUsuario != NULL) {
    //************************************************** DEPENDE DEL TIPO DE USUARIO **************************************************
    if (strcmp($tuplaUsuario['usuario_Tipo'], "Admin") == 0)
        print("<script>document.location.href='./admin/inicio/index.php'</script>");

    if (strcmp($tuplaUsuario['usuario_Tipo'], "Cliente") == 0)
        print("<script>document.location.href='inicio.php'</script>");

    exit();
} //fin del if($tuplaUsuario!=NULL)



$mensaje_alerta = "";

if (isset($_POST['aux'])) {
    $username_pcontrol_new5 = str_replace("'", "", $_POST['username_pcontrol_new5']);
    $username_pcontrol_new5 = str_replace("\"", "", $username_pcontrol_new5);
    $password_pcontrol_new5 = str_replace("'", "", $_POST['password_pcontrol_new5']);
    $password_pcontrol_new5 = str_replace("\"", "", $password_pcontrol_new5);

    $_SESSION['username_pcontrol_new5'] = $username_pcontrol_new5;
    $_SESSION['password_pcontrol_new5'] = $password_pcontrol_new5;

    $tuplaUsuario = usuario_logueado();

    if ($tuplaUsuario == NULL) {
        $mensaje_alerta = "
			<div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
			  <div class=\"modal-dialog\">
			    <!-- Modal content-->
			    <div class=\"modal-content\">
                <div class=\"modal-header\">
				<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
			      </div>
			      <div class=\"modal-body\" style=\"padding:15px;\">			      
				<p><i class=\"fa fa-warning\"></i> Fallo en Inicio de Sesión</p>		
			      </div>
			    </div>
			  </div>
			</div>";
    } //fin del if($tuplaCandidato==NULL)
    else {
        if (strcmp($tuplaUsuario['usuario_Tipo'], "Admin") == 0)
            print("<script>document.location.href='./admin/inicio/index.php'</script>");

        if (strcmp($tuplaUsuario['usuario_Tipo'], "Cliente") == 0)
            print("<script>document.location.href='inicio.php'</script>");

        exit();
    } //fin del else del if($tuplaCandidato==NULL)
} //fin del if(isset($_POST['aux']))

?>

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>NATURA | INICIO DE SESION</title>
    <meta name="description" content="Updates and statistics" />
    <link rel="shortcut icon" href="favicon/favicon.ico">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
                                <?PHP print($mensaje_alerta); ?>
                                <div class="text-muted font-weight-bold">Por favor introduzca usuario y contraseña:</div>
                            </div>
                            <form class="form" method="POST" action="index.php">
                                <input type="hidden" name="aux">

                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Usuario" name="username_pcontrol_new5" id="username_pcontrol_new5" autocomplete="off" required />
                                </div>
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Contraseña" name="password_pcontrol_new5" id="password_pcontrol_new5" required />
                                </div>

                                <input type="submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3" value="Iniciar sesión">

                            </form>

                            <!-- <div class="mt-5">
                                <a href="recuperar-contrasena.php" id="" class=" font-weight-bold">¿Ha olvidado su contraseña?</a>
                            </div> -->
                            <div class="mt-5">
                                <a href="registro.php" id="" class="font-weight-bold">¿Aun no tienes cuenta?</a>
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