<?php

    require 'db.php';


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleRecuperacion.css">
</head>
<body>
    
    

    <form class="formulario" action="recuperar_contrasena.php" method="POST">
        <h1>Recuperación de contraseña</h1>
        <div class="contenedor">
            <p><a class="link" href="/appaoe-web" style="text-decoration:none">APPAOE</a><p>
            <div class="input-contenedor">
                <p>Por favor ingrese su correo electrónico registrado en la aplicación</p>
                <i class="bx bx-user icon"></i>
                <input type="text" name="correo" placeholder="Ingresa su correo electrónico">
            </div>
            <input type="submit" value="Recuperar contraseña"/>
        </div>
    </form>

</body>
</html>