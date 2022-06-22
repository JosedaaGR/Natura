<?php 

function Seguridad()
{
    if(isset($_SESSION['username_pcontrol_new5']) AND isset($_SESSION['password_pcontrol_new5']))
    {
        $vector_return=BuscarUsuario();
                                
        if($vector_return==NULL)
        {
            echo "<script type='text/javascript'>alert('El Usuario o el Password no son correctos.');</script>";
            print("<script>document.location.href='../index.php';</script>");
        }//fin del if($vector_return==NULL)
        else
            return $vector_return;
       
    }//fin del if(isset($_SESSION['username_pcontrol_new']) AND isset($_SESSION['password_pcontrol_new']))
    else
    {		
        echo "<script type='text/javascript'>alert('Problemas con la pagina, Intentelo mas tarde.');</script>";
        print("<script>document.location.href='../index.php';</script>");
    }//fin del else del if(isset($_SESSION['username_pcontrol_new']) AND isset($_SESSION['password_pcontrol_new']))		
}//fin del function Seguridad()


function BuscarUsuario()
{
    $conexion = new conexion();    
    $vector_return=NULL;
    
    $sql="SELECT * FROM usuario WHERE usuario_Usuario='".$_SESSION['username_pcontrol_new5']."' AND usuario_Pass='".$_SESSION['password_pcontrol_new5']."' AND usuario_Estado='Activo'";
    $res=$conexion->BD_Consulta($sql);
    $vector_return=$conexion->BD_GetTupla($res);
    
    return $vector_return;
}//fin del function BuscarUsuario()

function usuario_logueado()
{
    $conexion= new conexion();

    $tuplaUsuario=NULL;

    if(isset($_SESSION['username_pcontrol_new5']) && trim($_SESSION['username_pcontrol_new5'])!="" && isset($_SESSION['password_pcontrol_new5']) && trim($_SESSION['password_pcontrol_new5'])!="")
    {
		$password=$_SESSION['password_pcontrol_new5'];

		$username_pcontrol_new5=str_replace("'", "", $_SESSION['username_pcontrol_new5']);
		$username_pcontrol_new5=str_replace("\"", "", $username_pcontrol_new5);
		
		
		$sqlUsuario="SELECT * FROM usuario
						WHERE usuario_Usuario='".$username_pcontrol_new5."'
						AND usuario_Pass='". $password ."'
						AND usuario_Estado='Activo'";
		$resUsuario=$conexion->BD_Consulta($sqlUsuario);
		$tuplaUsuario=$conexion->BD_GetTupla($resUsuario);
    }
    
    return $tuplaUsuario;
}