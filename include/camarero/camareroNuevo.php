<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $idcam = $_POST['idcam'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellidoPaterno = $_POST['apellidoPaterno'] ?? '';
    $apellidoMaterno = $_POST['apellidoMaterno'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $salario = $_POST['salario'] ?? '';

    // Verificar si el idcamarero ya existe
    $checkIdQuery = "SELECT * FROM camarero WHERE idcamarero = '$idcam'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Si el idcamarero ya existe, muestra un mensaje emergente
        ?>
        <script type="text/javascript">
            alert("El ID Camarero ya existe. Por favor, ingresa un ID único.");
            window.history.back(); // Regresa a la página anterior
        </script>
        <?php
    } else {
        // Si el idcamarero no existe, realiza la inserción
        $RegCamarero = "INSERT INTO camarero(idcamarero, nombre, apellido_paterno, apellido_materno, telefono, salario) 
                        VALUES ('$idcam', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$telefono', '$salario')";
        $Res = mysqli_query($link, $RegCamarero);

        if ($Res) {
            // Si la inserción es exitosa, redirige
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameCamarero.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            // Si hay algún error con la consulta
            echo 'Error al registrar camarero: ' . mysqli_error($link);
        }
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
function Validar(f, op){
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Registro de Camarero</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS PERSONALES</legend>
            <div class="filaDiv">
                <label for="idcamarero">ID Camarero</label>
                <input type="text" name="idcam" id="idcam" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="apellidoPaterno">Apellido Paterno</label>
                <input type="text" name="apellidoPaterno" id="apellidoPaterno" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="apellidoMaterno">Apellido Materno</label>
                <input type="text" name="apellidoMaterno" id="apellidoMaterno" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="salario">Salario</label>
                <input type="text" name="salario" id="salario" autocomplete="off" />
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
    </form>
</div>
</body>
</html>
