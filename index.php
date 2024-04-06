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
    <title>UCB</title>
    <link rel="icon" href="assets/images/logo1.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body id="top">

        <header class="header" data-header>
            <div class="container">
                <div class="overlay" data-overlay></div>
                <a href="#" class="logo">
                    <img src="./assets/images/logo1.png" width="100" height="80">
                </a>
                <button type="button" class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
                    <ion-icon class="nav-open-btn-icon" name="menu-outline"></ion-icon>
                </button>
                <nav class="navbar" data-navbar>

                    <a href="#" class="logo">
                        <img src="./assets/images/logo1.png" width="100" height="80">
                    </a>
                    <ul class="navbar-list">
                        <li class="navbar-item">
                            <a href="index.php" class="navbar-link">Inicio</a>
                        </li>
                        <li class="navbar-item">
                            <a onclick="window.location.href='assets/php/view/productos.php'" class="navbar-link">Productos</a>
                        </li>
                        <li class="navbar-item">
                        <a onclick="window.location.href='assets/php/view/carrito.php'" class="navbar-link">Pedidos</a>

                        </li>
                        <li class="navbar-item">
                            <a href="assets/php/view/contactanos.html" class="navbar-link">Contactanos</a>
                        </li>
                        <li class="navbar-item">
                            <a href="assets/php/view/nosotros.html" class="navbar-link">Nosotros</a>
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
                            <span onclick="window.location.href='assets/php/redireccionar.php'" class="nav-action-btn">
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
                <section class="section hero" style="background-image: url('./assets/images/banner1.jpg')">
                    <div>
                        <h2 class="h1 hero-title">
                            <strong>Tickets</strong><br>
                            disponibles para todos<br>
                        </h2>
                    </div>
                </section>
                <section class="section collection">
                    <div class="container">
                        <ul class="collection-list has-scrollbar">
                            <?php
                            include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
                            include 'assets/php/extras.php';

                            $drons = registedtickets();
                            if ($drons != null) {
                                $dronsArray = $drons;
                                $serializedDronsArray = serialize($dronsArray);
                                setcookie('dronsArray', $serializedDronsArray, time() + 3600, '/'); // Caduca en 1 hora
                                $categorias = array();
                                $imagenes = array();
                                $enlaces = array();
                                $destinos = array();
                                $c = 0;
                                for ($i = 0; $i < count($drons); $i++) {
                                    if (!buscarAuto($drons[$i]->getTipo(), $categorias)) {

                                        $categorias[$c] = $drons[$i]->getTipo();
                                        $images[$c] = $drons[$i]->getImage();

                                        $c++;
                                    }
                                }

                                for ($i = 0; $i < count($categorias); $i++) {
                                    echo '<li>';
                                    echo '<h3 class="h4-card-title">' . $categorias[$i] . '</h3>';
                                    echo '<br>';
                                    echo '<div class="collection-card" style="background-image: url(\'./assets/images/' . $images[$i] . '\')">';
                                    echo '<br>';
                                    echo '<a  href="#" class="btn btn-secondary" );">';
                                    echo '<span onclick="window.location.href=\'assets/php/view/productos.php\'">Descubre más</span>';
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
        <h2 class="h2-contact">Acerca de nosotros: </h2>
    </div>
    <section class="section product">
        <div class="about-container-nosotros">
            <h1 class="h1">Tienda de Tickets para Conciertos</h1>

        <p class="p-contact">¡Bienvenido a la tienda oficial de tickets para conciertos! Explora nuestra página para descubrir una amplia selección de eventos musicales que representan la emoción y la pasión de la música en vivo.</p>
        <br>

        <h2 class="h2-contact">Nuestra Historia en la Industria Musical</h2>
        <p class="p-contact">Desde nuestros inicios, nos hemos destacado en ofrecer acceso a los conciertos más emocionantes y populares. Descubre cómo hemos evolucionado para convertirnos en tu destino preferido para comprar tickets para conciertos.</p>
        <br>

        <h2 class="h2-contact">Nuestra Misión en Experiencias Musicales</h2>
        <p class="p-contact">Nos dedicamos a proporcionar acceso fácil y seguro a experiencias musicales en vivo inolvidables. Nuestra misión es que disfrutes de la emoción de asistir a conciertos que reflejen tu pasión por la música.</p>
        <br>

        <h2 class="h2-contact">Equipo Comprometido con la Experiencia Musical</h2>
        <p class="p-contact">Detrás de cada concierto hay un equipo comprometido con brindar una experiencia excepcional. Desde nuestro equipo de organización de eventos hasta nuestro servicio de atención al cliente, todos compartimos la visión de ofrecer lo mejor en entretenimiento musical en vivo.</p>

        <p class="p-contact">Gracias por explorar nuestra tienda en línea. Esperamos que encuentres los tickets perfectos para disfrutar de tus conciertos favoritos y vivir momentos inolvidables. ¡Disfruta de tu experiencia de compra!</p>
        <br>
    </div>
</section>
</section>






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
                                        <span class="footer-link-text">tickets@gmail.com</span>
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
        <script src="./assets/js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
ob_end_flush(); // Liberando el búfer de salida
?>
