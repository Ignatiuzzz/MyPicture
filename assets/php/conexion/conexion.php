<?php
include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';

// Check if the conexion function is not already defined
if (!function_exists('conexion')) {
    function conexion(){
        $host = "localhost";
        $dbname = "tickets";
        $user = "postgres";
        $password = "1234";

        // Creamos la conexión
        return $connection = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    }
}

// Check if the ultimoCoddron function is not already defined
if (!function_exists('ultimoCodticket')) {
    function ultimoCodticket(){
        $conexion = conexion();
        $ultimodron = 0;

        $query = "SELECT cc FROM ticket ORDER BY cc DESC LIMIT 1";
        $result = pg_query($conexion, $query);

        if ($row = pg_fetch_assoc($result)) {
            $ultimodron = (int)$row['cc'];
        }
        $ultimodron++;
        
        return $ultimodron;
    }
}


if (!function_exists('utlimoRegAdmin')) {
    function utlimoRegAdmin(){
        $conexion = conexion();
        $ultimodron = 0;

        $query = "SELECT car FROM admin_reg ORDER BY car DESC LIMIT 1";
        $result = pg_query($conexion, $query);

        if ($row = pg_fetch_assoc($result)) {
            $ultimodron = (int)$row['car'];
        }
        $ultimodron++;
        
        return $ultimodron;
    }
}

if (!function_exists('ultimoCodCustomer')) {
function ultimoCodCustomer(){
    $conexion=conexion();
    $ultimoCustomer = 0;

    $query = "SELECT ccu FROM customer ORDER BY ccu DESC LIMIT 1";
    $result = pg_query($conexion, $query);

    if ($row = pg_fetch_assoc($result)) {
        $ultimoCustomer = (int)$row['ccu'];
    }
$ultimoCustomer++;
//pg_close($conexion);

    return $ultimoCustomer;


}}

if (!function_exists('guardarpedido')) {
    function guardarpedido($ccu,$total,$arrautos,$cant,){
        $conn=conexion();


        $c=ultimoCodpedido();
        $query = "INSERT INTO pedido (cur, total, customer_ccu,aprobado, estado) 
        VALUES ('$c', '$total', '$ccu','false','true')";

// Ejecutar la consulta
$result = pg_query($conn, $query);

$arr=registedtickets();
$c1=ultimoCodCotCus();
$d=0;
for($i=0;$i<count($arrautos);$i++){
    $d=$arrautos[$i];
   $aux=$arr[$d]->getCc();
    $query = "INSERT INTO ped_car (cci, pedido_cur, ticket_cc,cant, estado) 
    VALUES ('$c1', '$c', '$aux','$cant[$i]','true')";
$c1++;
// Ejecutar la consulta
    $result = pg_query($conn, $query);
}


// Puedes realizar otras acciones aquí, como establecer cookies o redirigir a otra página
    
    
    }}

    if (!function_exists('dataCod')) {
        function dataCod($ped) {
            $conexion = conexion();
            $tickets_cc = array();
    
            $query = "select a.ticket_cc from ped_car a  where  a.estado=true and a.pedido_cur='".$ped."'";
            $result = pg_query($conexion, $query);
           
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    $tickets_cc[]=(int) $row['ticket_cc'];
                    
                }
            }
    
           // pg_close($conexion);
    
            return $tickets_cc;
        }
    }
    if (!function_exists('pedidos')) {
        function pedidos($ccu) {
            $conexion = conexion();
            $tickets_cc = array();
    
            $query = "select * from pedido where customer_ccu='". $ccu ."'and estado='true'";
            $result = pg_query($conexion, $query);
           
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    $tickets_cc[]=(int) $row['cur'];
                   
                }
            }
    
           // pg_close($conexion);

            return $tickets_cc;
        }
    }
    if (!function_exists('cantidaddeldronpedido')) {
        function cantidaddeldronpedido($ped) {
            $conexion = conexion();
            $cantidad=0; // Inicializamos el array
        
            $query = "select a.cant from ped_car a where a.estado=true and a.cci='". $ped ."'";
            $result = pg_query($conexion, $query);
        
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    if((int)$row['cant'] != 0){
                        // Agregamos el valor al array
                        $cantidad = (int)$row['cant'];
                    }
                }
            }
            
      
            
            return $cantidad;
        }
        
    }
    if (!function_exists('codigosClientes')) {
        function codigosClientes() {
            $conexion = conexion();
            $cantidad=array(); // Inicializamos el array
        
            $query = "select a.ccu from customer a where a.estado=true ";
            $result = pg_query($conexion, $query);
        
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    if((int)$row['ccu'] != 0){
                        // Agregamos el valor al array
                        $cantidad[] = (int)$row['ccu'];
                    }
                }
            }
            
      
            
            return $cantidad;
        }
        
    }
    if (!function_exists('guardarDronEnPedido')) {
        function guardarDronEnPedido($codigodeldronpedido,$cant) {
            
            $conexion = conexion(); // Llama a tu función de conexión para obtener la conexión a la base de datos

            // Primero, recuperamos la cantidad actual del dron en el pedido
            $query_actualizar = "UPDATE ped_car SET cant = '$cant' WHERE cci = '$codigodeldronpedido'";
            $result = pg_query($conexion, $query_actualizar); // Ejecuta la consulta
        
        }
        
    }
    if (!function_exists('quitarDronDelPedido')) {
        function quitarDronDelPedido($codigodeldronpedido) {
            $conexion = conexion(); // Llama a tu función de conexión para obtener la conexión a la base de datos

            // Primero, recuperamos la cantidad actual del dron en el pedido
            $query_actualizar = "UPDATE ped_car SET estado = 'false' WHERE cci = '$codigodeldronpedido'";
            $result = pg_query($conexion, $query_actualizar); // Ejecuta la consulta
        
        }
        
    }
    if (!function_exists('contadorCust')) {
        function contadorCust($ped) {
            $conexion = conexion();
            $cantidad = array(); // Inicializamos el array
        
            $query = "select a.cant from ped_car a where a.estado=true and a.pedido_cur='". $ped ."'";
            $result = pg_query($conexion, $query);
        
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    if((int)$row['cant'] != 0){
                        // Agregamos el valor al array
                        $cantidad[] = (int)$row['cant'];
                    }
                }
            }
            
      
            
            return $cantidad;
        }
        
    }
    if (!function_exists('numeroDelPedido')) {
        function numeroDelPedido($ped) {
            $conexion = conexion();
            $cantidad = array(); // Inicializamos el array
        
            $query = "select a.cci from ped_car a where a.estado=true and a.pedido_cur='". $ped ."'";
            $result = pg_query($conexion, $query);
        
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    if((int)$row['cci'] != 0){
                        // Agregamos el valor al array
                        $cantidad[] = (int)$row['cci'];
                        
                    }
                }
            }
            
      
            
            return $cantidad;
        }
        
    }
    if (!function_exists('ultimoCodpedido')) {
        function ultimoCodpedido(){
            $conexion=conexion();
            $ultimoAdmin = 0;
        
            $query = "SELECT cur FROM pedido ORDER BY cur DESC LIMIT 1";
            $result = pg_query($conexion, $query);
        
            if ($row = pg_fetch_assoc($result)) {
                $ultimoAdmin = (int)$row['cur'];
            }
        $ultimoAdmin++;
        //pg_close($conexion);
        
            return $ultimoAdmin;
        
        
        }}
        if (!function_exists('ultimoCodCotCus')) {
            function ultimoCodCotCus(){
                $conexion=conexion();
                $ultimoAdmin = 0;
            
                $query = "SELECT cci FROM ped_car ORDER BY cci DESC LIMIT 1";
                $result = pg_query($conexion, $query);
            
                if ($row = pg_fetch_assoc($result)) {
                    $ultimoAdmin = (int)$row['cci'];
                }
            $ultimoAdmin++;
            //pg_close($conexion);
            
                return $ultimoAdmin;
            
            
            }}
if (!function_exists('ultimoCodAdmin')) {
function ultimoCodAdmin(){
    $conexion=conexion();
    $ultimoAdmin = 0;

    $query = "SELECT ca FROM admin ORDER BY ca DESC LIMIT 1";
    $result = pg_query($conexion, $query);

    if ($row = pg_fetch_assoc($result)) {
        $ultimoAdmin = (int)$row['ca'];
    }
$ultimoAdmin++;
//pg_close($conexion);

    return $ultimoAdmin;


}}
if (!function_exists('matrixdronToAdmin')) {
    
    


    function matrixdronToAdmin($cat) {
        if(isset($_COOKIE['admin'])){
            $serializedAdmin = $_COOKIE['admin'];
                $admin = unserialize($serializedAdmin);
    
    $ad=$admin->ca;
        $matrix = array(); // Initialize $matrix as an array
        $c = 0;
        for ($i = 0; $i < count($cat); $i++) {
            $conn = conexion();
    
            // Corrected concatenation in the SQL query
            $query =  "select a.cc,a.nombre_banda, a.nombre_lugar, a.asiento, a.fila, a.evento, a.celular,a.email,a.fecha_registro, a.tipo_ticket, a.precio, a.image from  ticket a,admin_reg b where a.estado=true and a.cc=b.ticket_cc and b.admin_ca='$ad' AND a.tipo_ticket = '" . $cat[$i] . "'";
            $result = pg_query($conn, $query);
            // Verifidron si hay resultados
            if ($result) {
                // Array para almacenar instancias de la clase dron
                $ticketsArray = array();
                // Recorrer los resultados y crear instancias de la clase dron
                while ($row = pg_fetch_assoc($result)) {
                    $dronInstance = new dron(
                        $row['cc'],
                        $row['nombre_banda'],
                        $row['nombre_lugar'],
                        $row['asiento'],
                        $row['fila'],
                        $row['evento'],
                        $row['celular'],
                        $row['email'],
                        $row['fecha_registro'],
                        $row['tipo_ticket'],
                        $row['precio'],
                        $row['image']
                    );
    
                    // Agregar la instancia al array
                    $ticketsArray[] = $dronInstance;
                }
                // Ahora $ticketsArray contiene instancias de la clase dron con los datos de la tabla
            }
            // Cerrar la conexión a la base de datos
          //  pg_close($conn);
    
            // Initialize $matrix[$c] as an array before using it
            $matrix[$c] = $ticketsArray;
    
            $c++;
        }
    
        return $matrix;
    }
    }
}
if (!function_exists('matrixdron')) {
    function matrixdron($cat) {
        $matrix = array(); // Initialize $matrix as an array
        $c = 0;
        // Verifidron si $cat es un array y tiene elementos
        if (is_array($cat) && count($cat) > 0) {
            for ($i = 0; $i < count($cat); $i++) {
                $conn = conexion();
    
                // Corrected concatenation in the SQL query
                $query = "SELECT * FROM ticket WHERE estado = true AND tipo_ticket = '" . $cat[$i] . "'";
                $result = pg_query($conn, $query);
                // Verifidron si hay resultados
                if ($result) {
                    // Array para almacenar instancias de la clase dron
                    $ticketsArray = array();
                    // Recorrer los resultados y crear instancias de la clase dron
                    while ($row = pg_fetch_assoc($result)) {
                        $dronInstance = new dron(
                            $row['cc'],
                            $row['nombre_banda'],
                            $row['nombre_lugar'],
                            $row['asiento'],
                            $row['fila'],
                            $row['evento'],
                            $row['celular'],
                            $row['email'],
                            $row['fecha_registro'],
                            $row['tipo_ticket'],
                            $row['precio'],
                            $row['image']
                        );
    
                        // Agregar la instancia al array
                        $ticketsArray[] = $dronInstance;
                    }
                    // Ahora $ticketsArray contiene instancias de la clase dron con los datos de la tabla
                }
                // Cerrar la conexión a la base de datos
                //  pg_close($conn);
    
                // Initialize $matrix[$c] as an array before using it
                $matrix[$c] = $ticketsArray;
    
                $c++;
            }
        }
    
        return $matrix;
    }
}
if (!function_exists('detallesdelDronporPedido')) {
    
    

    function detallesdelDronporPedido($coddrong){
        $conn = conexion();
        
        // Consulta para obtener los datos de la tabla "tickets"
        $query = "SELECT a.cc,a.nombre_banda,a.nombre_lugar,a.fila,a.asiento,a.evento,a.celular,a.email,a.fecha_registro,a.tipo_ticket,a.precio,a.image FROM ticket a,ped_car b WHERE a.estado = true and b.estado=true and a.cc=b.ticket_cc and b.cci='".$coddrong."'";
        $result = pg_query($conn, $query);
        $tickets;
    
        // Verifidron si hay resultados
        if ($result) {
            // Array para almacenar instancias de la clase dron
    
            // Recorrer los resultados y crear instancias de la clase dron
            while ($row = pg_fetch_assoc($result)) {
                
                $dronInstance = new dron(
                   $row['cc'],
                        $row['nombre_banda'],
                        $row['nombre_lugar'],
                        $row['asiento'],
                        $row['fila'],
                        $row['evento'],
                        $row['celular'],
                        $row['email'],
                        $row['fecha_registro'],
                        $row['tipo_ticket'],
                        $row['precio'],
                        $row['image']
                );
    
                // Agregar la instancia al array
                $tickets= $dronInstance;
            }
            // Ahora $ticketsArray contiene instancias de la clase dron con los datos de la tabla
        }
        // Cerrar la conexión a la base de datos
        //pg_close($conn);
    
        return $tickets;
    }}
if (!function_exists('registedtickets')) {
    
    

function registedtickets(){
    $conn = conexion();
    
    // Consulta para obtener los datos de la tabla "tickets"
    $query = "SELECT * FROM ticket WHERE estado = true";
    $result = pg_query($conn, $query);
    $ticketsArray = array();

    // Verifidron si hay resultados
    if ($result) {
        // Array para almacenar instancias de la clase dron

        // Recorrer los resultados y crear instancias de la clase dron
        while ($row = pg_fetch_assoc($result)) {
            
            $dronInstance = new dron(
                $row['cc'],
                $row['nombre_banda'],
                $row['nombre_lugar'],
                $row['asiento'],
                $row['fila'],
                $row['evento'],
                $row['celular'],
                $row['email'],
                $row['fecha_registro'],
                $row['tipo_ticket'],
                $row['precio'],
                $row['image']
            );

            // Agregar la instancia al array
            $ticketsArray[] = $dronInstance;
        }
        // Ahora $ticketsArray contiene instancias de la clase dron con los datos de la tabla
    }
    // Cerrar la conexión a la base de datos
    //pg_close($conn);

    return $ticketsArray;
}}
if (!function_exists('registedticketsAdmin')) {
    function registedticketsAdmin() {
        if (isset($_COOKIE['admin'])) {
            $serializedAdmin = $_COOKIE['admin'];
            $admin = unserialize($serializedAdmin);
            $ticketsArray = array();
            $ad = $admin->ca;
            $conn = conexion();
            
            // Consulta para obtener los datos de la tabla "tickets"
            $query = "SELECT cc, nombre_banda, nombre_lugar, asiento, fila, evento, celular, email, fecha_registro, tipo_ticket, precio, image FROM ticket a, admin_reg b WHERE a.estado = true AND a.cc = b.ticket_cc AND b.admin_ca = '$ad'";
            $result = pg_query($conn, $query);
            
            // Verifidron si la consulta fue exitosa
            if ($result !== false) {
                // Iterar sobre los resultados de la consulta
                while ($row = pg_fetch_assoc($result)) {
                    // Crear un objeto dron con los datos de la fila y agregarlo al array
                    $dron = new dron($row['cc'], $row['nombre_banda'], $row['nombre_lugar'], $row['asiento'], $row['fila'], $row['evento'], $row['celular'], $row['email'], $row['fecha_registro'], $row['tipo_ticket'], $row['precio'], $row['image']);
                    $ticketsArray[] = $dron;
                }
            }
            
            // Cerrar la conexión a la base de datos
            // pg_close($conn);
            
            return $ticketsArray;
        }
        return null;
    }
}

    if (!function_exists('countdron')) {
        function countdron() {
            $conexion = conexion(); // Suponiendo que `conexion()` es una función que retorna la conexión a la base de datos
            $count = 0;
    
            $query = "SELECT COUNT(*) AS count FROM ticket";
            $result = pg_query($conexion, $query);
    
            if ($row = pg_fetch_assoc($result)) {
                $count = (int)$row['count'];
            }
            // No es necesario incrementar $count
            //pg_close($conexion);
    
            return $count;
        }
    }
?>