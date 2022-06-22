<?PHP
include_once "../clases/conexion.php";
include_once "../clases/fun_aux_menu_intranet.php";
include_once "../clases/comprobar_usuario.php";

    $tuplauser=usuario_logueado();
    if($tuplauser['usuario_Tipo']=='Admin')
	print("<script>document.location.href='inicio/index.php'</script>");
	else
    print("<script>document.location.href='../index.php'</script>");

?>