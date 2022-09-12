<?php 

    require_once '../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(array_key_exists( 'correo', $_POST )) {

        try {

            $pdo = new PDO(
                
                'mysql:host=localhost;dbname=paoe_db',
                'root'

            );

            $sql = "SELECT correo from psicologo WHERE correo = ?";
            $stl = $pdo->prepare($sql);
            $stl->bindValue(1, $_POST['correo']);
            $stl->execute();

            if( $resultado = $stl->fetch( PDO::FETCH_ASSOC )){ ?>

                <div class="contenedor">

                    <p><a class="link" href="/appaoe-web" style="text-decoration:none">APPAOE</a><p>

                    <h1> <?php echo 'Correo electrónico de recuperación enviado a '.$resultado['correo'];?> </h1>

                </div>
                
                <?php
                $token = uniqid();

                $sql = "UPDATE psicologo SET token = '$token' WHERE correo = '{$resultado['correo']}'";

                try {

                    $pdo->exec($sql);

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    
                    try {

                        $mail->isSMTP();
                        $mail->Host="smtp.gmail.com";
                        $mail->Port=587;
                        $mail->SMTPSecure="tls";
                        $mail->SMTPAuth=true;
                        $mail->Username="activoappsystem@gmail.com";
                        $mail->Password="kslaokduqzagdweh";
                        $mail->setFrom("activoappsystem@gmail.com","ActivoApp System");
                        $mail->AddAddress($_POST['correo']);

                        $mail->isHTML(true);
                        $mail->Subject='Recupere su clave';
                        $mail->Body='Haga click en <a href="http://localhost/appaoe-web/assets/php/recuperar_part2.php?token='.$token.'">este enlace</a>';

                        if(!$mail->send()){

                            echo $mail->ErrorInfo;

                        }
                        /*
                        
                         //Server settings
                        $mail->SMTPDebug = 2;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'user@example.com';                     //SMTP username
                        $mail->Password   = 'secret';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        //Recipients
                        $mail->setFrom('juansebasti14@gmail.com', 'Juan');
                    
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Recupere su clave';
                        $mail->Body    = 'Haga click en <a href="http://localhost/ActivoApp/recuperar_part2.php?token='.$token.'">este enlace</a>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        $mail->send();
                        echo 'Message has been sent';
                        
                        
                        
                        */  
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                }catch( PDOException $e ){

                    echo 'No pude guardar el token: '.$e->getMessage();

                }

            }else{
                echo 'No existe ese usuario';
            }

        }catch ( PDOException $e ){
            echo 'Fallo la conexion a la base: '.$e->getMessage();
        }

    }

?>
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
    <link rel="stylesheet" href="../css/styleRecuperacion.css">
</head>
<body>
    
</body>
</html>