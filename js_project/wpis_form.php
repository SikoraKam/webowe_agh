
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
<head>
<script>
    function validateDate(){
        var dateString = document.getElementById("date").value;
        var year = dateString.substring(0,4);
        var day = dateString.substring(8);
        var month = dateString.substring(5,7);
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/.test(dateString);
        //sprawdzenie formatu
        if(!dateRegex){
            getDateTime();
            return;
        }
        var currentDate = new Date();
        dateString = new Date(dateString);

        //sprawdzenie daty z przyszlosci
        if(dateString > currentDate){
            getDateTime();
            return;
        }
        //sprawdzenie czy poprawnosci danych z zakresow dla danego czasu
        if(day < 1 || day > 31){
            getDateTime();
            return;
        }
        if(month < 1 || month > 12){
            getDateTime();
            return;
        }
        if(year<1){
            getDateTime();
            return;
        }
    }
    function validateTime(){
        var stringTime = document.getElementById("time").value;
        var splittedTime = stringTime.split(':');
        if(splittedTime[0] < 0 || splittedTime[0]>23 || splittedTime[1] < 0 || splittedTime[1]>59){
            getDateTime();
            return;
        }
    }


    function getDateTime() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
        
            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("date").value = today;

            var time = new Date();
            var minutes = time.getMinutes();
            if(minutes < 10){
                minutes = "0"+minutes;
            }
            var hour = time.getHours();
            time = hour + ':' + minutes;
            document.getElementById("time").value = time;
    }
    var counter = 1;
    var filesIndex = 1;

/*function addChooser(number) {
  var newFileInput = document.createElement('input');
  newFileInput.type = 'file';
  filesIndex++;
  newFileInput.name = 'fileToUpload' + filesIndex;
  // newFileInput.id = 'fileToUpload' + filesIndex;
  newFileInput.setAttribute("onchange", "addChooser("+filesIndex+")");

  document.getElementsByTagName('form')[0].insertBefore(newFileInput, document.getElementById('submit'));

  document.getElementsByTagName('form')[0].insertBefore(document.createElement('br'), document.getElementById('submit'));
}*/
var counter = 1;
function addFile() {
  var container = document.getElementById("pliki");
  var input = document.createElement("input");
  
  input.type = "file";
  counter++;
  input.name = "file" + counter; 
  input.onchange = addFile;
  
  container.appendChild(input);
  var br = document.createElement('br');
  container.appendChild(br);
}
    

</script>
</head>

<body onload="getDateTime()">
<form action="wpis.php" method="POST" enctype="multipart/form-data" id="myForm">
    Login: <input type="text" name="login" /> </br>
    Haslo: <input type="password" name="password" /> </br>
    Wpis: <textarea name="wpis"></textarea> </br>
    Data: <input type="text" onchange="validateDate()" name="date"  id="date"/> </br>
    Godzina: <input type="text" onchange="validateTime()" name="time" id="time"/> </br>
    Pliki:</br>
    <div id="pliki" class="pliki">
    <input onchange="addFile()"type="file" class="plik" id="file1" name="file1" /><br />
    </div>
  
    <input type="submit" value="Wyślij" />
    <input type="reset" value="Wyczyść" />
</form>
<?php
include 'menu.php';
?>

</body>
</html>