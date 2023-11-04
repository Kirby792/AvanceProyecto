<?php
    var_dump($_POST);


    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "painani";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
    if (!$conn)
    {
        die("No hay conexion: ".mysqli_connect_error()); 
    }



    $nombre = $_POST["Usuario"];
    $pass = $_POST["Contraseña"];

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT * FROM login WHERE usuario = ? AND password = ?");
    $stmt->bind_param("ss", $nombre, $pass);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();
    $nr = $result->num_rows;

    if($nr == 1)
    {
        // Redirigir a la página "principal.html"
        header("Location: principal.html");
        exit;
    }
    else if ($nr == 0)
    {
        echo "El usuario no existe";
    }
   
?>
