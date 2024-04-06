<?php
  include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';

include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';
// Obtener los datos del formulario
$conn = conexion();
$ca;
$nombre ;
$ci;
$password = $_POST['password'];
$fecha_registro ;
$email = $_POST['email'];


$password = pg_escape_string($password);
$email = pg_escape_string($email);

// Construir la consulta SQL
$query = "select * from Admin where email= '$email' and estado='true' and password='$password'";

// Ejecutar la consulta
$result = pg_query($conn, $query);
if ($row = pg_fetch_assoc($result)) {
    // Array para almacenar instancias de la clase Cars
 
     
        $admin = new admin(
            $row['ca'],
            $row['nombre'],
            $row['ci'],
            $row['password'],
            $row['fecha_registro'],
            $row['email']
        );
        
        $serializedAdmin = serialize($admin);
        setcookie('admin', $serializedAdmin, time() + 3600, '/'); // Caduca en 1 hora
        
    header("refresh:3;url=../../../index.php");

    }
    $query = "select * from Customer where email= '$email'  and estado='true' and password='$password'";

    // Ejecutar la consulta
    $result = pg_query($conn, $query);
    if ($row = pg_fetch_assoc($result)) {
        // Array para almacenar instancias de la clase Cars
       
    
         
            $customer = new customer(
                $row['ccu'],
                $row['nombre'],
                $row['email'],
                $row['fecha_registro'],
                $row['password']
            );
            
            $serializedCustomer = serialize($customer);
            setcookie('customer', $serializedCustomer, time() + 3600, '/'); // Caduca en 1 hora
            
        header("refresh:3;url=../../../index.php");
    
        }
    // Ahora $carsArray contiene instancias de la clase Cars con los datos de la tabla



?>
