
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
<head>
<script>
    function getDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
        
            today = mm + '/' + dd + '/' + yyyy;
            document.getElementById("date").value = today;
    }

</script>
</head>

<form action="wpis.php" method="POST" enctype="multipart/form-data">
    Login: <input type="text" name="login" /> </br>
    Haslo: <input type="password" name="password" /> </br>
    Wpis: <textarea name="wpis"></textarea> </br>
    Data: <input type="text" name="date" value="<?php echo date('Y-m-d'); ?>" /> </br>
    Godzina: <input type="text" name="time" value="<?php echo date('H:i'); ?>" /> </br>
    Pliki:</br>
    <input type="file" name="file1" /> </br>
    <input type="file" name="file2" /> </br>
    <input type="file" name="file3" /> </br>
    <input type="submit" value="Wyślij" />
    <input type="reset" value="Wyczyść" />
</form>
<?php
include 'menu.php';
?>

</body>
</html>