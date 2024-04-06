<?php
  include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';

// Obtener los datos del formulario
$conn = conexion();
$ca = ultimoCodAdmin();
$nombre = $_POST['nombre'];
$ci = $_POST['ci'];
$password = $_POST['password'];
$fecha_registro = $_POST['fecha_registro'];
$email = $_POST['email'];

// Escapar las variables para evitar inyección de SQL (IMPORTANTE)
$nombre = pg_escape_string($nombre);
$ci = pg_escape_string($ci);
$password = pg_escape_string($password);
$fecha_registro = pg_escape_string($fecha_registro);
$email = pg_escape_string($email);

// Construir la consulta SQL
$query = "INSERT INTO Admin (ca, nombre, ci, password, fecha_registro, email,estado) VALUES ('$ca', '$nombre', '$ci', '$password', '$fecha_registro', '$email','true')";

// Ejecutar la consulta
$result = pg_query($conn, $query);

// Verificar si la consulta fue exitosa
// Para establecer una cookie
// Serializar la instancia de la clase Admin y guardarla en la cookie

header("refresh:3;url=../view/admin_view.php");
?>
