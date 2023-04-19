<?php

    session_start();

    if (isset($_POST['login'])) {
        
        // Establecer conexión con la base de datos
        $conn = mysqli_connect('localhost', 'root', 'root', 'usuarios');
        if (!$conn) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }
        
        // Obtener datos del formulario de inicio de sesión
        $username = $_POST['username'];
        $contrasena = $_POST['contrasena'];
        
        // Comprobar si el usuario y la contraseña coinciden con los registros de la base de datos
        $query = "SELECT * FROM usuario WHERE username='$username' AND contrasena='$contrasena'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            // Inicio de sesión exitoso
            $_SESSION['username'] = $username;
            header('Location: ../home.php');
        } else {
            // Error de inicio de sesión
            echo "Usuario o contraseña incorrectos";
        }
        
        // Cerrar conexión con la base de datos
        mysqli_close($conn);
    }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="../../static/usuario.css">
</head>
<body>
	<div class="login-container">
		<h1>Iniciar sesión</h1>
		<form method="post" action="login.php">
			<div class="form-element">
				<label>Nombre de usuario</label>
				<input type="text" name="username" placeholder="Username" required>
			</div>
			<div class=form-element>
                <label>Contrasena</label>
                <input type="password" name="contrasena" placeholder="Password" required>
            </div>
			<button type="submit" name="login">Iniciar sesión</button>
            <p><br>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
		</form>
		
	</div>
</body>
</html>
