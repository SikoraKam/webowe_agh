<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//wylaczamy sesje bo nie mozna uzywaz w long-pollingu
session_write_close();
// kończymy wykonywanie skryptu jesli request zostanie zamkniety przez przegladarke
ignore_user_abort(false);
//limit czasu dla wykonania na zero co powoduje wykonnywanie skryptu w nieskonczonosc
set_time_limit(0);

$file = realpath('./chat.txt');
//czas modyfikacji pliku, zmiana oznacza nowe wiadomosci
$file_time = filemtime($file);


$file_time_new = $file_time;//do porownania czasu w petli
while($file_time == $file_time_new && !isset($_GET['fetch'])){ //?
    clearstatcache();
    $file_time_new = filemtime($file);
    sleep(1);
}

$messages = '';
$handle = fopen($file,'r'); 

if(flock($handle,LOCK_SH)){
    $messages = fread($handle,filesize($file));
    flock($handle,LOCK_UN);
}

fclose($handle);
echo $messages;


  

?>