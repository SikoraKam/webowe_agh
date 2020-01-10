<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Nowy Blog - Formularz</title>
</head>
<body>

<h1>Nowy blog</h1>
<form action="nowy.php" method="post">
    Nazwa bloga: <br />
    <input type="text" id="blog_name" name="name" /><br />

    Nazwa użytkownika:<br />
    <input type="text" id="login" name="login" /><br />

   Hasło użytkownika:<br />
    <input type="password" id="haslo" name="haslo" /><br />

   Opis:<br />
    <textarea id="description" name="opis" cols="60" rows="5"></textarea><br />

    <input type="submit" value="Wyślij"><br />
    <input type="reset" value="Wyczyść">
</form>
<?php
include 'menu.php';
?>

</body>
</html>