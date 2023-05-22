
<!DOCTYPE html>
<html>
<head>
    <title>Estilos PHP</title>
    <style>
        h1 {
                color: #0018d1;
            }

         p {  
            margin: 10px 0;
            } 
        
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];

            if(empty($nombre)|| empty($email)){
                header("Location: formulario.html?mensaje=Por%20favor,%20ingrese%20su%20nombre%20y%20correo%20electrónico");
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: formulario.html?mesanje=El%20correo%20electrónico%20ingresado%20no%20es%20válido");
            }else{
                echo "<h1>Formulario enviado correctamente</h1>";
                echo "<p>Nombre:<i> $nombre</i></p>";
                echo "<p>Apellido:<i> $apellido</i></p>";
                echo "<p>Email:<i> $email</i></p>";
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cursosql";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "INSERT INTO usuario (nombre, apellido, email) VALUES (:nombre, :apellido, :email)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido', $apellido);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            
                echo "<p><b>Registro insertado correctamente</b></p>";
            } catch(PDOException $e) {
                echo "Error en la conexión: " . $e->getMessage();
            }
           

            $conn = null;
        }
            ?>

    </body>
    </html>