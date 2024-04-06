<?php
class Admin {
    public $ca;
    public $nombre;
    public $ci;
    public $password;
    public $fecha_registro;
    public $email;

    public function __construct($ca, $nombre, $ci, $password, $fecha_registro, $email) {
        $this->ca = $ca;
        $this->nombre = $nombre;
        $this->ci = $ci;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro;
        $this->email = $email;
    }

    public function toString() {
        return "Admin: { ca: {$this->ca}, nombre: {$this->nombre}, ci: {$this->ci}, password: {$this->password}, fecha_registro: {$this->fecha_registro}, email: {$this->email} }";
    }
    // Getters
    public function getCa() {
        return $this->ca;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCi() {
        return $this->ci;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    public function getEmail() {
        return $this->email;
    }

    // Setters
    public function setCa($ca) {
        $this->ca = $ca;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCi($ci) {
        $this->ci = $ci;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFechaRegistro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}

?>