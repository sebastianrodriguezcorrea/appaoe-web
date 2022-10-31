<?php

    $pdo = new PDO(
                    
        'mysql:host=localhost;dbname=paoe_db',
        'root'

    );

    if( array_key_exists( 'token', $_GET ) ) {

        $sql = "SELECT correo FROM cuenta WHERE token = ?";
        $st = $pdo->prepare( $sql );
        $st->bindValue( 1, $_GET['token'] );
        $st->execute();
        if( $resultado = $st->fetch( PDO::FETCH_ASSOC )){

            $sql = "UPDATE cuenta SET token = null WHERE correo = {$resultado['correo']};";
            $pdo->exec($sql);
            ?>

            <form class="formulario" action="recuperar_part2.php" method="POST">
                <?php 
                $sql2 = "SELECT nombres, apellidos, correo FROM usuario LEFT JOIN cuenta ON usuario.cedula = cuenta.usuario WHERE token = ?";
                ?>
                <h1> Bienvenido <?php echo $sql2['nombres']," ", $sql2['apellidos']; ?></h1>
                <input type="hidden" value="<?php echo $resultado['correo']; ?>" name="correo"/>
                <div class="contenedor">
                    <div class="input-contenedor">
                        <p>Ingrese su nueva contraseña</p>
                        <i class="bx bx-key icon"></i>
                        <input type="password" id="newPassword" name="newPassword" placeholder="Ingrese su nueva contraseña"/>
                    </div>
                    <input type="submit" value="Enviar"/>
            </form>
            <?php
        }
    }elseif ( array_key_exists( 'correo', $_POST ) ){ ?>

        <div class="contenedor">

            <p><a class="link" href="/appaoe-web" style="text-decoration:none">APPAOE</a><p>

            <?php
                $sql = "UPDATE cuenta SET contrasena = '".password_hash($_POST['newPassword'], PASSWORD_BCRYPT)."' WHERE correo = {$_POST['correo']};";
                $pdo->exec($sql);
            ?>

            <h1> <?php echo 'Contraseña cambiada con éxito'; ?> </h1>

        </div>
        <?php
    }?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperación</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
        <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style2.css">
    </head>
    <body>
        
    </body>
    </html>