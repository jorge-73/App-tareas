<?php 
include('./dataBase.php');

// Si existe por POST una variable con el valor de id realizamos lo siguiente
if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['id'])) {
  // Guardamos los datos en sus variables respectivamente
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  // Creamos la consulta sql para editar la tarea con el id que viene por la variable POST
  $query = "UPDATE task SET name='$name', description='$description' WHERE id = $id";

  // Ejecutamos nuestra consulta en nuestra tabla y su resultado lo guardamos en una variable
  $result = mysqli_query($connect, $query);

  // Si result no devuelve nada enviamos un mensaje de fallo
  if (!$result) {
    die("Query Failed");
  }
  // Si resultado obtiene un valor enviamos un mensaje de exito
  echo "task updated successfully";
}


?>