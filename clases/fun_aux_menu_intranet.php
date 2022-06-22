<?PHP
$expire=time()+60*60*24*30*12;

function imprime_cabecera()
{    
    print("<!--HEADER SLIDE-->
    <header id=\"header\" class=\"l-header-slide l-header-slide-3 t-header-slide-3\">
      <div class=\"widget-weather-forecast l-row\">
        <div class=\"l-span-xl-10 l-span-lg-9 l-span-md-9 l-span-sm-12\">
          <div id=\"weatherForecast\">&amp;nbsp;
          </div>
        </div>
        <div class=\"l-span-xl-2 l-span-lg-3 l-span-md-3 hidden-sm hidden-xs\">
          <div class=\"weather-forecast-settings\">
            <h3>Forecast Settings</h3>
            <div class=\"form-group\">
              <div class=\"input-group input-group-sm\">
                <div class=\"input-group-addon\"><i class=\"fa fa-map-marker\"></i></div>
                <input type=\"text\" placeholder=\"Search location\" value=\"New York, NY\" class=\"forecast-location form-control\"><span class=\"input-group-btn\">
                  <button type=\"button\" class=\"btn btn-dark forecast-location-btn\"><i class=\"fa fa-search\"></i></button></span>
              </div>
            </div>
            <div class=\"forecastcheckbo\">
              <div>
                <label class=\"forecast-unit cb-radio cb-radio-primary-1\">
                  <input type=\"radio\" name=\"temperature\" value=\"f\" checked=\"checked\">Fahrenheit
                </label>
              </div>
              <div>
                <label class=\"forecast-unit cb-radio cb-radio-primary-1\">
                  <input type=\"radio\" name=\"temperature\" value=\"c\">Celsius
                </label>
              </div>
            </div><a href=\"#\" class=\"forecast-geo-location\">Use Your Location</a>
          </div>
        </div>
      </div>
    </header>");		    
}//fin del function imprime_cabecera()


function imprime_header()
{
    $conexion = new conexion();
    
    $nombre_empresa=$conexion->nombre_empresa_panel_control;
    
    print("<!--HEADER-->
        <header class=\"l-header l-header-1 t-header-1\">
          <div class=\"navbar navbar-ason\">
            <div class=\"container-fluid\">
              <div class=\"navbar-header\">
                <button type=\"button\" data-toggle=\"collapse\" data-target=\"#ason-navbar-collapse\" class=\"navbar-toggle collapsed\"><span class=\"sr-only\">Toggle navigation</span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button><a href=\"index.html\" class=\"navbar-brand widget-logo\"><span class=\"logo-default-header\"><img src=\"../img/logo_dark.png\" alt=\"Proteus\"></span></a>
              </div>
              <div id=\"ason-navbar-collapse\" class=\"collapse navbar-collapse\">
                <div class=\"col-md-4\">
                  <h2 class=\"page-title\">Bienvenido a <strong>" . $nombre_empresa . "</strong></h2>
                </div>
                <ul class=\"nav navbar-nav navbar-right\">");
                /*<li>
                    <!-- Slide Header Switcher--><a href=\"#\" title=\"Show Weather Forecast\" data-ason-type=\"header\" data-ason-header=\"l-header-slide-3\" data-ason-header-push=\"l-header-slide-push-3\" data-ason-anim-all='[\"velocity\",\"transition.expandIn\",\"transition.fadeOut\"]' data-ason-is-push=\"true\" data-ason-target=\"#header\" class=\"sidebar-switcher switcher t-switcher-header ason-widget\"><i class=\"fa fa-cloud\"></i></a>
                  </li>*/
        print("<li class=\"hidden-sm\">
                    <!-- Full Screen Toggle--><a href=\"#\" class=\"full-screen-page sidebar-switcher switcher t-switcher-header\"><i class=\"fa fa-expand\"></i></a>
                  </li>
                  <li>
		    <!-- Close --><a href=\"../desconectar.php\"><i class=\"fa fa-power-off\"></i> Cerrar sesión</a>");
    
                    /*<!-- Profile Widget-->
                    <div class=\"widget-profile profile-in-header\">
                      <button type=\"button\" data-toggle=\"dropdown\" class=\"btn dropdown-toggle\"><span class=\"name\">Pepito Pérez</span><img src=\"" . $imagen_user . "\"></button>
                      <ul role=\"menu\" class=\"dropdown-menu\">
                        <!--li><a href=\"page-profile.html\"><i class=\"fa fa-user\"></i>Profile</a></li>
                        <li><a href=\"app-mail.html\"><i class=\"fa fa-envelope\"></i>Inbox</a></li>
                        <li><a href=\"#\"><i class=\"fa fa-cog\"></i>Settings</a></li>
                        <li class=\"lock\"><a href=\"page-lock-screen.html\"><i class=\"fa fa-lock\"></i>Log Out</a></li-->
                        <li class=\"power\"><a href=\"#\"><i class=\"fa fa-power-off\"></i>Cerrar sesión</a></li>
                      </ul>
		      <div class=\"power\"><a href=\"#\"><i class=\"fa fa-power-off\"></i>Cerrar sesión</a></div>
                    </div>*/
                print("</li>
                </ul>
              </div>
            </div>
          </div>
        </header>");	    
}//fin del function imprime_header()

function imprime_favicon()
{
    print("<link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"./favicon/apple-icon-57x57.png\">
	<link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"./favicon/apple-icon-60x60.png\">
	<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"./favicon/apple-icon-72x72.png\">
	<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"./favicon/apple-icon-76x76.png\">
	<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"./favicon/apple-icon-114x114.png\">
	<link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"./favicon/apple-icon-120x120.png\">
	<link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"./favicon/apple-icon-144x144.png\">
	<link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"./favicon/apple-icon-152x152.png\">
	<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"./favicon/apple-icon-180x180.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"192x192\"  href=\"./favicon/android-icon-192x192.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"./favicon/favicon-32x32.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"./favicon/favicon-96x96.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"./favicon/favicon-16x16.png\">
	<link rel=\"manifest\" href=\"./favicon/manifest.json\">
	<meta name=\"msapplication-TileColor\" content=\"#ffffff\">
	<meta name=\"msapplication-TileImage\" content=\"./favicon/ms-icon-144x144.png\">
	<meta name=\"theme-color\" content=\"#ffffff\">");
}

function imprime_sidebar($section)
{
    $active_admin="";
    $active_usuario="";
    $active_habitacion="";
    $active_servicio="";
    $active_cama="";
    $active_reserva="";


if(strcmp($section,"admin")==0)
	$active_admin="class=\"active\"";
  if(strcmp($section,"usuario")==0)
	$active_usuario="class=\"active\"";
  if(strcmp($section,"habitacion")==0)
	$active_habitacion="class=\"active\"";
  if(strcmp($section,"servicio")==0)
	$active_servicio="class=\"active\"";

  if(strcmp($section,"cama")==0)
	$active_cama="class=\"active\"";
  if(strcmp($section,"reserva")==0)
	$active_reserva="class=\"active\"";

   
	
    print("<aside id=\"sb-left\" class=\"l-sidebar l-sidebar-1 t-sidebar-1\">
        <!--Switcher-->
        <div class=\"l-side-box\"><a href=\"#\" data-ason-type=\"sidebar\" data-ason-to-sm=\"sidebar\" data-ason-target=\"#sb-left\" class=\"sidebar-switcher switcher t-switcher-side ason-widget\"><i class=\"fa fa-bars\"></i></a></div>
        <!-- Profile in sidebar-->
        <!--div class=\"widget-profile-2 profile-2-in-side-2 t-profile-2-3\"><a href=\"#\" title=\"Toggle Profile\" class=\"tt-left profile-2-toggle\"><i class=\"fa fa-angle-down\"></i></a>
          <div class=\"profile-2-wrapper\">
            <div class=\"profile-2-details\">
              <div class=\"profile-2-img\"><a href=\"page-profile.html\"><img src=\"img/profile/profile.jpg\"></a></div>
              <ul class=\"profile-2-info\">
                <li>
                  <h3>William Jones</h3>
                </li>
                <li>Designer</li>
                <li>
                  <div class=\"btn-group btn-group-sm btn-group-justified\"><a role=\"button\" title=\"Social Stats\" class=\"toggle-stats btn btn-dark tt-top\"><i class=\"fa fa-rss\"></i></a><a role=\"button\" title=\"Visitor Stats\" class=\"toggle-visitors btn btn-dark tt-top\"><i class=\"fa fa-area-chart\"></i></a><a href=\"page-profile.html\" title=\"Edit Profile\" class=\"btn btn-dark tt-top\"><i class=\"fa fa-cogs\"></i></a></div>
                </li>
              </ul>
            </div>
            <div class=\"profile-2-social-stats\">
              <div class=\"l-span-xs-4\">
                <div class=\"profile-2-status-nr text-danger\">527</div>Likes
              </div>
              <div class=\"l-span-xs-4\">
                <div class=\"profile-2-status-nr text-info\">232</div>Comments
              </div>
              <div class=\"l-span-xs-4\">
                <div class=\"profile-2-status-nr text-success\">15</div>Messages
              </div>
            </div>
            <div class=\"profile-2-chart\">
              <div class=\"hide rickshaw-visitors\"></div>
              <div id=\"rickshawVisitors\"></div>
              <div id=\"rickshawVisitorsLegend\" class=\"visitors_rickshaw_legend\"></div>
            </div>
          </div>
        </div-->
        
        <!-- Logo in Sidebar-->
        <div class=\"l-side-box\">
          <!--Logo-->
          <div class=\"widget-logo logo-in-side\">
            <h1><a href=\"../inicio/index.php\"><span class=\"logo-default visible-default-inline-block\"><img src=\"../img/logo.png\" alt=\"Logo\" /></span><span class=\"logo-medium visible-compact-inline-block\"><img src=\"../img/logo_medium.png\" alt=\"Logo\" title=\"Logo\"></span>
                <span class=\"logo-small visible-collapsed-inline-block\"><img src=\"../img/logo_small.png\" alt=\"Logo\" title=\"Logo\" /></spanl></a></h1>
          </div>
        </div>
        <!--Search-->
        <!--div class=\"l-side-box mt-5 mb-10\">
          <div class=\"widget-search search-in-side is-search-left t-search-4\">
            <div class=\"search-toggle\"><i class=\"fa fa-search\"></i></div>
            <div class=\"search-content\">
              <form role=\"form\" action=\"page-search.html\">
                <input type=\"text\" placeholder=\"Search...\" class=\"form-control\">
                <button type=\"submit\" class=\"btn\"><i class=\"fa fa-search\"></i></button>
              </form>
            </div>
          </div>
        </div-->
        <!--Main Menu-->
        <div class=\"l-side-box\">
          <!--MAIN NAVIGATION MENU-->
          <nav class=\"navigation\">
            <ul data-ason-type=\"menu\" class=\"ason-widget\">
                <li " . $active_admin . "><a href=\"../administradores/index.php\"><i class=\"icon fa fa-male\"></i><span class=\"title\">Administradores</span></a></li>
                <li " . $active_usuario . "><a href=\"../usuario/index.php\"><i class=\"icon fa fa-users\"></i><span class=\"title\">Clientes</span></a></li>
                <li " . $active_habitacion . "><a href=\"../habitacion/index.php\"><i class=\"icon fa fa-home\"></i><span class=\"title\">Habitaciones</span></a></li>
                <li " . $active_servicio . "><a href=\"../servicio/index.php\"><i class=\"icon fa fa-exchange\"></i><span class=\"title\">Servicios</span></a></li>
                <li " . $active_cama . "><a href=\"../cama/index.php\"><i class=\"icon fa fa-bed\"></i><span class=\"title\">Camas</span></a></li>
                <li " . $active_reserva . "><a href=\"../reserva/index.php\"><i class=\"icon fa fa-list-ul\"></i><span class=\"title\">Reservas</span></a></li>	
            </ul>
          </nav>
        </div>
      </aside>");
}//fin del function imprime_sidebar()



function imprime_pie()
{
    print("<footer class=\"l-footer l-footer-1 t-footer-1 clearfix\">
          <br />
          <div class=\"group pt-10 pb-10 ph\">
            <div class=\"copyright pull-left\">
              Diseño y desarrollo Natura
              © Copyright 2022 | Todos los derechos reservados.
            </div>
            <div class=\"version pull-right\">v 1.0</div>
          </div>
        </footer>");
}//fin del function imprime_pie()
function estado($estado)
{
    $seguir='';
    if(strcmp($estado, "Activo")==0)
    $seguir.="<option value=\"Activo\" selected=\"selected\">Activo</option>
          <option value=\"No_Activo\">Inactivo</option>";
    else
    $seguir.="<option value=\"Activo\">Activo</option>
          <option value=\"No_Activo\" selected=\"selected\">Inactivo</option>";

    return $seguir;
}//fin del function imprime_pie()
?>