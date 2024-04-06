<?php
include_once 'C:\xampp\htdocs\pr5\assets\php\conexion\conn.php';
if (isset($_POST['guardar_cotizacion'])) {
    if (isset($_COOKIE['customer'])) {
      $serializedCustomer = $_COOKIE['customer'];
      $customer = unserialize($serializedCustomer);
  
        // Obtener el resto de datos de la sesión
        $serializedtsindescuento = $_COOKIE['tsindescuento'];
      $tsindescuento = unserialize($serializedtsindescuento);
        $serializedcodCot = $_COOKIE['codCot'];
      $codCot = unserialize($serializedcodCot);
        $serializedcantidades = $_COOKIE['cantidades'];
        $cantidades = unserialize($serializedcantidades);
        guardarpedido($customer->ccu, $tsindescuento, $codCot, $cantidades);
        header("refresh:3;url=../../index.php");

    }else{
      header("refresh:3;url=Registros/login.html");

    }
    exit; // Termina la ejecución del script después de guardar la cotización
  }?>