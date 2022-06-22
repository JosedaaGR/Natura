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

$conexion = new conexion();
$url_sitio = $conexion->url_sitio;
$nombre_empresa = $conexion->nombre_empresa_panel_control;
$vectorUsuario = Seguridad();
?>
<!DOCTYPE html>
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
    <?PHP imprime_sidebar("Inicio"); ?>
    <!--Main Content-->
    <section class="l-container">
      <?PHP imprime_header(); ?>
      <!-- Row 1 - Page Summary Info-->
      <!-- Page Summary Widget-->
      <div class="widget-page-summary">
        <!-- Row 2 - Tabs Statistic-->
        <div class="l-spaced-vertical group">
          <!-- Widget Tabs 2-->

          <!-- Row 3 - General-->
          <div class="l-spaced-vertical">

          </div>
          <!-- Row 4 - Operating System, Demographics-->
          <div class="l-spaced">
            <div class="l-row">
              <div class="l-col-lg-12 l-col-md-12">
                <!-- Widget Statistic - Operating System-->
                <div class="widget-statistic is-statistic-right is-statistic-left">
                  <div class="statistic-header">
                    <div class="l-span-sm-12">
                      <ul class="statistic-options">
                        <li><a id="statisticFullScreen_2" href="#" title="Fullscreen" data-ason-type="fullscreen" data-ason-target=".widget-statistic" data-ason-content="true" class="ason-widget tt-top"></a></li>
                        <li><a href="#" title="Refresh" data-ason-type="refresh" data-ason-target=".widget-statistic" data-ason-duration="1000" class="ason-widget tt-top"><i class="fa fa-rotate-right"></i></a></li>
                        <li><a href="#" title="Toggle" data-ason-type="toggle" data-ason-find=".widget-statistic" data-ason-target=".statistic-body" data-ason-content="true" data-ason-duration="200" class="ason-widget tt-top"></a></li>
                        <li class="last"><a href="#" title="Delete" data-ason-type="delete" data-ason-target=".widget-statistic" data-ason-content="true" data-ason-animation="fadeOut" class="ason-widget tt-top"></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="statistic-body">
                    <div class="l-row">
                      <div class="l-span-lg-4 l-span-md-3 l-span-sm-4">
                        <div class="statistic-item t-item-4">
                          <ul>
                            <li class="item-title"><i class="fa fa-users"></i><br />Clientes</li>
                          </ul>
                          <br />
                          <a href="../usuario/index.php" class="btn btn-default btn-lg" alt="...">ACCEDER</a>
                        </div>
                      </div>
                      <div class="l-span-lg-4 l-span-md-3 l-span-sm-4">
                        <div class="statistic-item t-item-1">
                          <ul>
                            <li class="item-title"><i class="fa fa-list-ul"></i><br />Reservas</li>
                          </ul>
                          <br />
                          <a href="../reserva/index.php" class="btn btn-default btn-lg" alt="...">ACCEDER</a>
                        </div>
                      </div>
                      <div class="l-span-lg-4 l-span-md-3 l-span-sm-4">
                        <div class="statistic-item t-item-3">
                          <ul>
                            <li class="item-title"><i class="fa fa-bed"></i><br />Habitaciones</li>
                          </ul>
                          <br />
                          <a href="../habitacion/index.php" class="btn btn-default btn-lg" alt="...">ACCEDER</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="l-col-lg-12 l-col-md-12">
                <!-- Widget Statistic - Operating System-->
                <div class="widget-statistic is-statistic-right is-statistic-left">
                  <div class="statistic-header">
                    <div class="l-span-sm-12">
                      <ul class="statistic-options">
                        <li><a id="statisticFullScreen_2" href="#" title="Fullscreen" data-ason-type="fullscreen" data-ason-target=".widget-statistic" data-ason-content="true" class="ason-widget tt-top"></a></li>
                        <li><a href="#" title="Refresh" data-ason-type="refresh" data-ason-target=".widget-statistic" data-ason-duration="1000" class="ason-widget tt-top"><i class="fa fa-rotate-right"></i></a></li>
                        <li><a href="#" title="Toggle" data-ason-type="toggle" data-ason-find=".widget-statistic" data-ason-target=".statistic-body" data-ason-content="true" data-ason-duration="200" class="ason-widget tt-top"></a></li>
                        <li class="last"><a href="#" title="Delete" data-ason-type="delete" data-ason-target=".widget-statistic" data-ason-content="true" data-ason-animation="fadeOut" class="ason-widget tt-top"></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="statistic-body">
                      <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
              </div>
              
              <!--FOOTER-->
              <?PHP imprime_pie(); ?>
    </section>
    <!-- ===== JS =====-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="funciones.js"></script>
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
    <script src="../js/plugins/pageprogressbar/pace.min.js"></script>

    <!-- Specific-->
    <script src="../js/shared/jquery.cookie.min.js"></script>
    <script src="../js/shared/jquery.easing.1.3.js"></script>
    <script src="../js/shared/perfect-scrollbar.min.js"></script>
    <script src="../js/plugins/accordions/jquery.collapsible.min.js"></script>
    <script src="../js/plugins/charts/c3/c3.min.js"></script>
    <script src="../js/plugins/charts/c3/d3.v3.min.js"></script>
    <script src="../js/plugins/charts/other/jquery.easypiechart.min.js"></script>
    <script src="../js/plugins/charts/rickshaw/rickshaw.min.js"></script>
    <script src="../js/plugins/datetime/jqClock.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.bootstrap-touchspin.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.checkBo.min.js"></script>
    <script src="../js/plugins/forms/elements/jquery.switchery.min.js"></script>
    <script src="../js/plugins/table/footable.all.min.js"></script>
    <script src="../js/plugins/tabs/jquery.easyResponsiveTabs.js"></script>
    <script src="../js/plugins/textrotator/jquery.simple-text-rotator.min.js"></script>
    <script src="../js/plugins/tooltip/jquery.tooltipster.min.js"></script>
    <script src="../js/plugins/weather/jquery.simpleWeather.min.js"></script>
    <script src="../js/calls/dashboard.1.js"></script>
    <script src="../js/calls/part.header.1.js"></script>
    <script src="../js/calls/part.sidebar.2.js"></script>
    <script src="../js/calls/part.theme.setting.js"></script>
    <script src="../js/calls/shared.tooltipster.js"></script>

</body>

</html>