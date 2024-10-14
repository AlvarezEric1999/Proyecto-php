<?php
// datos de conexión
$server = "localhost";
$user = "root";
$password = "root";
$database = "user";



// Crear la conexión



$conexion = new mysqli($server, $user, $password, $database);


// Verificar la conexión a la base de datos
if(!$conexion)
{
    echo "no se ha podido conectar a la base de datos" . mysql_error();
}
else
{
    //echo "<b><h3>conectado a la base de datos<h3></b>";
}


$nombre = $_POST["nombre"] ?? null;
$contrasena = $_POST["contrasena"]?? null;


$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE Nombre = '" . $nombre . "' AND contrasena = '" . $contrasena . "'");

$result = mysqli_num_rows($query);



if($result >= 1 && $nombre && $contrasena)
{
    echo "<style>
                .bienvenida {
                    background-color: #4CAF50;
                    color: white;
                    padding: 20px;
                    text-align: center;
                    font-family: Arial, sans-serif;
                    font-size: 24px;
                    border-radius: 5px;
                    margin-top: 20px;
                }
              </style>";
  //echo "BIENVENIDO :" .$nombre;
  echo "<div class='bienvenida'>BIENVENIDO: " . $nombre . "</div>";
  exit();
}
else {
    // Si el nombre o la contraseña están vacíos, redirigir a la página de login
    header("Location: index_login.html");
    exit();
}

?>