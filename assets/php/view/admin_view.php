<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
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
        <h2>Datos del Administrador</h2>
        <?php
include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';


        if (isset($_COOKIE['admin'])) {

            $serializedAdmin = $_COOKIE['admin'];
            $admin = unserialize($serializedAdmin);

            if ($admin instanceof Admin) {
                echo "<p><strong>Código del Administrador:</strong> {$admin->ca}</p>";
                echo "<p><strong>Nombre:</strong> {$admin->nombre}</p>";
                echo "<p><strong>CI:</strong> {$admin->ci}</p>";
                echo "<p><strong>Email:</strong> {$admin->email}</p>";
                echo "<p><strong>Fecha de Registro:</strong> {$admin->fecha_registro}</p>";
            } 
        } else {
            header("refresh:3;url=../Registros/login.php");

        }
        ?>
        <br><br>
        <button onclick="window.location.href='../drons/dron_register.html'" class="nav-action-btn-admin">
  Registrar tickets
</button>

<button onclick="window.location.href='../Registros/registro_admin.html'" class="nav-action-btn-admin">
  Registrar admins
</button>
<button onclick="window.location.href='../Registros/logout.php'" class="nav-action-btn-admin">
  log out
</button>
      </div>
    </section>
    <section class="section product">




<div class="contact-container">
  
  <h2 class="h2-contact">Los tickets registrados por el administrador: </h2>
</div>

<?php
include_once 'C:\xampp\htdocs\pr5\assets\php\extras.php';
include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
include_once 'C:\xampp\htdocs\pr5\assets\php\objects\classes.php';
$drons = registedticketsAdmin();

if ($drons != null && !empty($drons)) {
    $categorias = array();
    $imagenes = array();
    $enlaces = array();
    $destinos = array();
    
    foreach ($drons as $dron) {
        $tipo = $dron->getTipo(); // Acceder al método getTipo() del objeto dron
        if (!in_array($tipo, $categorias)) {
            $categorias[] = $tipo;
        }
    }
    
    $matrixdrons = matrixdronToAdmin($categorias);

    foreach ($categorias as $categoria) {
        echo '<div class="container">';
        echo '<h3 id="punto' . $categoria . '" class="h3-contact">' . $categoria . ': </h3>';
        echo '<ul class="product-list">';

        foreach ($matrixdrons as $dronsArray) {
            foreach ($dronsArray as $dron) {
                if ($dron->getTipo() == $categoria) { // Acceder al método getTipo() del objeto dron
                    echo '<li class="product-item">';
                    echo '<div class="product-drond" tabindex="0">';
                    echo '<figure class="drond-banner1">';
                    echo '<img src="../../images/' . $dron->getImage() . '" width="312" height="350" loading="lazy" class="image-contain">';
                    echo '</figure>';
                    echo '<div class="drond-content">';
                    echo '<h3 class="h3 drond-title">';
                    echo '<a href="#">' . $dron->getNombreEmpresa() . '</a>';
                    echo '</h3>';
                    echo '<input type="text" name="data" class="drond-price" value="' . $dron->getPrecio() . '.00 Sus"></input>';
                  
                    echo '</div>';
                    echo '</div>';
                    echo '</li>';
                }
            }
        }

        echo '</ul>';
        echo '</div>';
    }
}
?>

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