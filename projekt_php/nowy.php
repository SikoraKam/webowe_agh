<?php
umask (0);


    $blog = $_POST["name"];

    if(is_dir($blog)){
        echo "juz istnieje";
    }
    elseif ($blog== ""){
        echo "brak nazwy";
        exit();
    }
    else{
        mkdir($blog,0777);
        $file = fopen("$blog/info", "w");
        echo "utworzono";
    
    }
    
    
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];
    $opis = $_POST["opis"];
    $haslo = ($_POST["haslo"]);
    $haslo = md5($haslo);

    fwrite($file,$login);
    fwrite($file,"\n");
    fwrite($file,$opis);
    fwrite($file,"\n");
    fwrite($file,$haslo);
    fclose($file);

    include 'menu.php';
?>
