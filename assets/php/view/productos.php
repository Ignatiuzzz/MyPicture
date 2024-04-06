<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="icon" href="assets/images/logo1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body id="top">
    <form action="carrito.php" method="post">

        <header class="header" data-header>
            <div class="container">
                <div class="overlay" data-overlay></div>
                <a href="#" class="logo">
                    <img src="../../images/logo1.png" width="100" height="80">
                </a>
                <button type="button" class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
                    <ion-icon class="nav-open-btn-icon" name="menu-outline"></ion-icon>
                </button>
                <nav class="navbar" data-navbar>
                    
                    <a href="#" class="logo">
                        <img src="../../images/logo1.png" width="100" height="80">
                    </a>
                    <ul class="navbar-list">
                        <li class="navbar-item">
                            <a href="../../../index.php" class="navbar-link">Inicio</a>
                        </li>
                        <li class="navbar-item">
                            <a href="#" class="navbar-link">Productos</a>
                        </li>
                        <li class="navbar-item">

                        <button class="navbar-link " id="productos-link" onclick="window.location.href='carrito.php'" value="carrito" type="submit" name="carrito">Pedidos</button>
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
                            <span class="nav-action-btn">
                                <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
                                <span class="nav-action-text">Buscador</span>
                            </span>
                        </li>
                        <li>
                            <span onclick="window.location.href='../redireccionar.php'" class="nav-action-btn">
                                <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
                                <span class="nav-action-text">Usuario</span>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <article>
                
                <section class="section collection">
                    <div class="container">
                        <ul class="collection-list has-scrollbar">
                        <?php
  include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
  include '../extras.php';
  
  $drons=registedtickets();
 if($drons!=null){
  $dronsArray = $drons;
  $serializeddrosArray = serialize($dronsArray);
  setcookie('dronsArray', $serializeddrosArray, time() + 3600, '/'); // Caduca en 1 hora
    $categorias = array();
    $imagenes = array();
    $enlaces = array();
    $destinos = array();
    $c=0;
    for ($i = 0; $i < count($drons); $i++) {
      if(!buscarAuto($drons[$i]->getTipo(),$categorias)){
        
        $categorias[$c]=$drons[$i]->getTipo();
        $images[$c]=$drons[$i]->getImage();
        $enlaces[$c]="enlace" . $drons[$i]->getTipo();
        $destinos[$c]="punto" . $drons[$i]->getTipo();
        $c++;
      }
  
    }
   
  
    for ($i = 0; $i < count($categorias); $i++) {
      echo '<li>';
      echo '<h3 class="h4-drond-title">' . $categorias[$i] . '</h3>';
      echo '<br>';
      echo '<div class="collection-card" style="background-image: url(\'../../images/' . $images[$i] . '\')">';
      echo '<br>';
      echo '<a id="' . $enlaces[$i] . '" href="#" class="btn btn-secondary" onclick="scrollToDestination(\'' . $enlaces[$i] . '\', \'' . $destinos[$i] . '\');">';
      echo '<span>Descubre más</span>';
      echo '<ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>';
      echo '</a>';
      echo '</div>';
      echo '</li>';
    }
 }
  ?>
                        </ul>
                    </div>
                </section>
                <section class="section product">
                    <div class="contact-container">
                        <h2 class="h2-contact">Los Tickets disponibles: </h2>
                    </div>
                    <?php
  include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
  $dronsArray=Array();
$dronsArray=registedtickets();


if($dronsArray!=null){
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

$matrixdrons=matrixdron($categorias);
$aux=0;
$aux2=0;



for ($i = 0; $i < count($categorias); $i++) {
    echo '<div class="container">';
    echo '<h3 id="punto' . $categorias[$i] . '" class="h3-contact">' . $categorias[$i] . ': </h3>';
    echo '<ul class="product-list">';
    
    for ($j = 0; $j < count($matrixdrons[$i]); $j++) {
        echo '<li class="product-item">';
        echo '<div class="product-drond" tabindex="0">';
        echo '<figure class="drond-banner1">';
        echo '<img src="../../images/' . $matrixdrons[$i][$j]->getImage(). '" width="312" height="350" loading="lazy" class="image-contain">';
        echo '</figure>';
        echo '<div class="drond-content">';
        echo '<h3 class="h3 drond-title">';
        echo '<a href="#">'.$matrixdrons[$i][$j]->getNombreEmpresa().'</a>';
        echo '</h3>';
        echo '<input type="text" name="data' . ($i * $aux + $j+$aux2) . '" class="drond-price" value="' . $matrixdrons[$i][$j]->getPrecio() . '.00 Sus"></input>';
        echo '<div class="counter-container">';
        echo '<input type="button" class="input-contador" onclick="disminuirContador(\'contador' . ($i * $aux + $j+$aux2) . '\')" name="-" value="-"></input>';
        echo '<input class="input-contador" id="contador' . ($i * $aux + $j+$aux2) . '" name="contador' . ($i * $aux + $j+$aux2) . '" type="text" value="0" readonly size="1">';
        echo '<input type="button" class="input-contador" onclick="aumentarContador(\'contador' . ($i * $aux + $j+$aux2) . '\')" name="+" value="+"></input>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
    $aux=count($matrixdrons[$i]);
  if($aux==1){
    $aux2=1;
  }else{
    $aux2=0;
  }
    echo '</ul>';
    echo '</div>';
}
}
?>

                </section>
            </article>
        </main>

        <footer class="footer">
            <div class="footer-top section">
                <div class="container">
                    <div class="footer-link-box">
                      
                            <div class="col-xl-6">
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
                                        <a href="mailto:ucb@help.com" class="footer-link">
                                            <ion-icon name="mail"></ion-icon>
                                            <span class="footer-link-text">ucbhoodies@gmail.com</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-6">
                                <p class="footer-list-title">Horarios de apertura</p>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Lun - Mar:</th>
                                            <td>7AM - 8PM</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mie:</th>
                                            <td>7AM - 9PM</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jue-Vie:</th>
                                            <td>7M - 10PM</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sab:</th>
                                            <td>9AM - 6PM</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Dom:</th>
                                            <td>Cerrado</td>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="../../js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </form>
</body>

</html>
