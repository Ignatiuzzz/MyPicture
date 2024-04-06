<?php
class pedido {
    public $cur;
    public $total;
    public $Customer_ccu;
    public $aprobado;
    public function __construct($cur, $total, $Customer_ccu,$aprobado) {
        $this->cur = $cur;
        $this->total = $total;
        $this->Customer_ccu = $Customer_ccu;
        $this->aprobado = $aprobado;
    }
}
?>