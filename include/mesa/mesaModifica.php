<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$mesa_id = $_GET["MESA_ID"] ?? null; // Validar si MESA_ID está definido

if (!$mesa_id) {
    die("Error: MESA_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    echo 'OPERATOR recibido: ' . ($_POST['OPERATOR'] ?? 'No recibido') . '<br>';
    echo 'Número: ' . ($_POST['numero'] ?? 'No recibido') . '<br>';
    echo 'Capacidad: ' . ($_POST['capacidad'] ?? 'No recibido') . '<br>';
    echo 'Estado: ' . ($_POST['estado'] ?? 'No recibido') . '<br>';

    // Asignar los valores del formulario a las variables
    $numero = $_POST['numero'];
    $capacidad = $_POST['capacidad'];
    $estado = $_POST['estado'];

    // Verificar que los valores se han asignado correctamente
    echo "Número: $numero, Capacidad: $capacidad, Estado: $estado";

    // Ahora se usa $_POST['OPERATOR'] directamente en lugar de $OPERATOR
    $Update = "UPDATE mesa 
               SET numero = '$numero', 
                   capacidad = '$capacidad', 
                   estado = '$estado' 
               WHERE idmesa = '$mesa_id'";

    $Modifica = mysqli_query($link, $Update);
    
    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameMesa.php';
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
        // alert("Valor de OPERATOR antes de enviar el formulario: " + document.getElementById("OPERATOR").value);  // Muestra el valor de OPERATOR 
        f.submit();
    }    
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Modificar Mesa</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM mesa WHERE idmesa = '".mysqli_real_escape_string($link, $mesa_id)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS DE LA MESA</legend>
            <div class="filaDiv">
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" autocomplete="off" value="<?php echo $row['numero']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="capacidad">Capacidad</label>
                <input type="number" name="capacidad" id="capacidad" autocomplete="off" value="<?php echo $row['capacidad']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" autocomplete="off" value="<?php echo $row['estado']; ?>"/>
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
        <input name="mesa_id" id="mesa_id" type="hidden" value="<?php echo $mesa_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
