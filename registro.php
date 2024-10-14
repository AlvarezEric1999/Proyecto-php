<?php
// Datos de conexión
$server = "localhost";
$user = "root";
$password = "root";
$database = "user";

// Obtener los datos del formulario
$nombre = $_POST["nombre"] ?? null;
$email = $_POST["email"] ?? null;
$documento = $_POST["numero-documento"] ?? null;
$contrasena = $_POST["contrasena"] ?? null;

// Crear la conexión
$conexion = new mysqli($server, $user, $password, $database);

// Verificar la conexión a la base de datos
if ($conexion->connect_error) {
    die("No se ha podido conectar a la base de datos: " . $conexion->connect_error);
} else {
    //echo "<b><h3>Conectado a la base de datos</h3></b>";
}



// Insertar los datos en la tabla usuario
$instruction_Sql = "INSERT INTO usuario (nombre, email, documento, contrasena)
                    VALUES ('$nombre', '$email', '$documento', '$contrasena')";

//validar que los campos tengan informacion antes de hacer la insercion de los datos
if($nombre && $email && $documento && $contrasena ){

    if (mysqli_query($conexion, $instruction_Sql)) {
        //echo "Datos insertados correctamente.<br>";
    } else {
        echo "Error al insertar datos: " . mysqli_error($conexion) . "<br>";
    }
    
    // Ejecutar la consulta SELECT para obtener los datos
    $consulta = "SELECT * FROM usuario";
    $resultado = mysqli_query($conexion, $consulta);
    
    echo "<style>
    table {
        width: 60%;
        margin: 20px auto;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
        color: #333;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    h2 {
        margin: 0;
    }
    
     h1 {
                text-align: center;
                font-family: Arial, sans-serif;
                color: #333;
                margin-top: 20px;
            }
    
       .btn-regresar {
                display: block;
                width: 200px;
                margin: 20px auto;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                text-align: center;
                border: none;
                border-radius: 5px;
                font-family: Arial, sans-serif;
                font-size: 16px;
                cursor: pointer;
                text-decoration: none;
            }
            .btn-regresar:hover {
                background-color: #0056b3;
            } 
            
    </style>";
    
    
    
    echo "<h1>Usuario Registrado</h1>";
    
    // Verificar si se obtuvieron resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Recorrer los resultados y mostrarlos en una tabla HTML
        echo "<table border='1'>";
          // Encabezado de la tabla
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Email</th>";
        echo "<th>Documento</th>";
        echo "</tr>";
        echo "</thead>";
        
        // Cuerpo de la tabla
        echo "<tbody>";
        
        while ($colum = mysqli_fetch_array($resultado)) {
           
      
            echo "<tr>";
            echo "<td><h2>" . $colum['Nombre'] . "</h2></td>";
            echo "<td><h2>" . $colum['email'] . "</h2></td>";
            echo "<td><h2>" . $colum['documento'] . "</h2></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }
    echo '<a href="index_login.html" class="btn-regresar"> Login</a>';
    
    // Cerrar la conexión
    $conexion->close();

}else{
    header("Location: registro.html");
}

// Ejecutar la consulta de inserción

?>
