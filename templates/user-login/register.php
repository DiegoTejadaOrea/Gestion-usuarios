<?php
    // Verificar si el formulario fue enviado
    if(isset($_POST['submit'])) {
        // Establecer la conexión con la base de datos
        $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'usuarios');
        
        // Verificar si la conexión fue exitosa
        if(!$conn) {
            die('Error al conectar con la base de datos: '.mysqli_connect_error());
        }
        
        // Obtener los valores del formulario
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        
        // Verificar si el nombre de usuario ya existe en la base de datos
        $sql = "SELECT * FROM usuario WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            echo "El nombre de usuario ya está en uso.";
            exit();
        }
        
        // Insertar los datos del usuario en la base de datos
        $sql = "INSERT INTO usuario (username, email, contrasena) VALUES ('$username', '$email', '$contrasena')";
        
        if(mysqli_query($conn, $sql)) {
            echo "Registro exitoso!";
        } else {
            //que salga un mensaje pero mantenga en la misma pagina
            echo "Error al registrar el usuario: ".mysqli_error($conn);
            //redireccionar a la pagina de registro
            header("Location: register.php");
        }
        
        // Cerrar la conexión con la base de datos
        mysqli_close($conn);
    }
?>

<!-- Código HTML del formulario de registro -->


<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../../static/usuario.css">
    </head>
    <body>
        <form method="post" action="register.php">
            <div class=form-element>
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" pattern="[a-zA-Z0-9]+" required>
            </div>
            <div class=form-element>
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class=form-element>
                <label>Contrasena</label>
                <input type="password" name="contrasena" placeholder="Password" required>
            </div>
            <input type="submit" name="submit" value="Register"><br><br>
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia aquí</a></p>
        </form>
    </body>
</html>