<?php 
include('./dataBase.php');

// Realizamos una consulta a la base de datos para traernos todas las tareas
$query = "SELECT * from task";
$result = mysqli_query($connect, $query);

// Si result no devuelve nada enviamos un mensaje de fallo
if (!$result) {
  die("Query Failed".mysqli_error($connect));
}

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
$jsonString = json_encode($json);
echo $jsonString;
