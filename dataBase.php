<?php
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASS','');
define('BASE','tasks-app');

$connect = mysqli_connect(SERVIDOR, USUARIO, PASS, BASE);

/* if ($connect) {
  echo "DataBase is connected";
} */
