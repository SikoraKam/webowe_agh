<?php
umask(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nick = $_POST['nick'];
$message = $_POST['message'];

if(empty($nick) || empty($message)){
    echo 'brak nazwy lub wiadomosci';
    return;
}

$file = realpath('./chat.txt');
$handle = fopen($file,'r+');

//ograniczenie liczby wiadmosci jak w tressci zadania
$max_messages_amount = 30;

if(flock($handle, LOCK_SH)){
    $messages = explode(PHP_EOL, fread($handle, filesize($file))); //PHP_EOL finds newline
    $messages[] = $nick . ' - ' . remove_unnecessary($message); //
    $messages = array_filter($messages, 'strlen'); //?
    $messages_amount = count($messages);

    //usuniecie najstzrszych po przekroczniu limitu
    if($messages_amount > $max_messages_amount){
        $messages = array_slice($messages,$messages_amount - $max_messages_amount);
    }

    //wracamy na poczatek pliku
    rewind($handle);
    //usunicie wszytskiego z pliku
    ftruncate($handle,0);

    foreach($messages as $message_line){
        fwrite($handle,$message_line.PHP_EOL);
    }

    flock($handle,LOCK_UN);
}

fclose($handle);


function remove_unnecessary($text) {
    return str_replace(["\r\n","\r","\n"], ' ', $text);
  }


?>
