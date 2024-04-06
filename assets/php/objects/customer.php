<?php

class Customer {
    public $ccu;
    public $nombre;
    public $email;
    public $fecha_registro;
    public $password;

    public function __construct($ccu, $nombre, $email, $fecha_registro, $password) {
        $this->ccu = $ccu;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->fecha_registro = $fecha_registro;
        $this->password = $password;
    }
}
?>