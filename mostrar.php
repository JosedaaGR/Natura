<?php

	include_once "clases/conexion.php";
	include_once "clases/comprobar_usuario.php";
	include_once "clases/fechas.php";
	$conexion = new conexion();

	if(isset($_GET['reserva_CodPK'])){
		$reserva_CodPK = $_GET['reserva_CodPK'];
	}else{
		print("<script>document.location.href='mis-reservas.php'</script>");

	}
	
	$sql ="SELECT * FROM reserva INNER JOIN habitacion ON reserva_HabitacionFK=habitacion_CodPK INNER JOIN servicio ON reserva_ServicioFK=servicio_CodPK INNER JOIN cama ON reserva_CamaFK=cama_CodPK INNER JOIN usuario ON reserva_UsuarioFK=usuario_CodPK INNER JOIN provincia ON usuario_Provincia=provincia_CodPK INNER JOIN poblacion_provincia ON usuario_Poblacion=poblacion_CodPK WHERE reserva_CodPK=" . $reserva_CodPK;
	$resSql = $conexion->BD_Consulta($sql);
	$vectorSql = $conexion->BD_GetTupla($resSql);
	
									
	?>
<html>
<head>
		<meta charset="utf-8">
		<title>Detalles de la clave del libro
</title>
<link rel="shortcut icon" href="favicon/favicon.ico">

		
		<style>
		/* reset */

*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; text-align: center;}
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
		</style>
		
	</head>
	<body>

		<header>
			<h1>INFORMACIÓN SOBRE LA RESERVA
</h1>
			<address >
				<p>HOTEL NATURA</p>
				<p>C/ Nuestra Señora de Fátima,<br>Los Molares,<br>Sevilla</p>
				<p>+34 605 21 46 96 </p>
			</address>
			<span><img alt="" src="assets/media/logo.png"></span>
		</header>
		<article>
			<h1></h1>
			<address >
				
				<p><br></p>
				<p> <?php echo $vectorSql['usuario_Nombre']." ".$vectorSql['usuario_Apellidos'];?><br></p>
			</address>
			<table class="meta">
				<tr>
					<th><span > DNI Cliente</span></th>
					<td><span ><?php echo $vectorSql['usuario_DNI']; ?></span></td>
				</tr>
				<tr>
					<th><span >Fecha de entrada</span></th>
					<td><span ><?php echo cambiaf_a_normal($vectorSql['reserva_Finicio']); ?> </span></td>
				</tr>
				<tr>
					<th><span >Fecha de salida</span></th>
					<td><span ><?php echo cambiaf_a_normal($vectorSql['reserva_Ffin']); ?> </span></td>
				</tr>
				<tr>
					<th><span >Personas</span></th>
					<td><span ><?php echo $vectorSql['reserva_Npersonas']; ?> </span></td>
				</tr>
			</table>
			<table >
					<tr> 
						<td>Telefono :  <?php echo $vectorSql['usuario_Telefono']; ?> </td>
						<td>Email : <?php echo $vectorSql['usuario_Email']; ?> </td>
					</tr>
					<tr> 
						<td>Poblacion : <?php echo  $vectorSql['poblacion_Nombre']; ?> </td>
						<td>Direccion : <?php echo  $vectorSql['usuario_Direccion']; ?> </td>

					</tr>
				</table>
				<br>
				<br>
			<table class="inventory">
				<thead>
					<tr>
						<th><span >Opciones</span></th>
						<th><span >Precio</span></th>
						
					</tr>
				</thead>
				<?php 
				if($vectorSql['reserva_Finicio']!=$vectorSql['reserva_Ffin']){
					$date1 = new DateTime($vectorSql['reserva_Finicio']);
					$date2 = new DateTime($vectorSql['reserva_Ffin']);
					$diff = $date1->diff($date2);
					$precio=(($vectorSql['cama_Precio']+$vectorSql['habitacion_Precio']+$vectorSql['servicio_Precio'])*$vectorSql['reserva_Npersonas'])*$diff->days;
					}else{
					$precio=(($vectorSql['cama_Precio']+$vectorSql['habitacion_Precio']+$vectorSql['servicio_Precio'])*$vectorSql['reserva_Npersonas']);
					}
				?>
				<tbody>
				
					<tr>
						<td><span ><?php echo $vectorSql['habitacion_Tipo']; ?></span></td>
						<td><span ><?php echo $vectorSql['habitacion_Precio']; ?> €</span></td>
						
					</tr>
					<tr>
						<td><span >Cama <?php echo $vectorSql['cama_Tipo']; ?> </span></td>
						<td><span ><?php echo $vectorSql['cama_Precio']; ?> €</span></td>
						
					</tr>
					<tr>
						<td><span ><?php echo $vectorSql['servicio_Nombre']; ?>  </span></td>
						<td><span ><?php echo $vectorSql['servicio_Precio']; ?> €</span></td>
						
					</tr>
					
					<tr>
						<td style="border: 0px solid;"></td>
						<td><span >Total: <?php echo $precio; ?> €</span></td>
						
					</tr>
				</tbody>
			</table>
			
			
		</article>
		
	</body>
</html>

<?php 

ob_end_flush();

?>