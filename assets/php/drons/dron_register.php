<?php
include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';
include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
if(isset($_COOKIE['admin'])){
// Obtener los datos del formulario
$conn = conexion();
$cc=ultimoCodticket();
$nombre_empresa = $_POST['nombre_empresa'];
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$year = $_POST['year'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$fecha_registro = $_POST['fecha_registro'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$nombreImagen;
$resultadoSubida = "";


    // Directorio de destino para las imágenes
    $directorioDestino = "C:/xampp/htdocs/pr5/assets/images/";

    // Obtener información sobre la imagen subida
    $nombreArchivo = $_FILES["image"]["name"];
    $tipoArchivo = $_FILES["image"]["type"];
    $tamañoArchivo = $_FILES["image"]["size"];
    $archivoTemp = $_FILES["image"]["tmp_name"];
    
    // Generar un nombre único para la imagen
    $nombreImagen ="product-" . ultimoCodticket() . ".jpg";
    
    // Ruta completa del archivo de destino
    $rutaDestino = $directorioDestino . $nombreImagen;

    // Verificar si el archivo es una imagen
    $esImagen = getimagesize($archivoTemp);
    if ($esImagen !== false) {
        // Mover el archivo a la carpeta de destino con el nombre único
        if (move_uploaded_file($archivoTemp, $rutaDestino)) {
            // Aquí puedes realizar otras acciones si la subida fue exitosa

            // Por ejemplo, puedes guardar el nombre de la imagen en la base de datos
            $nombreImagenGuardado = $nombreImagen;
            // Luego puedes utilizar $nombreImagenGuardado en tu lógica de almacenamiento en la base de datos
            // ...

            // Asignar un mensaje de éxito
        } 
    }

// Escapar las variables para evitar inyección de SQL (IMPORTANTE)
$nombreImagen=pg_escape_string($nombreImagen);
$cc = pg_escape_string($cc);
$nombre_empresa = pg_escape_string($nombre_empresa);
$nombre = pg_escape_string($nombre);
$modelo = pg_escape_string($modelo);
$marca = pg_escape_string($marca);
$year = pg_escape_string($year);
$celular = pg_escape_string($celular);
$email = pg_escape_string($email);
$fecha_registro = pg_escape_string($fecha_registro);
$tipo = pg_escape_string($tipo);
$precio = pg_escape_string($precio);

// Construir la consulta SQL
$query = "INSERT INTO ticket (cc, nombre_banda, nombre_lugar, asiento, fila, evento, celular, email, fecha_registro, tipo_ticket, precio,image,estado) 
          VALUES ('$cc', '$nombre_empresa', '$nombre', '$modelo', '$marca', '$year', '$celular', '$email', '$fecha_registro', '$tipo', '$precio','$nombreImagen','true')";
$c=utlimoRegAdmin();
$serializedAdmin = $_COOKIE['admin'];
            $admin = unserialize($serializedAdmin);
            //require_once '../objects/admin.php'; // Asegúrate de que este archivo también contiene la definición de la clase Admin

$ad=$admin->ca;
// Ejecutar la consulta
$result = pg_query($conn, $query);

$query = "INSERT INTO admin_reg (car, admin_ca, ticket_cc, estado) 
          VALUES ('$c', '$ad', '$cc','true')";

// Ejecutar la consulta
$result = pg_query($conn, $query);

// Puedes realizar otras acciones aquí, como establecer cookies o redirigir a otra página
header("refresh:3;url=../../../index.php");
}else{
    header("refresh:3;url=../Registros/login.html");

}

?>
