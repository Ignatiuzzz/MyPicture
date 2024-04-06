<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="../../css/style.css">

  <link rel="shortcut icon" href="../../images/logo1.ico" type="image/x-icon">

  <link rel="preload" href="../../images/banner1.png" as="image">
</head>
<body id="top">
  <header class="header" data-header>
    <div class="container">
      <div class="overlay" data-overlay></div>
      <a href="#" class="logo">
        <img src="../../images/logo1.png" width="100" height="80" >
      </a>
      <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      <nav class="navbar" data-navbar>
        <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
          <ion-icon name="close-outline"></ion-icon>
        </button>
        <a href="#" class="logo">
          <img src="../../images/logo1.png" width="100" height="80" >
        </a>
        <ul class="navbar-list">
                        <li class="navbar-item">
                            <a href="../../../index.php" class="navbar-link">Inicio</a>
                        </li>
                        <li class="navbar-item">
                        <a  onclick="window.location.href='productos.php'"  class="navbar-link">Productos</a>
                        </li>
                    
                        <li class="navbar-item">
                        <a onclick="window.location.href='carrito.php'" class="navbar-link">Pedidos</a>

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
      <div class="about-container-nosotros">
        <h2>Datos del Cliente</h2>
        <?php
include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';

        if (isset($_COOKIE['customer'])) {

            $serializedCustomer = $_COOKIE['customer'];
            $customer = unserialize($serializedCustomer);

            if ($customer instanceof customer) {
                echo "<p><strong>Código del Cliente:</strong> {$customer->ccu}</p>";
                echo "<p><strong>Nombre:</strong> {$customer->nombre}</p>";
                echo "<p><strong>Email:</strong> {$customer->email}</p>";
                echo "<p><strong>Fecha de Registro:</strong> {$customer->fecha_registro}</p>";
            } 
        } else {
            header("refresh:3;url=../Registros/login.php");

        }
        ?>
        <br><br>
     
</button>
<button onclick="window.location.href='../Registros/logout.php'" class="nav-action-btn-admin">
  log out
</button>
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
                $texto = $auto->nombre_empresa;
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
                <p class="footer-list-title">Contactanos</p>
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
                <a href="mailto:matveraand@gmail.com" class="footer-link">
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
                  <td class="table-data">8:30AM - 8PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Mie:</th>
                  <td class="table-data">8AM - 8PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Jue-Vie:</th>
                  <td class="table-data">8AM - 8PM</td>
                </tr>
                <tr class="table-row">
                  <th class="table-head" scope="row">Sab:</th>
                  <td class="table-data">9AM - 7PM</td>
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
  <script src="../../js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>