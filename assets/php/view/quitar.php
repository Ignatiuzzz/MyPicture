<?php
// Verifica si se ha enviado el parámetro "codigodeldronpedido" mediante POST
if(isset($_POST['codigodeldronpedido'])) {
    // Recibe el valor del parámetro
    $codigodeldronpedido = $_POST['codigodeldronpedido'];

    // Aquí puedes ejecutar la función que quita el dron del pedido usando $codigodeldronpedido
    // Por ejemplo, supongamos que tienes una función llamada quitarDronDelPedido en tu clase de conexión
    include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
    quitarDronDelPedido($codigodeldronpedido);

    // Redirige a otra página después de quitar el dron del pedido
    header("Location: carrito.php");
    exit(); // Asegura que el script se detenga aquí
}
?>
