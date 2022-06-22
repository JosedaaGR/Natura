<?PHP
include "phpmailer/class.phpmailer.php";
function email($Direccionmail, $from, $asunto, $cuerpo, $ficheroAEnviar = "", $nombreAMostrar = "")
{
	include_once "conexion.php";

	$conexion = new conexion();

	$email_from = $conexion->email_from;
	$email_host = $conexion->email_host;
	$email_pass = $conexion->email_pass;

	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Ask for HTML-friendly debug output
	$mail->Mailer = "smtp";
	//Set the hostname of the mail server
	$mail->Host = $email_host;


	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = $email_from;
	//Password to use for SMTP authentication
	$mail->Password = $email_pass;
	//Set who the message is to be sent from
	$mail->setFrom($from, 'MICHOFER');

	
	$mail->Timeout = 30;

	//Set who the message is to be sent to
	$mail->addAddress($Direccionmail);
	//Set the subject line
	$mail->Subject = $asunto;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($cuerpo);
	//Replace the plain text body with one created manually
	$mail->AltBody = $cuerpo;
	$fichero = file_get_contents($ficheroAEnviar);
	$mail->addStringAttachment($fichero, $nombreAMostrar);

	// if (trim($ficheroAEnviar) != "") {
	// 	$mail->AddAttachment($ficheroAEnviar, $nombreAMostrar);
	// } //fin del if(trim($ficheroAEnviar)!="")

	//la variable $exito tendra el valor true
	$exito = $mail->Send();

	//Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
	// para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
	//del anterior, para ello se usa la funcion sleep	
	$intentos = 1;
	while ((!$exito) && ($intentos < 5)) {
		sleep(5);
		//echo $mail->ErrorInfo;
		$exito = $mail->Send();
		$intentos = $intentos + 1;
	}
	return $exito;
}//fin del function email($Direccionmail,$from,$asunto,$cuerpo,$ficheroAEnviar="", $nombreAMostrar="")
