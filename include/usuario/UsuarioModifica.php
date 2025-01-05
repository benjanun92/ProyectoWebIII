<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$usuario_id = $_GET["USUARIO_ID"] ?? null; // Validar si USUARIO_ID está definido

if (!$usuario_id) {
    die("Error: USUARIO_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asignar los valores del formulario a las variables
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Verificar que los valores se han asignado correctamente
    echo 'OPERATOR recibido: ' . ($_POST['OPERATOR'] ?? 'No recibido') . '<br>';
    echo 'Paterno: ' . ($_POST['paterno'] ?? 'No recibido') . '<br>';
    echo 'Materno: ' . ($_POST['materno'] ?? 'No recibido') . '<br>';
    echo 'Nombre: ' . ($_POST['nombre'] ?? 'No recibido') . '<br>';
    echo 'Cargo: ' . ($_POST['cargo'] ?? 'No recibido') . '<br>';
    echo 'Usuario: ' . ($_POST['user'] ?? 'No recibido') . '<br>';
    echo 'Password: ' . ($_POST['password'] ?? 'No recibido') . '<br>';

    // Ahora se usa $_POST['OPERATOR'] directamente en lugar de $OPERATOR
    $Update = "UPDATE usuario 
               SET paterno = '$paterno', 
                   materno = '$materno', 
                   nombre = '$nombre', 
                   cargo = '$cargo', 
                   user = '$user', 
                   password = '$password' 
               WHERE idusuario = '$usuario_id'";

    $Modifica = mysqli_query($link, $Update);

    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameUsuario.php';
       // parent.$.modal().close();  //descomentar luego de probar
    </script>
    <?php
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
function Validar(f, op) {
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }    
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Modificar Usuario</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario = '".mysqli_real_escape_string($link, $usuario_id)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS DE USUARIO</legend>
            <div class="filaDiv">
                <label for="paterno">Paterno</label>
                <input type="text" name="paterno" id="paterno" autocomplete="off" value="<?php echo $row['paterno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="materno">Materno</label>
                <input type="text" name="materno" id="materno" autocomplete="off" value="<?php echo $row['materno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $row['nombre']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="cargo">Cargo</label>
                <input type="text" name="cargo" id="cargo" autocomplete="off" value="<?php echo $row['cargo']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user" autocomplete="off" value="<?php echo $row['user']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" value="<?php echo $row['password']; ?>"/>
            </div>
        </fieldset>
        <div id="cssboton">
            <a class="a_demo_four" href="javascript:void(0);" onClick="Validar(document.form1,'_REGISTRAR_')">
                <img src="../../resource/imagenes/iconos/save_32.png" style="margin: 0 5px -12px 0; border:none;">Guardar
            </a>    
            <a class="a_demo_four" href="javascript:void(0);" onclick="parent.$.modal().close()">
                <img src="../../resource/imagenes/iconos/close_32.png" style="margin: 0 5px -12px 0; border:none;">Cerrar
            </a>
        </div>
        <input name="OPERATOR" id="OPERATOR" type="hidden" value="" />
        <input name="usuario_id" id="usuario_id" type="hidden" value="<?php echo $usuario_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
