<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$cliente_id = $_GET["CLIENTE_ID"] ?? null; // Validar si CLIENTE_ID está definido

if (!$cliente_id) {
    die("Error: CLIENTE_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    echo 'OPERATOR recibido: ' . ($_POST['OPERATOR'] ?? 'No recibido') . '<br>';
    echo 'Nombre: ' . ($_POST['nombre'] ?? 'No recibido') . '<br>';
    echo 'Apellido Paterno: ' . ($_POST['apellido_paterno'] ?? 'No recibido') . '<br>';
    echo 'Apellido Materno: ' . ($_POST['apellido_materno'] ?? 'No recibido') . '<br>';
    echo 'Fecha de Nacimiento: ' . ($_POST['fecha_nacimiento'] ?? 'No recibido') . '<br>';
    echo 'Género: ' . ($_POST['genero'] ?? 'No recibido') . '<br>';

    // Asignar los valores del formulario a las variables
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];

    // Verificar que los valores se han asignado correctamente
    echo "Nombre: $nombre, Apellido Paterno: $apellido_paterno, Apellido Materno: $apellido_materno, Fecha de Nacimiento: $fecha_nacimiento, Género: $genero";

    // Ahora se usa $_POST['OPERATOR'] directamente en lugar de $OPERATOR
    $Update = "UPDATE cliente 
               SET nombre = '$nombre', 
                   apellido_paterno = '$apellido_paterno', 
                   apellido_materno = '$apellido_materno', 
                   fecha_nacimiento = '$fecha_nacimiento', 
                   genero = '$genero' 
               WHERE idcliente = '$cliente_id'";

    $Modifica = mysqli_query($link, $Update);

    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameCliente.php';
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
    <h1 class="titulo1">Modificar Cliente</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM cliente WHERE idcliente = '".mysqli_real_escape_string($link, $cliente_id)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS PERSONALES</legend>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $row['nombre']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" autocomplete="off" value="<?php echo $row['apellido_paterno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" autocomplete="off" value="<?php echo $row['apellido_materno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="genero">Género</label>
                <input type="text" name="genero" id="genero" autocomplete="off" value="<?php echo $row['genero']; ?>"/>
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
        <input name="cliente_id" id="cliente_id" type="hidden" value="<?php echo $cliente_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
