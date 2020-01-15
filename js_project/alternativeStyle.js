var styles = document.querySelectorAll('link[type="text/css"][media="screen"]');
var stylesList = document.querySelector('.js-styles-list');

//5
for(var i=0; i<styles.length; i++){
    var style = styles[i];
    var li = document.createElement('li');
  
    li.innerHTML = style.getAttribute('title');
    //6
    li.setAttribute('onclick', 'setStyleActive(' + i + ')');
    stylesList.appendChild(li);
}

function setStyleActive (styleIndex) {
    // wylaczenie wszytskich, inaczej bląd
    for (var i = 0; i < styles.length; i++) {
      styles[i].disabled = true;
    }
  
    styles[styleIndex].disabled = false;
  
    //cookie set
    document.cookie = 'style=' + styleIndex + ';';
  }

//7
window.addEventListener('load',function() {
    if(document.cookie){
        var cookies = document.cookie.split(/; */);

        for(var i=0;i<cookies.length;i++){
            var data = cookies[i].split('=');
            if(data[0] == 'style'){
                setStyleActive(parseInt(data[1]));
            }
        }
    }
});