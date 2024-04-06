<?php
// Para cerrar la sesión (logout), establecer la fecha de expiración en el pasado
if (isset($_COOKIE['admin'])) {
    setcookie('admin', '', time() - 3600, '/');

}else{
    setcookie('customer', '', time() - 3600, '/');

}


header("refresh:3;url=../../../index.php");
?>