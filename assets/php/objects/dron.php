<?php
class Dron {
    public $cc;
    public $nombre_empresa;
    public $nombre;
    public $modelo;
    public $marca;
    public $year;
    public $celular;
    public $email;
    public $fecha_registro;
    public $tipo;
    public $precio;
    public $image;

    public function __construct($cc, $nombre_empresa, $nombre, $modelo, $marca, $year, $celular, $email, $fecha_registro, $tipo, $precio, $image) {
        $this->cc = $cc;
        $this->nombre_empresa = $nombre_empresa;
        $this->nombre = $nombre;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->year = $year;
        $this->celular = $celular;
        $this->email = $email;
        $this->fecha_registro = $fecha_registro;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->image = $image;
    }
    public function __toString() {
        return "Dron: " . $this->nombre . " (" . $this->marca . " " . $this->modelo . ")\n" .
               "Tipo: " . $this->tipo . "\n" .
               "Precio: $" . $this->precio . "\n" .
               "Registrado por: " . $this->nombre_empresa . " (CC: " . $this->cc . ")\n" .
               "Año de fabricación: " . $this->year . "\n" .
               "Contacto: " . $this->celular . ", " . $this->email . "\n" .
               "Registrado el: " . $this->fecha_registro . "\n";
    }
    // Getters
    public function getCc() {
        return $this->cc;
    }

    public function getNombreEmpresa() {
        return $this->nombre_empresa;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getYear() {
        return $this->year;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getImage() {
        return $this->image;
    }

    // Setters
    public function setCc($cc) {
        $this->cc = $cc;
    }

    public function setNombreEmpresa($nombre_empresa) {
        $this->nombre_empresa = $nombre_empresa;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaRegistro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setImage($image) {
        $this->image = $image;
    }
   
    
}
?>