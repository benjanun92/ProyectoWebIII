<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programación Web III</title>
    <?php include("Config/conexion.php"); ?>
    <link rel="stylesheet" type="text/css" href="resource/css/styleIndex.css" />
</head>
<body>
    <div id="container" >
        <div id="uno">
            <img src="resource/imagenes/banner/banner1.jpg" width="430" height="250">
        </div>
        <div id="wrapper">
            <div id="login" class="animate form">
                <form method="POST" action="">
                    <img src="resource/imagenes/iconos/User.png" width="25">
                    <input id="username" name="username" required="required" type="text" placeholder="Usuario"/><br>
                    <img src="resource/imagenes/iconos/Lock.png" width="25">
                    <input id="password" name="password" required="required" type="text" placeholder="Contraseña" />
                    <p class="login button"><input type="submit" value="Ingrese"/></p>
                </form>
            </div>
        </div>
        <div id="dos">
            <?php
            echo "INGRESE SU USUARIO Y CONTRASEÑA";
            ?>
        </div>
    </div>

    <?php
    // Comprobación del login
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consulta para verificar el usuario y la contraseña
        $query = "SELECT idusuario, password FROM usuario WHERE user = '$username'";
        $result = mysqli_query($link, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            // Verificamos si el usuario existe
            if ($user) {
                // Comprobamos si la contraseña en texto plano coincide
                if ($password === $user['password']) {
                    // Si la contraseña es correcta, redirigimos al usuario a la página principal
                    header('Location: include/xframe/framePrincipal.php');
                    exit(); // Detener la ejecución del script después de la redirección
                } else {
                    // Contraseña incorrecta
                    echo '<script>alert("Contraseña incorrecta. Por favor, intenta de nuevo.");</script>';
                }
            } else {
                // El usuario no existe
                echo '<script>alert("El usuario no existe. Por favor, revisa el nombre de usuario.");</script>';
            }
        } else {
            // Error en la consulta SQL
            echo '<script>alert("Error al realizar la consulta. Por favor, intenta de nuevo.");</script>';
        }
    }
    ?>

</body>
</html>
