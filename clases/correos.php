<?PHP

function correo_recordar_password($usuario_Nombre, $usuario_Usuario, $usuario_Password) 
{
    $conexion = new conexion();
    
    $url_sitio=$conexion->url_sitio;

    $aux = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd\">
    <html>
    
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />
        <title>Mensaje desde INN OFFICES</title>
    
        <style>
            @media only screen and (max-width: 300px) {
                body {
                    width: 218px !important;
                    margin: auto !important;
                }
                .table {
                    width: 195px !important;
                    margin: auto !important;
                }
                .logo,
                .titleblock,
                .linkbelow,
                .box,
                .footer,
                .space_footer {
                    width: auto !important;
                    display: block !important;
                }
                span.title {
                    font-size: 20px !important;
                    line-height: 23px !important
                }
                span.subtitle {
                    font-size: 14px !important;
                    line-height: 18px !important;
                    padding-top: 10px !important;
                    display: block !important;
                }
                td.box p {
                    font-size: 12px !important;
                    font-weight: bold !important;
                }
                .table-recap table,
                .table-recap thead,
                .table-recap tbody,
                .table-recap th,
                .table-recap td,
                .table-recap tr {
                    display: block !important;
                }
                .table-recap {
                    width: 200px!important;
                }
                .table-recap tr td,
                .conf_body td {
                    text-align: center !important;
                }
                .address {
                    display: block !important;
                    margin-bottom: 10px !important;
                }
                .space_address {
                    display: none !important;
                }
            }
            
            @media only screen and (min-width: 301px) and (max-width: 500px) {
                body {
                    width: 308px!important;
                    margin: auto!important;
                }
                .table {
                    width: 285px!important;
                    margin: auto!important;
                }
                .logo,
                .titleblock,
                .linkbelow,
                .box,
                .footer,
                .space_footer {
                    width: auto!important;
                    display: block!important;
                }
                .table-recap table,
                .table-recap thead,
                .table-recap tbody,
                .table-recap th,
                .table-recap td,
                .table-recap tr {
                    display: block !important;
                }
                .table-recap {
                    width: 295px !important;
                }
                .table-recap tr td,
                .conf_body td {
                    text-align: center !important;
                }
            }
            
            @media only screen and (min-width: 501px) and (max-width: 768px) {
                body {
                    width: 478px!important;
                    margin: auto!important;
                }
                .table {
                    width: 450px!important;
                    margin: auto!important;
                }
                .logo,
                .titleblock,
                .linkbelow,
                .box,
                .footer,
                .space_footer {
                    width: auto!important;
                    display: block!important;
                }
            }
            
            @media only screen and (max-device-width: 480px) {
                body {
                    width: 308px!important;
                    margin: auto!important;
                }
                .table {
                    width: 285px;
                    margin: auto!important;
                }
                .logo,
                .titleblock,
                .linkbelow,
                .box,
                .footer,
                .space_footer {
                    width: auto!important;
                    display: block!important;
                }
                .table-recap {
                    width: 295px!important;
                }
                .table-recap tr td,
                .conf_body td {
                    text-align: center!important;
                }
                .address {
                    display: block !important;
                    margin-bottom: 10px !important;
                }
                .space_address {
                    display: none !important;
                }
            }
        </style>
    
    </head>
    
    <body style=\"-webkit-text-size-adjust:none;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto\">
        <table class=\"table table-mail\" style=\"background-color:white;width:100%;margin-top:10px;-moz-box-shadow:0 0 5px #afafaf;-webkit-box-shadow:0 0 5px #afafaf;-o-box-shadow:0 0 5px #afafaf;box-shadow:0 0 5px #afafaf;filter:progid:DXImageTransform.Microsoft.Shadow(color=#afafaf,Direction=134,Strength=5)\">
            <tr>
                <td class=\"space\" style=\"width:20px;padding:7px 0\">&nbsp;</td>
                <td align=\"center\" style=\"padding:7px 0\">
                    <table class=\"table\" bgcolor=\"#ffffff\" style=\"width:100%\">
                        <tr>
                            <td align=\"center\" class=\"logo\" style=\"padding:7px 0 20px 0\">
                                <a title=\"INN OFFICES\" href=\"".$url_sitio."\" style=\"color:#337ff1\">
                                    <img src=\"".$url_sitio."/assets/media/logo.png\" alt=\"Logotipo NATURA\" />
                                </a>
                            </td>
                        </tr>
    
                        <tr>
                            <td align=\"center\" class=\"titleblock\" style=\"padding:7px 0\">
                                <font size=\"2\" face=\"Open-sans, sans-serif\" color=\"#555454\">
                                    <span class=\"title\" style=\"font-weight:500;font-size:28px;line-height:33px\">Hola ".$usuario_Nombre.",</span><br/>
                                    <span class=\"subtitle\" style=\"font-weight:500;font-size:16px;line-height:25px\">Mensaje recuperación de contraseña.</span>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td class=\"space_footer\" style=\"padding:0!important\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class=\"box\" style=\"background-color:#F3F6F9;padding:7px 0 20px 0\">
                                <table class=\"table\" style=\"width:100%\">
                                    <tr>
                                        <td width=\"10\" style=\"padding:7px 0\">&nbsp;</td>
                                        <td style=\"padding:7px 0\">
                                            <font size=\"2\" face=\"Open-sans, sans-serif\" color=\"#555454\">
                                                <p data-html-only=\"1\" style=\"margin:3px 0 20px 0;font-weight:600;font-size:18px;\">
                                                    Detalles de su cuenta en NATURA
                                                </p>
                                                <span style=\"color:#777\">
                                                Estos son sus datos de acceso:<br /> 
                                                <span style=\"color:#333\"><strong>Usuario: <a href=\"#\" style=\"color:#337ff1\">".$usuario_Usuario."</a></strong></span><br />
                                                <span style=\"color:#333\"><strong>Contraseña:</strong></span> ".$usuario_Password."
                                                </span>
                                            </font>
                                        </td>
                                        <td width=\"10\" style=\"padding:7px 0\">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class=\"space_footer\" style=\"padding:0!important\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class=\"box\" style=\"background-color:#F3F6F9;padding:7px 0 20px 0\">
                                <table class=\"table\" style=\"width:100%\">
                                    <tr>
                                        <td width=\"10\" style=\"padding:7px 0\">&nbsp;</td>
                                        <td style=\"padding:7px 0\">
                                            <font size=\"2\" face=\"Open-sans, sans-serif\" color=\"#555454\">
                                                <p style=\"margin:3px 0 20px 0;font-weight:600;font-size:18px;\">Consejos de Seguridad:</p>
                                                <ol style=\"margin-bottom:0\">
                                                    <li>Mantenga los datos de su cuenta en un lugar seguro.</li>
                                                    <li>No comparta los detalles de su cuenta con otras personas.</li>
                                                    <li>Cambie su clave regularmente.</li>
    
                                                </ol>
                                            </font>
                                        </td>
                                        <td width=\"10\" style=\"padding:7px 0\">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class=\"space_footer\" style=\"padding:0!important\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class=\"linkbelow\" style=\"padding:7px 0;text-align: center;\">
                                <font size=\"2\" face=\"Open-sans, sans-serif\" color=\"#555454\">
                                    <span>Podrá consultar nuestra web: <a href=\"".$url_sitio."\" style=\"color:#009ca7\">NATURA</a></span>
                                </font>
                            </td>
                        </tr>
    
                        <tr>
                            <td class=\"space_footer\" style=\"padding:0!important\">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class=\"footer\" style=\"border-top:4px solid #009ca7;padding:7px 0;text-align: center;\">
                                © INN OFFICES 2022</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class=\"space\" style=\"width:20px;padding:7px 0\">&nbsp;</td>
            </tr>
        </table>
    </body>
    
    </html>";
    return $aux;
}


?>


