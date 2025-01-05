<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php

include("../../Config/conexion.php");

$camarero_id = $_GET["CAMARERO_ID"] ?? null; // Validar si CAMARERO_ID está definido

if (!$camarero_id) {
    die("Error: CAMARERO_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asignar los valores del formulario a las variables
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $telefono = $_POST['telefono'];
    $salario = $_POST['salario'];
   
    // Verificar que los valores se han asignado correctamente
    echo "Nombre: $nombre, Apellido Paterno: $apellido_paterno, Apellido Materno: $apellido_materno, Teléfono: $telefono, Salario: $salario";
   
    // Actualizar los datos en la tabla `camarero`
    $Update = "UPDATE camarero 
               SET nombre = '$nombre', 
                   apellido_paterno = '$apellido_paterno', 
                   apellido_materno = '$apellido_materno', 
                   telefono = '$telefono', 
                   salario = '$salario' 
               WHERE idcamarero = '$camarero_id'";

    $Modifica = mysqli_query($link, $Update);
    
    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameCamarero.php';
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
    <h1 class="titulo1">Modificar Camarero</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM camarero WHERE idcamarero = '".mysqli_real_escape_string($link, $camarero_id)."'");
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
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" autocomplete="off" value="<?php echo $row['telefono']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="salario">Salario</label>
                <input type="text" name="salario" id="salario" autocomplete="off" value="<?php echo $row['salario']; ?>"/>
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
        <input name="camarero_id" id="camarero_id" type="hidden" value="<?php echo $camarero_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
