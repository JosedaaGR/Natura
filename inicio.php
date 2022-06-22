<?php
session_start();
include_once "./clases/conexion.php";
include_once "./clases/fun_aux_menu_intranet.php";
include_once "./clases/comprobar_usuario.php";
$conexion = new conexion();
$tuplauser = usuario_logueado();

if ($tuplauser != NULL) {
	//************************************************** DEPENDE DEL TIPO DE USUARIO **************************************************
	if (strcmp($tuplauser['usuario_Tipo'], "Admin") == 0)
		print("<script>document.location.href='./admin/inicio/index.php'</script>");
} //fin del if($tuplauser!=NULL)


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>NATURA</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
	<link rel="shortcut icon" href="favicon/favicon.ico">

	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<!--//fonts-->
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
							<li class="menu__item"><a href="#about" class="menu__link scroll">Acerca de</a></li>
							<li class="menu__item"><a href="#team" class="menu__link scroll">Equipo</a></li>
							<li class="menu__item"><a href="#gallery" class="menu__link scroll">Galería</a></li>
							<li class="menu__item"><a href="#rooms" class="menu__link scroll">Habitaciones</a></li>
							<li class="menu__item"><a href="./reservar.php" class="menu__link scroll">Reservar</a></li>
							<li class="menu__item  dropdown"> <a class="menu__link scroll dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user"></i> <?php print("" . $tuplauser['usuario_Usuario'] . ""); ?></a>
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
	<!-- banner -->
	<div id="home" class="w3ls-banner">
		<!-- banner-text -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="w3layouts-banner-top">

							<div class="container">
								<div class="agileits-banner-info">
									<h4>NATURA</h4>
									<h3>Sabemos lo que amas</h3>
									<p style="color: #F7F7F7;">Bienvenido a nuestro hotel</p>
									<div class="agileits_w3layouts_more menu__item">
										<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">leer más
										</a>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top1">
							<div class="container">
								<div class="agileits-banner-info">
									<h4>NATURA</h4>
									<h3>Quédate con amigos y familias</h3>
									<p style="color: #F7F7F7;">Ven y disfruta un momento precioso con nosotros</p>
									<div class="agileits_w3layouts_more menu__item">
										<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">leer más</a>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top2">
							<div class="container">
								<div class="agileits-banner-info">
									<h4>NATURA</h4>
									<h3>¿quiere unas vacaciones lujosas?</h3>
									<p style="color: #F7F7F7;">Obtenga alojamiento hoy</p>
									<div class="agileits_w3layouts_more menu__item">
										<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">leer más</a>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<!--banner Slider starts Here-->
		</div>
		<div class="thim-click-to-bottom">
			<a href="#gallery" class="scroll">
				<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
			</a>
		</div>
	</div>
	<!-- //banner -->
	<!--//Header-->
	<!-- //Modal1 -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<!-- Modal1 -->
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>HOTEL
						<span>NATURA</span>
					</h4>
					<img src="images/1.jpg" alt=" " class="img-responsive">
					<h5 style="text-align:center;">Sabemos lo que amas</h5>
					<p style="text-align:justify;">Ofrecemos a nuestros clientes vistas únicas y encantadoras desde sus habitaciones con sus comodidades excepcionales, haciendo que este hotel sea de los mejores hoteles de la zona.
						<br>Pruebe nuestro nuevo menú de comida, servicios increíbles y unas grandes personas mientras disfruta de su estancia aquí.
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- //Modal1 -->
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="agileits_banner_bottom">
				<h3><span>Experimenta una buena estancia, disfruta de fantásticas ofertas</span> Ofrecemos una acogedora bienvenida
				</h3>
			</div>
			<div class="w3ls_banner_bottom_grids">
				<ul class="cbp-ig-grid">
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_road"></span>
							<h4 class="cbp-ig-title">DORMITORIOS PRINCIPALES
							</h4>
							<span class="cbp-ig-category">NATURA</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_cube"></span>
							<h4 class="cbp-ig-title">BALCON CON VISTAS A LA PRADERA</h4>
							<span class="cbp-ig-category">NATURA</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_users"></span>
							<h4 class="cbp-ig-title">GRAN CAFE
							</h4>
							<span class="cbp-ig-category">NATURA</span>
						</div>
					</li>
					<li>
						<div class="w3_grid_effect">
							<span class="cbp-ig-icon w3_ticket"></span>
							<h4 class="cbp-ig-title">COBERTURA WIFI</h4>
							<span class="cbp-ig-category">NATURA
							</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //banner-bottom -->
	<!-- /about -->
	<div class="about-wthree" id="about">
		<div class="container">
			<div class="ab-w3l-spa">
				<h3 class="title-w3-agileits title-black-wthree">Un servicio de calidad al mejor precio
				</h3>
				<p class="about-para-w3ls"> En Natura sabemos que un ambiente ideal para los negocios de nuestros clientes es parte de su éxito, por este motivo le ofrecemos un lugar donde la elegancia, el confort y la modernidad se complementan con un trato personalizado y un servicio de primera que harán de su estadía la clave de su éxito.
				</p>
				<img src="images/about.jpg" class="img-responsive" alt="Hair Salon">
				<div class="w3l-slider-img">
					<img src="images/a1.jpg" class="img-responsive" alt="Hair Salon">
				</div>
				<div class="w3ls-info-about">
					<h4 style="color: #C4B5A0;">¡Te encantarán todas las comodidades que ofrecemos
						!</h4>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //about -->
	<!--sevices-->
	<div class="advantages">
		<div class="container">
			<div class="advantages-main">
				<h3 class="title-w3-agileits">Servicios
				</h3>
				<div class="advantage-bottom">
					<div class="col-md-6 advantage-grid left-w3ls wow bounceInLeft" data-wow-delay="0.3s">
						<div class="advantage-block ">
							<i class="fa fa-credit-card" aria-hidden="true"></i>
							<h4>Quédate primero, paga después! </h4>
							<p>En nuestro hotel una de las prioridades es que disfrutes de la estancia lo máximo posible, por ello tenemos varios puntos o aspectos
								en los cuales nos identificamos.
							</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Habitación decorada, con aire acondicionado
							</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Balcón privado
							</p>

						</div>
					</div>
					<div class="col-md-6 advantage-grid right-w3ls wow zoomIn" data-wow-delay="0.3s">
						<div class="advantage-block">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<h4>Varios tipos de servicio
							</h4>
							<p>Disponemos de varios servicios a elegir:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Buffet Libre
							</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Todo Incluido
							</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Todo Includio + SPA
							</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Desayuno y Cena
							</p>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!--//sevices-->
	<!-- team -->
	<div class="team" id="team">
		<div class="container">
			<h3 class="title-w3-agileits title-black-wthree">Nuestro Equipo</h3>
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>
						<img src="images/teams1.jpg" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/teams2.jpg" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/teams3.jpg" alt=" " class="img-responsive" />
					</li>
				</ul>
				<div class="resp-tabs-container">
					<div class="tab1">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Antonio Ramirez</h4>
							<span>Gerente
							</span>
							<p>Planifica, organiza, coordina, supervisa y evalúa las actividades y los procesos administrativos del establecimiento hotelero. <br>
								Es el responsable de todos los servicios del hotel, incluyendo la recepción, los servicios de Amas de Llaves, las reservas, los banquetes, el mantenimiento y la restauración</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab2">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Marta Gómez</h4>
							<span>Recepcionista
							</span>
							<p>Responsable de proporcionar todo tipo de información y la asistencia solicitada por el cliente en cada caso. Por tanto, debe tener una visión global del hotel que le ayudará a resolver las demandas del cliente. Incluyendo el recibimiento, el check-in...</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab3">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Federico García</h4>
							<span>Community Manager</span>
							<p>
								Construye, amplia y administra comunidades online, a través de herramientas analíticas que le permiten medir cómo los usuarios entienden y perciben a una marca determinada, intentan que esa sensación se asemeje lo más posible al objetivo de comunicación de la empresa.
							</p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //team -->
	<!-- Gallery -->
	<section class="portfolio-w3ls" id="gallery">
		<h3 class="title-w3-agileits title-black-wthree">Galería
		</h3>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g1.jpg" class="swipebox"><img src="images/g7.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g2.jpg" class="swipebox"><img src="images/g2.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g3.jpg" class="swipebox"><img src="images/g10.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g4.jpg" class="swipebox"><img src="images/g4.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g5.jpg" class="swipebox"><img src="images/g9.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g6.jpg" class="swipebox"><img src="images/g6.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g6.jpg" class="swipebox"><img src="images/g2.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>
		<div class="col-md-3 gallery-grid gallery1">
			<a href="images/g6.jpg" class="swipebox"><img src="images/g8.jpg" class="img-responsive" alt="/">
				<div class="textbox">
					<h4>NATURA
					</h4>
					<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
				</div>
			</a>
		</div>

		<div class="clearfix"> </div>
	</section>
	<!-- //gallery -->
	<!-- rooms & rates -->
	<div class="plans-section" id="rooms">
		<div class="container">
			<h3 class="title-w3-agileits title-black-wthree">Habitaciones y tarifas
			</h3>
			<div class="priceing-table-main">
				<?php
				$sqlhabit = "SELECT * FROM habitacion WHERE habitacion_Estado='Activo'";
				$reshabit = $conexion->BD_Consulta($sqlhabit);
				$tuplahbit = $conexion->BD_GetTupla($reshabit);
				$i = 0;
				while ($tuplahbit != NULL) {
					$i++;
					print(" <div class=\"col-md-3 price-grid\">
					<div class=\"price-block agile\">
						<div class=\"price-gd-top\">
						");
					if (($i % 5) == 0) {
						print("<img src=\"images/r1.jpg\" class=\"img-responsive\" />");
					} else
						if (($i % 3) == 0) {
						print("<img src=\"images/r2.jpg\" class=\"img-responsive\" />");
					} else
						if (($i % 2) == 0) {
						print("<img src=\"images/r3.jpg\" class=\"img-responsive\" />");
					} else {

						print("<img src=\"images/r4.jpg\" class=\"img-responsive\" />");
					}
					print("
							<h4>" . $tuplahbit['habitacion_Tipo'] . "
							</h4>
						</div>
						<div class=\"price-gd-bottom\">
							<div class=\"price-list\">
							" . $tuplahbit['habitacion_Observaciones'] . "
							</div>
							<div class=\"price-selet\">
								<h3>" . $tuplahbit['habitacion_Precio'] . "<span>€</span></h3>
								<a href=\"reservar.php?habitacion_CodPK=" . $tuplahbit['habitacion_CodPK'] . "\"> Reservar ahora
								</a>
							</div>
						</div>
					</div>
				</div>");


					$tuplahbit = $conexion->BD_GetTupla($reshabit);
				} //fin del while($tuplahbit!=NULL)
				?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--// rooms & rates -->

	<!-- contact -->
	<section class="contact-w3ls" id="contact">
		<div class="container">

			<div class="col-lg-12 col-md-12 col-sm-12 contact-w3-agile1" data-aos="flip-right">
				<h4>Contacte con Nosotros
				</h4>
				<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:josedaagonzalz11@gmail.com">info@natura.es</a></p>
				<p class="contact-agile1"><strong>Direccion :</strong> C/ Nuestra Señora de Fatima, Los Molares, Sevilla</p>
				<p class="contact-agile1"><strong>Telefono :</strong> +34 605 21 46 96</p>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d562.103393523635!2d-5.717650362644196!3d37.15895337104612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0d7ffcce28cd53%3A0xefbd948697e07977!2s41750%20Los%20Molares%2C%20Sevilla!5e0!3m2!1ses!2ses!4v1655831525656!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
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
	<!-- /contact -->
	<div class="copy">
		<p>© 2022 <a href="inicio.php">NATURA</a> </p>
	</div>
	<!--/footer -->
	<!-- js -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- contact form -->
	<script src="js/jqBootstrapValidation.js"></script>

	<!-- /contact form -->
	<!-- gallery popup -->
	<link rel="stylesheet" href="css/swipebox.css">
	<script src="js/jquery.swipebox.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
	<!-- //gallery popup -->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				// event.preventDefault();
				$('html').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- flexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
				start: function(slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>
	<!-- //flexSlider -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function() {
			// Slideshow 4
			$("#slider4").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function() {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function() {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>

	<!--tabs-->
	<script src="js/easy-responsive-tabs.js"></script>
	<script>
		$(document).ready(function() {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				closed: 'accordion', // Start closed if in accordion view
				activate: function(event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
			$('#verticalTab').easyResponsiveTabs({
				type: 'vertical',
				width: 'auto',
				fit: true
			});
		});
	</script>
	<!--//tabs-->
	<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>

	<div class="arr-w3ls">
		<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
	<!-- //smooth scrolling -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
</body>

</html>