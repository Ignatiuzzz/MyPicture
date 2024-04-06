<?php
// Verifica si se ha enviado el parámetro "codigodeldronpedido" y "cant" mediante POST
if(isset($_POST['codigodeldronpedido']) && isset($_POST['cant'])) {
    // Recibe los valores de los parámetros
    $codigodeldronpedido = $_POST['codigodeldronpedido'];
    $cant = $_POST['cant'];

    // Aquí puedes ejecutar la función que guarda el dron en el pedido junto con la cantidad usando $codigodeldronpedido y $cant
    // Por ejemplo, supongamos que tienes una función llamada guardarDronEnPedido en tu clase de conexión
    include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
    guardarDronEnPedido($codigodeldronpedido, $cant);

    // Redirige a otra página después de guardar el dron en el pedido
    header("Location: carrito.php");
    exit(); // Asegura que el script se detenga aquí
}
?>
