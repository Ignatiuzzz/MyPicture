<?php
if (isset($_COOKIE['admin'])|| isset($_COOKIE['customer'])) {
    if(isset($_COOKIE['admin'])){
        header("refresh:3;url=view/admin_view.php");

    }else{
        header("refresh:3;url=view/customer_view.php");

    }

 
  }else{
    header("refresh:3;url=Registros/login.html");

  }

?>