<?php 
include('./dataBase.php');

// Guardo el valor que viene por POST en la variable search
$search = $_POST['search'];

// Si la variable search no esta vacio hacemos lo siguiente
if (!empty($search)) {
  // Generamos la consulta sql donde coincida lo que sea parecido al valor de search
  $query = "SELECT * FROM task WHERE name LIKE '$search%'";
  // Ejecutamos nuestra consulta en nuestra tabla y su resultado lo guardamos en una variable
  $result = mysqli_query($connect, $query);

  // Si el resultado esta vacio hacemos lo siguiente
  if (!$result) {
    // Terminamos el proceso con un mensaje de error
    die(('Query Error').mysqli_error($connect));
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
  $jsonString = json_encode($json);
  echo $jsonString;
}

?>