<?php

$url = $_SERVER["REQUEST_URL"];
$conta = strlen($url);
echo $rest = substr($url,18,$conta);
    if("/pruebas.php" == $rest){
        echo "es igual";
    }else{
        echo "no es igual";
    
}