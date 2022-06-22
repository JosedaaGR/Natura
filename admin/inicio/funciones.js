addEventListener("load", inicializar);
var conexion1;
function inicializar() {
  conexion1 = new XMLHttpRequest();
  conexion1.onreadystatechange = procesarCargado;
  conexion1.open("GET", "apihabitacion.php", true);
  conexion1.send();
}
function procesarCargado() {
  var div = document.getElementById("piechart");
  if (conexion1.readyState == 4) {
    var arrayhabitaciones = JSON.parse(conexion1.responseText);
    drawChart(arrayhabitaciones);
  } else {
    div.innerHTML = "Cargando...";
  }
}
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


function drawChart(array) {

  var habitaciones = [["Nombre", "Total"]];
  for (let index = 0; index < array.length; index++) {
    habitaciones.push([
      array[index].Nombre,
      array[index].Total,
    ]);
  }

    var data = google.visualization.arrayToDataTable(habitaciones);

  var options = {
    title: 'Habitaciones Más Comunes'
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

  chart.draw(data, options);
}
