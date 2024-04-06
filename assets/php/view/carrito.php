<?php
// Evitando salida antes de los encabezados HTTP
ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="preload" href="../../images/banner1.png" as="image">
</head>

<body id="top">
  <header class="header" data-header>
    <div class="container">
      <div class="overlay" data-overlay></div>
      <a href="#" class="logo">
        <img src="../../images/logo1.png" width="100" height="105">
      </a>
      <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      <nav class="navbar" data-navbar>
        <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
          <ion-icon name="close-outline"></ion-icon>
        </button>
        <a href="#" class="logo">
          <img src="../../images/logo1.png" width="110" height="80">
        </a>
        <ul class="navbar-list">
          <li class="navbar-item">
            <a href="../../../index.php" class="navbar-link">Inicio</a>
          </li>
          <li class="navbar-item">
            <a onclick="window.location.href='productos.php'" class="navbar-link">Productos</a>
          </li>
          <li class="navbar-item">
            <button class="navbar-link " id="productos-link" value="Pedidos" type="submit" name="carrito">Pedidos</button>
          </li>
          <li class="navbar-item">
            <a href="contactanos.html" class="navbar-link">Contactanos</a>
          </li>
          <li class="navbar-item">
            <a href="nosotros.html" class="navbar-link">Nosotros</a>
          </li>
          <li class="navbar-item">
            <a href="#" class="navbar-link">Blog</a>
          </li>
        </ul>
        <ul class="nav-action-list">
          <li>
            <button class="nav-action-btn">
              <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
              <span class="nav-action-text">Buscador</span>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="section product">
      <div class="container-contact-us">
        <div class="contact-container">
          <h1 class="h1-contact">Pedido Actual: </h1>
          <?php
          session_start(); // Inicia la sesión
          include '../extras.php';
          include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';

          $contador = array();
          $data = array();
          $dronsArray = Array();
          $dronsArray = registedtickets();
          $codCot = Array();
          $cantidades = Array();
          if (isset($_COOKIE['customer'])||isset($_COOKIE['admin'])) {
          // Verificamos si hay datos en $_POST o si se ha hecho clic en el botón del formulario
          if (!empty($_POST) || isset($_POST['carrito'])) {
            $cant = countdron();
            // Verificamos si se ha enviado el formulario para guardar la cotización
            for ($i = 0; $i < $cant; $i++) {
              $contador[$i] = $_POST['contador' . $i];
              $data[$i] = $_POST['data' . $i];
            }
            // Verificamos si el campo contador1 está presente en la solicitud POST
            $tsindescuento = 0;
            echo '<div style="display: flex; flex-wrap: wrap;">'; // Inicia el contenedor flex y permite que los elementos se envuelvan
            for ($i = 0; $i < $cant; $i++) {
              if ($contador[$i] > 0) {
                $codCot[] = $i;
                $cantidades[] = $contador[$i];
                $auto = $dronsArray[$i];
                $texto = $auto->nombre;
                $total = $contador[$i] * quitar($data[$i]);
                // Agregamos más detalles del auto
                $details = "<p>nombre_empresa: {$auto->nombre_empresa}</p>" .
                  "<p>Modelo: {$auto->modelo}</p>" .
                  "<p>Marca: {$auto->marca}</p>" .
                  "<p>Año: {$auto->year}</p>" .
                  "<p>Tipo: {$auto->tipo}</p>" .
                  "<p>Cantidad: {$contador[$i]}</p>" .
                  "<p>Precio: {$data[$i]}</p>" .
                  "<p>Precio Total: $total Sus</p>";
                // Establecemos un ancho fijo para cada elemento
                echo '<div style="width: 50%; box-sizing: border-box; padding: 10px;">';
                echo '<img src="../../images/' .$auto->image . '" width="312" height="350" loading="lazy" class="image-contain">';
                echo "<h2>$texto</h2>";
                echo $details;
                echo '</div>';
                $tsindescuento = $tsindescuento + $total;
              }
            }
            echo '</div>'; // Finaliza el contenedor flex
            if ($tsindescuento > 0) {
              echo("<h2>El total es de: $tsindescuento Sus</h2>");
              // Almacenamos datos en la sesión para su uso posterior
              $serializedt = serialize($tsindescuento);
              setcookie('tsindescuento', $serializedt, time() + 360000, '/'); // Caduca en 1 hora
              $serializedcodCot = serialize($codCot);
              setcookie('codCot', $serializedcodCot, time() + 360000, '/'); // Caduca en 1 hora
              $serializedcantidades = serialize($cantidades);
              setcookie('cantidades', $serializedcantidades, time() + 3600000, '/'); // Caduca en 1 hora
              // Agregamos el botón para guardar la cotización
              echo '<form method="POST" action="../guaCot.php">';
              echo '<button class="nav-action-btn-admin" type="submit" name="guardar_cotizacion" id="guardar_cotizacion">Guardar Pedido</button>';
              echo '</form>';
            }
          }else{
            echo("<h2>No se esta procesando actualmente ningun pedido :)</h2>");
          
          }
        }else{
          header("Location: ../Registros/login.html");

        }
          ?>
        </div>
      </div>
    </section>
    <section class="section product">
      <div class="container-contact-us">

        <div class="contact-container">
    
            <h1 class="h1-contact">Pedidos del cliente:</h1>
    
            <?php

include_once 'C:\xampp\htdocs\pr5\assets\php\extras.php';
include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';

$contador = Array();
$data = Array();
$dronsArray = Array();
$dronsArray = registedtickets();
$codCot = Array();
$cantidades = Array();

if (isset($_COOKIE['customer'])) {
    $serializedCustomer = $_COOKIE['customer'];
    $customer = unserialize($serializedCustomer);
    $ccu = $customer->ccu;
    $ped = pedidos($ccu);
    for ($d = 0; $d < count($ped); $d++) {
        echo ' <h1 class="h1-contact">Pedido ' . $ped[$d] . '</h1>';
        $numPedido = numeroDelPedido($ped[$d]);
        $contador = contadorCust($ped[$d]);
        $data =  dataCod($ped[$d]);

        $tsindescuento = 0;
        $codf = 0;

        if (count($contador) > 0) {

            // Inicia un contenedor flex que permitirá envolver los elementos
            echo '<div style="display: flex; flex-wrap: wrap;">';

            for ($i = 0; $i < count($contador); $i++) {
                $codf = $data[$i];
                $auto = numeroDron($dronsArray, $codf);
                $texto = $auto->nombre;
                $total = $contador[$i] * $auto->precio;

                // Agregar más detalles del auto
                $details = "<p>nombre_empresa: {$auto->nombre_empresa}</p>" .
                "<p>codigo del dron pedido: {$numPedido[$i]}</p>" .
                    "<p>Modelo: {$auto->modelo}</p>" .
                    "<p>Marca: {$auto->marca}</p>" .
                    "<p>Año: {$auto->year}</p>" .
                    "<p>Tipo: {$auto->tipo}</p>" .
                    "<p>Cantidad: {$contador[$i]}</p>" .
                    "<p>Precio: {$auto->precio}</p>" .
                    "<p>Precio Total: $total Sus</p>";

                // Establecer un ancho fijo para cada elemento
                echo '<div style="width: 50%; box-sizing: border-box; padding: 10px;">';
                echo '<img src="../../images/'.$auto->image.'" width="312" height="350" loading="lazy" class="image-contain">';
                echo "<h2>$texto</h2>";
                echo $details;

                // Agregar el botón "Editar" que redirecciona a la página PHP con el código del dron pedido como parámetro
                echo '<a href="editar.php?codigodeldronpedido=' . $numPedido[$i] . '">Editar</a>';

                echo '</div>';

                $tsindescuento = $tsindescuento + $total;

                // Si el índice es impar, cierra el contenedor flex y abre uno nuevo
                if ($i % 2 != 0) {
                    echo '</div>'; // Cierra el contenedor flex actual
                    echo '<div style="display: flex; flex-wrap: wrap;">'; // Abre un nuevo contenedor flex
                }
            }

            // Cierra el último contenedor flex si la cantidad total de elementos es impar
            if (count($contador) % 2 != 0) {
                echo '</div>'; // Cierra el último contenedor flex
            }

            // Cierra el contenedor flex principal
            echo '</div>';

            // Agrega un espacio después del contenedor flex principal
            echo "<br>";

            // Incrementa el total sin descuento
            $tsindescuento = $tsindescuento + $total;
            if ($tsindescuento > 0) {
                echo("<h2>El total es de: $tsindescuento Sus</h2>");
                // Almacenar datos en la sesión para su uso posterior

            }
        }
    }
}else{
  if(isset($_COOKIE['admin'])){
   $clientes=codigosClientes();
   for ($z = 0; $z < count($clientes); $z++) {

    $ccu = $clientes[$z];
    echo("<h2>Pedido cliente $ccu</h2>");
    
    $ped = pedidos($ccu);
    for ($d = 0; $d < count($ped); $d++) {
        echo ' <h1 class="h1-contact">Pedido ' . $ped[$d] . '</h1>';
        $numPedido = numeroDelPedido($ped[$d]);
        $contador = contadorCust($ped[$d]);
        $data =  dataCod($ped[$d]);

        $tsindescuento = 0;
        $codf = 0;

        if (count($contador) > 0) {

            // Inicia un contenedor flex que permitirá envolver los elementos
            echo '<div style="display: flex; flex-wrap: wrap;">';

            for ($i = 0; $i < count($contador); $i++) {
                $codf = $data[$i];
                $auto = numeroDron($dronsArray, $codf);
                $texto = $auto->nombre;
                $total = $contador[$i] * $auto->precio;

                // Agregar más detalles del auto
                $details = "<p>nombre_empresa: {$auto->nombre_empresa}</p>" .
                "<p>codigo del dron pedido: {$numPedido[$i]}</p>" .
                    "<p>Modelo: {$auto->modelo}</p>" .
                    "<p>Marca: {$auto->marca}</p>" .
                    "<p>Año: {$auto->year}</p>" .
                    "<p>Tipo: {$auto->tipo}</p>" .
                    "<p>Cantidad: {$contador[$i]}</p>" .
                    "<p>Precio: {$auto->precio}</p>" .
                    "<p>Precio Total: $total Sus</p>";

                // Establecer un ancho fijo para cada elemento
                echo '<div style="width: 50%; box-sizing: border-box; padding: 10px;">';
                echo '<img src="../../images/'.$auto->image.'" width="312" height="350" loading="lazy" class="image-contain">';
                echo "<h2>$texto</h2>";
                echo $details;

                // Agregar el botón "Editar" que redirecciona a la página PHP con el código del dron pedido como parámetro
                echo '<a href="editar.php?codigodeldronpedido=' . $numPedido[$i] . '">Editar</a>';

                echo '</div>';

                $tsindescuento = $tsindescuento + $total;

                // Si el índice es impar, cierra el contenedor flex y abre uno nuevo
                if ($i % 2 != 0) {
                    echo '</div>'; // Cierra el contenedor flex actual
                    echo '<div style="display: flex; flex-wrap: wrap;">'; // Abre un nuevo contenedor flex
                }
            }

            // Cierra el último contenedor flex si la cantidad total de elementos es impar
            if (count($contador) % 2 != 0) {
                echo '</div>'; // Cierra el último contenedor flex
            }

            // Cierra el contenedor flex principal
            echo '</div>';

            // Agrega un espacio después del contenedor flex principal
            echo "<br>";

            // Incrementa el total sin descuento
            $tsindescuento = $tsindescuento + $total;
            if ($tsindescuento > 0) {
                echo("<h2>El total es de: $tsindescuento Sus</h2>");
                // Almacenar datos en la sesión para su uso posterior

            }
        }
    }
  }
  }
}

?>

  
        </div>
    
    </div>
    </section>
  </main>


  <footer class="footer">

    <div class="footer-top section">
      <div class="container">



        <div class="footer-link-box">
          <div class="footer-left-section">
            <ul class="footer-list">
              <li>
                <p class="footer-list-titl/e">Contactanos</p>
              </li>
              <li>
                <address class="footer-link">
                  <ion-icon name="location"></ion-icon>
                  <span class="footer-link-text">Calle 1 Obrajes, La Paz, Bolivia</span>
                </address>
              </li>
              <li>
                <a href="tel:+557343673257" class="footer-link">
                  <ion-icon name="call"></ion-icon>
                  <span class="footer-link-text">+555 3433257</span>
                </a>
              </li>
              <li>
                <a href="mailto:ucb@help.com" class="footer-link">
                  <ion-icon name="mail"></ion-icon>
                  <span class="footer-link-text">sanvalentin@gmail.com</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="footer-right-section">
            <p class="footer-list-title">Horarios de apertura</p>
            <table class="footer-table">
              <tbody>
                <tr class="table-row">
                  <th class="table-head" scope="row">Lun - Mar:</th>
                  <td class="table-data">8AM - 10PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Mie:</th>
                  <td class="table-data">8AM - 7PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Jue-Vie:</th>
                  <td class="table-data">7AM - 12PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Sab:</th>
                  <td class="table-data">9AM - 8PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Dom:</th>
                  <td class="table-data">Cerrado</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <p class="copyright">
          <a href="#" class="copyright-link">Tickets Online Cesar</a>
        </p>

      </div>
    </div>
  </footer>
  <a href="#top" class="go-top-btn" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script src="../js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>
</html>
<?php
ob_end_flush(); // Liberando el búfer de salida
?>
