<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $iddetalle = $_POST['iddetalle'] ?? '';
    $idpedido = $_POST['idpedido'] ?? '';
    $idmenu = $_POST['idmenu'] ?? '';
    $cantidad = $_POST['cantidad'] ?? 1;

    // Obtener el precio del menú
    $queryPrecio = "SELECT precio FROM menu WHERE idmenu = '$idmenu'";
    $resultPrecio = mysqli_query($link, $queryPrecio);
    $precioMenu = mysqli_fetch_assoc($resultPrecio)['precio'] ?? 0;
    
    // Calcular el precio total
    $precioTotal = $cantidad * $precioMenu;

    // Verificar si el detalle de pedido ya existe
    $checkIdQuery = "SELECT * FROM detallepedido WHERE iddetalle = '$iddetalle'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        ?>
        <script type="text/javascript">
            alert("El ID de detalle ya existe. Por favor, ingresa un ID único.");
            window.history.back();
        </script>
        <?php
    } else {
        $RegDetallePedido = "INSERT INTO detallepedido(iddetalle, idpedido, idmenu, cantidad, precioTotal) 
                             VALUES ('$iddetalle', '$idpedido', '$idmenu', '$cantidad', '$precioTotal')";
        $Res = mysqli_query($link, $RegDetallePedido);

        if ($Res) {
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameDetallePedido.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            echo 'Error al registrar detalle de pedido: ' . mysqli_error($link);
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

function calcularPrecioTotal() {
    var precioMenu = parseFloat(document.querySelector("#idmenu option:checked").dataset.precio) || 0;
    var cantidad = parseInt(document.getElementById("cantidad").value) || 1;
    document.getElementById("precioTotal").value = (precioMenu * cantidad).toFixed(2);
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Registro de Detalle de Pedido</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DEL DETALLE DE PEDIDO</legend>
            <div class="filaDiv">
                <label for="iddetalle">ID Detalle</label>
                <input type="text" name="iddetalle" id="iddetalle" placeholder="" autocomplete="off" />
            </div>

            <div class="filaDiv">
                <label for="idpedido">Pedido</label>
                <select name="idpedido" id="idpedido">
                    <?php
                    $resultPedidos = mysqli_query($link, "
                        SELECT p.idpedido, c.nombre, c.apellido_paterno, c.apellido_materno 
                        FROM pedido p
                        JOIN cliente c ON p.idcliente = c.idcliente
                    ");
                    while ($pedido = mysqli_fetch_assoc($resultPedidos)) {
                        $nombreCliente = $pedido['nombre'] . ' ' . $pedido['apellido_paterno'] . ' ' . $pedido['apellido_materno'];
                        echo "<option value='{$pedido['idpedido']}'>Pedido {$pedido['idpedido']} - {$nombreCliente}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="filaDiv">
                <label for="idmenu">Menú</label>
                <select name="idmenu" id="idmenu" onchange="calcularPrecioTotal()">
                    <?php
                    $resultMenus = mysqli_query($link, "SELECT idmenu, descripcion, precio FROM menu");
                    while ($menu = mysqli_fetch_assoc($resultMenus)) {
                        echo "<option value='{$menu['idmenu']}' data-precio='{$menu['precio']}'>{$menu['descripcion']} - $ {$menu['precio']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="filaDiv">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="" autocomplete="off" onchange="calcularPrecioTotal()" />
            </div>

            <div class="filaDiv">
                <label for="precioTotal">Precio Total</label>
                <input type="number" step="0.01" name="precioTotal" id="precioTotal" placeholder="" readonly />
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
