<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $idfactura = $_POST['idfactura'] ?? '';
    $idpedido = $_POST['idpedido'] ?? ''; // Ahora se usará idpedido en lugar de idcliente
    $nombre = $_POST['nombre'] ?? '';
    $apellido_paterno = $_POST['apellido_paterno'] ?? '';
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $total = $_POST['total'] ?? '';
    $fecha = $_POST['fecha'] ?? ''; // Fecha de la factura

    // Verificar si la factura ya existe
    $checkIdQuery = "SELECT * FROM factura WHERE idfactura = '$idfactura'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0 or $idfactura == '0') {
        // Si la factura ya existe, muestra un mensaje emergente
        echo "?>
        <script type="text/javascript">
            alert("El ID de factura ya existe. Por favor, ingresa un ID único.");
            window.history.back(); // Regresa a la página anterior
        </script>
        <?php";
    } else {
        // Si el idfactura no existe, realiza la inserción
        $RegFactura = "INSERT INTO factura(idfactura, idpedido, nombre, apellido_paterno, apellido_materno, total, fecha) 
                       VALUES ('$idfactura', '$idpedido', '$nombre', '$apellido_paterno', '$apellido_materno', '$total', '$fecha')";
        $Res = mysqli_query($link, $RegFactura);

        if ($Res) {
            // Si la inserción es exitosa, redirige
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameFactura.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            // Si hay algún error con la consulta
            echo 'Error al registrar factura: ' . mysqli_error($link);
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
    <h1 class="titulo1">Registro de Factura</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DE LA FACTURA</legend>
            <div class="filaDiv">
                <label for="idfactura">ID Factura</label>
                <input type="text" name="idfactura" id="idfactura" placeholder="" autocomplete="off" />
            </div>

            <!-- Campo de Pedido con menú desplegable -->
            <div class="filaDiv">
                <label for="idpedido">ID Pedido</label>
                <input type="text" name="idpedido" id="idpedido" placeholder="ID Pedido" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Cliente" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="total">Total</label>
                <input type="number" step="0.01" name="total" id="total" placeholder="Total" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" placeholder="Fecha" autocomplete="off" />
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
