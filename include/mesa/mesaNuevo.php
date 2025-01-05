<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $idmesa = $_POST['idmesa'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $capacidad = $_POST['capacidad'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Verificar si el idmesa ya existe
    $checkIdQuery = "SELECT * FROM mesa WHERE idmesa = '$idmesa'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Si el idmesa ya existe, muestra un mensaje emergente
        ?>
        <script type="text/javascript">
            alert("El ID Mesa ya existe. Por favor, ingresa un ID único.");
            window.history.back(); // Regresa a la página anterior
        </script>
        <?php
    } else {
        // Si el idmesa no existe, realiza la inserción
        $RegMesa = "INSERT INTO mesa(idmesa, numero, capacidad, estado) 
                    VALUES ('$idmesa', '$numero', '$capacidad', '$estado')";
        $Res = mysqli_query($link, $RegMesa);

        if ($Res) {
            // Si la inserción es exitosa, redirige
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameMesa.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            // Si hay algún error con la consulta
            echo 'Error al registrar mesa: ' . mysqli_error($link);
        }
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
<!--
function Validar(f, op){
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }
}
//-->
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Registro de Mesa</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DE LA MESA</legend>
            <div class="filaDiv">
                <label for="idmesa">ID Mesa</label>
                <input type="text" name="idmesa" id="idmesa" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="capacidad">Capacidad</label>
                <input type="number" name="capacidad" id="capacidad" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" placeholder="" autocomplete="off" />
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
