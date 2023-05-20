<?php
include('./dataBase.php');

if (isset($_POST['name']) && isset($_POST['description'])) {
  // Guardamos los datos en sus variables respectivamente
  $name = $_POST['name'];
  $description = $_POST['description'];
  // Creamos la consulta sql para insertar los datos en la tabla
  $query = "INSERT INTO task(name, description) VALUES ('$name','$description')";
  // Ejecutamos nuestra consulta en nuestra tabla y su resultado lo guardamos en una variable
  $result = mysqli_query($connect, $query);

  // Si result no devuelve nada enviamos un mensaje de fallo
  if (!$result) {
    die("Query Failed");
  }
  echo "task added successfully";
}
