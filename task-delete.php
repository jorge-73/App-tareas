<?php
include('./dataBase.php');

// Si existe por POST una variable con el valor de id realizamos lo siguiente
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  // Creamos la consulta sql para eliminar la tarea con el id que viene por la variable POST
  $query = "DELETE FROM task WHERE id = $id";

  // Ejecutamos nuestra consulta en nuestra tabla y su resultado lo guardamos en una variable
  $result = mysqli_query($connect, $query);

  // Si result no devuelve nada enviamos un mensaje de fallo
  if (!$result) {
    die("Query Failed");
  }
  // Si resultado obtiene un valor enviamos un mensaje de exito
  echo "task successfully deleted";
}
