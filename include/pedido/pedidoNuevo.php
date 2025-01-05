<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asignar las variables
    $idpedido = $_POST['idpedido'] ?? '';
    $idcliente = $_POST['idcliente'] ?? '';
    $idmesa = $_POST['idmesa'] ?? '';
    $idcamarero = $_POST['idcamarero'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Verificar si el pedido ya existe
    $checkIdQuery = "SELECT * FROM pedido WHERE idpedido = '$idpedido'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        ?>
        <script type="text/javascript">
            alert("El ID de pedido ya existe. Por favor, ingresa un ID único.");
            window.history.back();
        </script>
        <?php
    } else {
        // Insertar el nuevo pedido
        $RegPedido = "INSERT INTO pedido(idpedido, idcliente, idmesa, idcamarero, estado) 
                      VALUES ('$idpedido', '$idcliente', '$idmesa', '$idcamarero', '$estado')";
        $Res = mysqli_query($link, $RegPedido);

        if ($Res) {
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/framePedido.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            echo 'Error al registrar pedido: ' . mysqli_error($link);
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
    <h1 class="titulo1">Registro de Pedido</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DEL PEDIDO</legend>
            <div class="filaDiv">
                <label for="idpedido">ID Pedido</label>
                <input type="text" name="idpedido" id="idpedido" placeholder="" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="idcliente">Cliente</label>
                <select name="idcliente" id="idcliente">
                    <?php
                    $resultClientes = mysqli_query($link, "SELECT idcliente, nombre FROM cliente");
                    while ($cliente = mysqli_fetch_assoc($resultClientes)) {
                        echo "<option value='{$cliente['idcliente']}'>{$cliente['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campo de Mesa con menú desplegable -->
            <div class="filaDiv">
                <label for="idmesa">Mesa</label>
                <select name="idmesa" id="idmesa">
                    <?php
                    $resultMesas = mysqli_query($link, "SELECT idmesa, numero, capacidad, estado FROM mesa");
                    while ($mesa = mysqli_fetch_assoc($resultMesas)) {
                        echo "<option value='{$mesa['idmesa']}'>Mesa {$mesa['numero']} (cap: {$mesa['capacidad']} ) ( {$mesa['estado']})</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campo de Camarero con menú desplegable -->
            <div class="filaDiv">
                <label for="idcamarero">Camarero</label>
                <select name="idcamarero" id="idcamarero">
                    <?php
                    $resultCamareros = mysqli_query($link, "SELECT idcamarero, nombre, apellido_paterno, apellido_materno FROM camarero");
                    while ($camarero = mysqli_fetch_assoc($resultCamareros)) {
                        echo "<option value='{$camarero['idcamarero']}'>{$camarero['nombre']} {$camarero['apellido_paterno']} {$camarero['apellido_materno']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="filaDiv">
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" placeholder="Pendiente, Servido, etc." autocomplete="off" />
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
