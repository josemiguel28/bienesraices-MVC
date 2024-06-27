<?php 

function conectarDB(): mysqli {
    $db = new mysqli('localhost', 'root','root', 'bienesraices_crud',3306);

    if (!$db){
        echo "no se puedo conectar con la base de datos";
        exit; 
    }

    return $db; 
}