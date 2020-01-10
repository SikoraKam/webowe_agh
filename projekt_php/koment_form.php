<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
</head>
<body>
<form action="koment.php" method="GET">
    Rodzaj komentarza: <select name = "rodzaj">
        <option>pozytywny</option>
        <option>negatywny</option>
        <option>neutralny</option>
    </select> </br>
    Komentarz: <textarea name="kom"></textarea> </br>
    Imie: <input type="text" name="nick" /> </br>
    <input type="text" value= "<?php echo $_GET['blog_name']; ?>" name="blog_name" hidden="hidden">
	<input type="text" value= "<?php echo $_GET['nazwaWpisu']; ?>" name="nazwaWpisu" hidden="hidden">
    <input type="submit" value="Wyślij" />
    <input type="reset" value="Wyczyść" />
</form>
<?php
include 'menu.php';
?>
</body>
</html>
