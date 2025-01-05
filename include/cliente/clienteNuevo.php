<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    $idcli = $_POST['idcli'] ?? '';
    $txtnom = $_POST['txtnom'] ?? '';
    $txtpat = $_POST['txtpat'] ?? '';
    $txtmat = $_POST['txtmat'] ?? '';
    $txtnac = $_POST['txtnac'] ?? '';
    $txtgen = $_POST['txtgen'] ?? '';
    $txttel = $_POST['txttel'] ?? '';
    $txtdir = $_POST['txtdir'] ?? '';

    // Verificar si el idcliente ya existe
    $checkIdQuery = "SELECT * FROM cliente WHERE idcliente = '$idcli'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        ?>
        <script type="text/javascript">
            alert("El ID Cliente ya existe. Por favor, ingresa un ID único.");
            window.history.back();
        </script>
        <?php
    } else {
        // Inserción del cliente con los nuevos campos
        $RegCliente = "INSERT INTO cliente(idcliente, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, genero, telefono, direccion) 
                       VALUES ('$idcli', '$txtnom', '$txtpat', '$txtmat', '$txtnac', '$txtgen', '$txttel', '$txtdir')";
        $Res = mysqli_query($link, $RegCliente);

        if ($Res) {
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameCliente.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            echo 'Error al registrar cliente: ' . mysqli_error($link);
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
    <h1 class="titulo1">Registro de cliente</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS PERSONALES</legend>
            <div class="filaDiv">
                <label for="idcliente">ID Cliente</label>
                <input type="text" name="idcli" id="idcli" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="txtnom" id="txtnom" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="txtpat" id="txtpat" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="txtmat" id="txtmat" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="txtnac" id="txtnac" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="genero">Género</label>
                <input type="text" name="txtgen" id="txtgen" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="telefono">Teléfono</label>
                <input type="text" name="txttel" id="txttel" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="direccion">Dirección</label>
                <input type="text" name="txtdir" id="txtdir" autocomplete="off" />
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
