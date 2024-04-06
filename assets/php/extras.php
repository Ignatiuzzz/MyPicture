<?php
function buscarAuto($cadena, $array) {
    // Verificar si el array está vacío
    if (empty($array)) {
        return false;
    }

    foreach ($array as $elemento) {
        // Verificar si el elemento es una cadena y es igual a la cadena buscada
        if (is_string($elemento) && $elemento === $cadena) {
            return true;
        }
    }

    // Si no se encontró la cadena en el array
    return false;
}
function numeroDron($dronsArray,$codf){
    for($i=0;$i<count($dronsArray);$i++){
        if($dronsArray[$i]->cc==$codf){
            return $dronsArray[$i];
        }
    }
    
    return null;
}



function quitar($cadena) {
    $partes = explode(" ", $cadena);
return $partes[0];
}


?>