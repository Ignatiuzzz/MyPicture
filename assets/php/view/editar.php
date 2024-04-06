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
      <div class="container-contact-us">

        <div class="contact-container">
    
            <h1 class="h1-contact">Detalles del pedido:</h1>
    
            <?php
include '../extras.php';
include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';

// Verifica si se ha pasado el parámetro "codigodeldronpedido" en la URL
if(isset($_GET['codigodeldronpedido'])) {

    // Recibe el valor del parámetro
    $codigodeldronpedido = $_GET['codigodeldronpedido'];
    $auto = detallesdelDronporPedido($codigodeldronpedido);
    $cant = cantidaddeldronpedido($codigodeldronpedido);
    $total = $cant * $auto->precio;
    $texto = $auto->nombre_empresa;

    $details = "<div class='details-container'>" .
    "<p><strong>Codigo del pedido del ticket:</strong> {$codigodeldronpedido}</p>" .

               "<p><strong>Nombre de la empresa:</strong> {$auto->nombre_empresa}</p>" .
               "<p><strong>Modelo:</strong> {$auto->modelo}</p>" .
               "<p><strong>Marca:</strong> {$auto->marca}</p>" .
               "<p><strong>Año:</strong> {$auto->year}</p>" .
               "<p><strong>Tipo:</strong> {$auto->tipo}</p>" .
               "<p><strong>Cantidad:</strong> <input type='number' id='cantidad' name='cantidad' value='$cant' min='1' max='999' step='1'></p>" . // Campo editable para la cantidad
               "<p><strong>Precio unitario:</strong> {$auto->precio} Sus</p>" .
               "<p><strong>Precio Total:</strong> $total Sus</p>" .
               "</div>";

    // Establecer un ancho fijo para cada elemento
    echo '<div style="display: flex; align-items: center; width: 80%; box-sizing: border-box; padding: 10px;">';
    echo '<img src="../../images/'.$auto->image.'" width="312" height="350" loading="lazy" class="image-contain">';
    echo "<div style='margin-left: 20px;'>";
    echo "<h2>$texto</h2>";
    echo "<form action='guardar.php' method='post'>"; // Formulario para guardar con el campo de cantidad editable
    echo "<input type='hidden' name='codigodeldronpedido' value='$codigodeldronpedido'>";
    echo "<input type='hidden' name='cant' id='cant' value='$cant'>"; // Se envía la cantidad original
    echo $details;
    echo "<button type='submit' name='guardar'>Guardar</button>";
    echo "</form>";
    
    // Botón para quitar del pedido
    echo "<form action='quitar.php' method='post'>";
    echo "<input type='hidden' name='codigodeldronpedido' value='$codigodeldronpedido'>";
    echo "<button type='submit' name='quitar'>Quitar del pedido</button>";
    echo "</form>";
    
    echo "</div>";
    echo '</div>';
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
  <script>
    // JavaScript para actualizar el valor de $cant cuando cambia el campo de entrada de cantidad
    document.getElementById('cantidad').addEventListener('input', function() {
        var cantidad = this.value;
        document.getElementById('cant').value = cantidad;
    });
</script>
  <script src="../../js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>