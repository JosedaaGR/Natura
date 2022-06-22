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

if (isset($_GET['reserva_CodPK'])) {
	$reserva_CodPK = $_GET['reserva_CodPK'];
	$condicion = " WHERE reserva_CodPK=" . $reserva_CodPK;
	$reserva->eliminar($condicion);
	$mensaje_alerta = "
        <div id=\"ModalAlert\" class=\"modal fade\" role=\"dialog\">
          <div class=\"modal-dialog\">
            <!-- Modal content-->
            <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
              </div>
              <div class=\"modal-body\" style=\"padding:15px;\">			      
            <p>Reserva Cancelada Correctamente</p>
              </div>
            </div>
          </div>
        </div>";
	
	

} //fin if(isset($_GET['reserva_CodPK']))

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
    <!-- <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" /> -->
<style>
    th,td{
        text-align: center;
    }
</style>
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

    <div class="row">
        <div class="col-xl-12">
            
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header" style="border: none;text-align: center;">
                    <div class="card-title" style="text-align: center;" >
                        <h2 class="card-label font-weight-bolder " style="text-align: center;">
                                  Mis Reservas
                        </h2>
                    </div>
                </div>
                <?PHP print($mensaje_alerta); ?>

                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4">

                                <input type="text" id="InputBuscar" style="color: black;" class="form-control mb-5" onkeyup="myFunction()" placeholder="Buscar Habitacion..." title="Buscar empresa">

                            </div>
                            <br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="table-responsive">

                                    <table class="table table-striped table-active" id="TablaReserva">
                                        <thead>
                                            <tr class="">
                                                <th>HABITACION</th>
                                                <th>CAMA</th>
                                                <th>SERVICIO</th>
                                                <th>FECHA INICIO</th>
                                                <th>FECHA FIN</th>
                                                <th>PERSONAS</th>
                                                <th>PRECIO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP
                                            
                                                $sqlCliente = "SELECT * FROM reserva INNER JOIN habitacion ON reserva_HabitacionFK=habitacion_CodPK INNER JOIN servicio ON reserva_ServicioFK=servicio_CodPK INNER JOIN cama ON reserva_CamaFK=cama_CodPK INNER JOIN usuario ON reserva_UsuarioFK=usuario_CodPK WHERE reserva_UsuarioFK='" . $tuplaUsuario['usuario_CodPK']."' ORDER BY reserva_Finicio DESC";
                                                $resCliente = $conexion->BD_Consulta($sqlCliente);
                                                $vectorCliente = $conexion->BD_GetTupla($resCliente);

                                                $i = 0;
                                                while ($vectorCliente != NULL) {
                                                    if($vectorCliente['reserva_Finicio']!=$vectorCliente['reserva_Ffin']){
                                                    $date1 = new DateTime($vectorCliente['reserva_Finicio']);
													$date2 = new DateTime($vectorCliente['reserva_Ffin']);
													$diff = $date1->diff($date2);
													$precio=(($vectorCliente['cama_Precio']+$vectorCliente['habitacion_Precio']+$vectorCliente['servicio_Precio'])*$vectorCliente['reserva_Npersonas'])*$diff->days;
                                                    }else{
                                                    $precio=(($vectorCliente['cama_Precio']+$vectorCliente['habitacion_Precio']+$vectorCliente['servicio_Precio'])*$vectorCliente['reserva_Npersonas']);
                                                    }
                                                    $i++;
                                                    print("<tr>
                                                    <td>" . $vectorCliente['habitacion_Tipo'] . "</td>
                                                    <td>" . $vectorCliente['cama_Tipo'] . "</td>
                                                    <td>" . $vectorCliente['servicio_Nombre'] . "</td>
                                                    <td>" . cambiaf_a_normal($vectorCliente['reserva_Finicio'])  . "</td>
                                                    <td>" . cambiaf_a_normal($vectorCliente['reserva_Ffin'])  . "</td>
                                                    <td>" . $vectorCliente['reserva_Npersonas'] . "</td>
                                                    <td>" . $precio . " €</td>
                                                    <td id=\"impresion_invisible\" style=\"text-align:center;\">
                                                    ");
                                                    if($vectorCliente['reserva_Estado']=='No_Activo'){
                                                        print("<a href=\"mostrar.php?reserva_CodPK=" . $vectorCliente['reserva_CodPK'] . "\" class=\"btn btn-warning btn-sm\"><i class=\"fa fa-print\"></i> Recibo</a>");
                                                    }else{
                                                    print("
                                                    <a href=\"#\" data-toggle=\"modal\" data-target=\"#basicModal" . $i . "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i> Cancelar</a>
                                                    <a href=\"mostrar.php?reserva_CodPK=" . $vectorCliente['reserva_CodPK'] . "\" class=\"btn btn-warning btn-sm\"><i class=\"fa fa-print\"></i> Recibo</a>
                                                    ");}
                                                    print("
                                                    </td>
                                                    <div id=\"basicModal" . $i . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"basicModalLabel\" aria-hidden=\"true\" class=\"modal fade\">
														<div class=\"modal-dialog\">
														<div class=\"modal-content\">
															<div class=\"modal-header\">
															<button type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\" class=\"close\"><span aria-hidden=\"true\">×</span></button>
															<h4 id=\"basicModalLabel\" class=\"modal-title\">Eliminar la reserva del dia " . cambiaf_a_normal($vectorCliente['reserva_Finicio']) . "</h4>
															</div>
															<div class=\"modal-body\">Está usted seguro de querer eliminar la reserva del <b>" . cambiaf_a_normal($vectorCliente['reserva_Finicio']) . "</b> al <b>".cambiaf_a_normal($vectorCliente['reserva_Ffin'])."</b></div>
															<div class=\"modal-footer\">
															<button style=\"float:left\" type=\"button\" data-dismiss=\"modal\" class=\"btn btn-success\">Cerrar</button>
															<button type=\"button\" onclick=\"document.location.href='mis-reservas.php?reserva_CodPK=" . $vectorCliente['reserva_CodPK'] . "'\" class=\"btn btn-danger\">Eliminar</button>
															</div>
														</div>
														</div>
													</div>
                                                    </td>
                                                    
                                                                    
                                                                    </tr>");

                                                    $vectorCliente = $conexion->BD_GetTupla($resCliente);
                                                } // fin while ($vectorCliente != NULL) 
                                            
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Dashboard-->
    </div>
    <!--end::Container-->
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
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("InputBuscar");
            filter = input.value.toUpperCase();
            table = document.getElementById("TablaReserva");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
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