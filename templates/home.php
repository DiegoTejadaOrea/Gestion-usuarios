<?php include 'navbar.php'; ?>
<?php
session_start(); // Iniciar sesión

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("location: /user-login/login.php"); // Redirigir a la página de inicio de sesión si el usuario no ha iniciado sesión
}

// Mostrar mensaje de bienvenida al usuario
$username = $_SESSION['username'];
echo "<h1>Bienvenido " . $username . "!</h1>";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="../static/usuario.css">
    <link rel="stylesheet" href="../static/navbar.css">
    <link rel="stylesheet" href="../static/cards.css">
    <script src="../js/listenermusculo.js"></script>
</head>

<body>

    <div class="container mt-5">
        <div class="list-group">
            <a href="#" onclick="seleccionarGrupo('espalda')">Espalda</a>
            <a href="#" onclick="seleccionarGrupo('biceps')">Bíceps</a>
            <a href="#" onclick="seleccionarGrupo('pecho')">Pecho</a>
            <a href="#" onclick="seleccionarGrupo('hombros')">Hombros</a>
            <a href="#" onclick="seleccionarGrupo('triceps')">Tríceps</a>
            <a href="#" onclick="seleccionarGrupo('cuadriceps')">Cuádriceps</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $resultado = json_decode(file_get_contents('php://input'), true);
                $valor_retornado = $resultado['grupoMuscularSeleccionado'];
                echo $valor_retornado;
                // hacer algo con $valor_retornado
             }
             

            // Obtener el valor de seleccionarGrupo al ahcer click
            $grupo = "espalda";
            
            // Conecta con la base de datos
            $conn = mysqli_connect('localhost', 'root', 'root', 'victusfit');

            // Consultar la tabla correspondiente al grupo muscular seleccionado
            if ($grupo == 'espalda') {
                $tabla = 'espalda_gym';
            } elseif ($grupo == 'biceps') {
                $tabla = 'biceps_gym';
            } elseif ($grupo == 'pecho') {
                $tabla = 'pecho_gym';
            } elseif ($grupo == 'hombro'){ // hombros
                $tabla = 'hombro_gym';
            } elseif ($grupo == 'triceps'){ // triceps
                $tabla = 'triceps_gym';
            } elseif  ($grupo == 'cuadriceps'){ // cuadriceps
                $tabla = 'cuadriceps_gym';
            } else {
                // Si el grupo muscular no es válido, mostrar un mensaje de error
                echo 'Grupo muscular no válido.';
                exit;
            }
            

            // Hace una consulta para obtener los datos de la tabla biceps_gym
            $query = "SELECT * FROM $tabla";
            $result = mysqli_query($conn, $query);

            // Itera sobre los resultados y crea una tarjeta para cada uno
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-sm-4">
                    <div class="card">
                        <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                            <p class="card-text"><?php echo $row['descripcion']; ?></p>
                            <p class="card-text"><strong>Dificultad:</strong> <?php echo $row['dificultad']; ?> | <strong>Equipo:</strong> <?php echo $row['equipo']; ?></p>
                            <a href="<?php echo $row['video']; ?>" class="btn" target="_blank">Ver video</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            // Cierra la conexión con la base de datos
            mysqli_close($conn);
            ?>
        </div>
    </div>




    <form action="logout.php" method="post">
        <button type="submit" name="logout">Cerrar sesión</button>
    </form>
</body>

</html>