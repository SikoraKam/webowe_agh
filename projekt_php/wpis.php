<?php
umask(0);

    $login =$_POST['login'];
    $password = md5($_POST['password']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $wpis = $_POST['wpis'];
    
    //sekcja krytyczna blokująca dodanie jednocześnie dwóch wpisów do tego samego bloga
    define(KLUCZ,111111);
    $sem = sem_get(KLUCZ);
    ob_flush();flush();
    sem_acquire($sem);
if($handle = opendir('.')){
    while(false !== ($entry = readdir($handle))){
        
        if($entry != "." && $entry != "..") {
            if(is_dir($entry)){
                
                $open = fopen("$entry/info", 'r');
                $nazwa = trim(fgets($open));
                $wpisprzeczytany = trim(fgets($open));
                $haslo = trim(fgets($open)); //haslo w 3 linijce
                
               

                if($nazwa==$login && $haslo==$password){
                    echo $entry."<br/>";
                    $nowyWpis = $entry;


                    $convertedDate = str_replace('-','',$date);
                    $convertedTime = str_replace(':','',$time);
                    $seconds = date('s');

                    $wpisNazwa = "$convertedDate"."$convertedTime"."$seconds";

                    $i = 0;
                    while (file_exists($wpisNazwa . $i)) {
                        $i++;
                    }
                    if ($i < 10) {
                        $i = "0" . $i;
                    }

                    $wpisNazwa = $wpisNazwa . $i;
                    $newFile = fopen("$nowyWpis/$wpisNazwa", 'w');
                    fwrite($newFile, $wpis);
                    fclose("$nowyWpis/$wpisNazwa");

                    echo "Login: ".$login."<br/>";
                    echo "Data: ".$date."<br/>";
                    echo "Czas: ".$time .":". $seconds."<br/>";
                    echo "Wpis: ".$wpis."<br/>";
                    
                    for ($j = 0; $j < sizeof($_FILES); $j++) {
                        if (sizeof($_FILES["file" . ($j + 1)]["name"]) > 0) {
                            
                            $uploaddir = $nowyWpis;
                            $fileName = $_FILES["file" . ($j + 1)]["name"];
                            
                            $extension = explode(".", $fileName)[sizeof(explode(".", $fileName)) - 1];
                            $k = $j +1;
                            $uploadfile = $uploaddir . "/" . $wpisNazwa . $k . "." . $extension;
                            
                            move_uploaded_file($_FILES["file" . ($j + 1)]["tmp_name"], $uploadfile);
                            

                            
                        }
                    }
                }
                
            }
        }
    }
    
}
ob_flush();flush();
    sleep(2);
    sem_release($sem);
include 'menu.php';

?> 