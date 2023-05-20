<?php
include('./dataBase.php');
// Si existe por POST una variable con el valor de id realizamos lo siguiente
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  // Realizamos una consulta a la base de datos para traernos la tarea que coincida con la variable id
  $query = "SELECT * from task WHERE id = $id";
  $result = mysqli_query($connect, $query);
  // Si result no devuelve nada enviamos un mensaje de fallo
  if (!$result) {
    die("Query Failed");
  }
  // Si obtenemos algun valor del resultado, creamos un array
  $json = array();
  // Recorremos el resultado y por cada recorrido lo guardamos el array json
  while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'name' => $row['name'],
      'description' => $row['description'],
      'id' => $row['id']
    );
  }
  // Devolvemos el json en formato de String
  $jsonString = json_encode($json[0]);
  echo $jsonString;
}
