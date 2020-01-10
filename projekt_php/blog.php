<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Blog</title>
</head>
<body>
    <form action="blog.php" method="GET">
    Tytuł bloga: <input type="text" name="nazwaBloga" /> </br><br/>
    <input type="submit" value="Wyślij" />
    <input type="submit" value="Wyświetl nazwy blogów" name="wyswietl_nazwy" />
    <input type="reset" value="Wyczyść" /> <br/><br/>
    </form>

    <?php
	umask(0);


    if(isset($_GET['wyswietl_nazwy'])){
        $blogs = glob('*', GLOB_ONLYDIR);
        echo "<ul>";
        foreach ($blogs as $blog) {
            echo "<li><a href=blog.php?nazwaBloga=$blog>$blog</a></li>";
        }
        echo "</ul>";
    }
    if (isset($_GET['nazwaBloga'])){
    	$nazwaBloga = $_GET['nazwaBloga'];
		if(empty($nazwaBloga)){
            $blogs = glob('*', GLOB_ONLYDIR);
        	echo "<ul>";
        	foreach ($blogs as $blog) {
            echo "<li><a href=blog.php?nazwaBloga=$blog>$blog</a></li>";
        	}
        	echo "</ul>";
        }
		else{
			if (file_exists("./" . $nazwaBloga . "/")) {//
					$filesList = scandir($nazwaBloga);
		            for ($i = 0; $i < sizeof($filesList); $i++) {
                        $fileBaseName = explode(".", $filesList[$i])[0];
		                
		                //jesli dlugosc to 16 znakow i jest plikiem (nie folderem)
		                if (strlen($fileBaseName) == 16  && is_file($nazwaBloga . "/" . $filesList[$i])) {//
		                    $currentFile = fopen("$nazwaBloga/$filesList[$i]", "r");// //fopen z parametrem r w przypadku niepowoddzenia zwraca false
		                    if ($currentFile != false) {
                                echo "treść wpisu: " ."<br/>".fgets($currentFile) . "<br>";
                                for ($k = 0; $k < 3; $k++){
                                    for ($j = 0; $j < sizeof($filesList); $j++){
		                                $attachmentBaseName = explode(".", $filesList[$j])[0];
		                                if (strcmp($attachmentBaseName, $fileBaseName . $k+1) == 0) {
		                                    echo '<a href="' . $nazwaBloga . "/" . $filesList[$j] . '">plik' . ($k + 1) . '</a>';
		                                    echo "<br/>";
		                                }
		                            }
								}
								
								echo "<br><br>KOMENTARZE:<br>";
								$commentList = @scandir($nazwaBloga . "/" . $fileBaseName . ".k");
								if ($commentList != false) {
									$listSize = sizeof($commentList) - 2;
									for ($l = 0; $l < $listSize; $l++) {
										$commentFile = fopen($nazwaBloga . "/" . $fileBaseName . ".k/" . $l , "r");
										echo "Rodzaj:" . fgets($commentFile) . "<br>";
										echo "Data:" . fgets($commentFile) . "<br>";
										echo "Nick: " . fgets($commentFile) . "<br>";
										echo "Komentarz: " . fgets($commentFile) . "<br><br/>";

									}
								}
								else {
									echo "Brak komentarzy <br><br>";
								}

								echo "<br/>";
								echo '<form action="koment_form.php" method="GET">
		                        <input type="text" value="' . $nazwaBloga . '" name="blog_name" hidden="hidden">
		                        <input type="text" value="' . $fileBaseName . '" name="nazwaWpisu" hidden="hidden">
		                        <input type="submit" value="Dodaj komentarz">
								</form>';
		                        
		                    }
		                }
		            }
		            
		                    
		        }else{
					echo "Nie ma takiego bloga!!!<br/>";
				}
		}
}
	include 'menu.php';

	?>

</body>
</html>
