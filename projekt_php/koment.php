<?php
umask(0);

$blogWpis = $_GET["blog_name"];
$nazwaWpisu = $_GET["nazwaWpisu"];
$nazwaKatalogu = $nazwaWpisu . ".k";


/*
$katalog = str_replace('-','',date('Y-m-d'));
$katalog = $katalog .str_replace(':','',date("H:i:s"));

$i = 0;
while (file_exists($blogWpis/$katalog . $i. "k")) {
    $i++;
}
if ($i < 10) {
    $i = "0" . $i;
}

echo $katalog;
$katalogk = $katalog.$i.".k";
*/




if(!is_dir("$blogWpis/$nazwaKatalogu")) { //jesli brak katalogu to tworzymy
    mkdir("$blogWpis/$nazwaKatalogu", 0777);
    echo "utworzono";
}

$iterator=0;
while(file_exists("$blogWpis/$nazwaKatalogu/$iterator")){
    $iterator = $iterator + 1;
}


$file = fopen("$blogWpis/$nazwaKatalogu/$iterator", 'w');
$rodzaj = $_GET['rodzaj']."\n";
$data = date('Y-m-d')." ".date('H:i:s')."\n";
$nick = $_GET['nick']."\n";
$koment = $_GET['kom']."\n";


fwrite($file, $rodzaj);
fwrite($file, $data);
fwrite($file, $nick);
fwrite($file, $koment);



include 'menu.php';
?>