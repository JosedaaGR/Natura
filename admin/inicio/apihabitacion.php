<?php 
try {
    $conexion = new PDO("mysql:host=localhost;dbname=gonzalezjd_general;charset=utf8", "gonzalezjd", "gOnzalezjd10");
} catch (PDOException $e) {
    die ("Error: " . $e->getMessage());
}
$consulta=$conexion->query("SELECT COUNT(*) total ,habitacion_Tipo from reserva INNER JOIN habitacion ON reserva_HabitacionFK=habitacion_CodPK GROUP BY reserva_HabitacionFK");

while($habitacion=$consulta->fetchObject()){
    $habitaciones[]=["Nombre"=>$habitacion->habitacion_Tipo,"Total"=>intval($habitacion->total)];
}
echo(json_encode($habitaciones));