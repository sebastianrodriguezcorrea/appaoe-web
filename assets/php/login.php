<?php 

    session_start();

    if (isset($_SESSION['id'])) {

        header('Location: /appaoe-web');

    }

    require 'db.php';

    if(!empty($_POST['correo']) && !empty($_POST['contrasena'])){

        $records = $conn->prepare('SELECT cedula, correo, contrasena FROM psicologo WHERE correo = :correo');
        $records->bindParam(':correo', $_POST['correo']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if($results != null){

            if(count($results) > 0 && password_verify($_POST['contrasena'], $results['contrasena'])) {

                $_SESSION['id'] = $results['id'];
                header('Location: /appaoe-web/inicio');
    
            } else {
    
                $message = 'Credenciales incorrectas, intentelo nuevamente.';
    
            }

        } else {

            $message = 'Credenciales incorrectas, intentelo nuevamente.';
            
        }
        

    }

?>