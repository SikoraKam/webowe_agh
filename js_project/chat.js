var poll = null;
var nickIn = document.querySelector('#nick');
var messageIn = document.querySelector('#message');
var send = document.querySelector('.chat_send');
var chatForm = document.querySelector('.chat_form');
var checkbox = document.querySelector('#chat_activate');
var chatRoom = document.querySelector('.chat_room');

checkbox.addEventListener('change',changeCheckbox);
chatForm.addEventListener('submit',submitMessage);

//do wlaczania checkboxa
function changeCheckbox(event){
    activateChat(event.target.checked);
}

//wlaczamy badz wylaczamy elementy
// if enabled to pobieramy wiadomosci i uruchamiamy long-polling
//else odlaczamy sie, usuwamy wiadomosci, zamykamy long-polling
function activateChat(enabled){
    nickIn.disabled = !enabled;
    messageIn.disabled = !enabled;
    send.disabled = !enabled;

    if(enabled){
        fetchCurrentMessages();
        getMessages();
    }
    else{
        setChatText('');
        poll.abort(); //?
    }
}

//zapytanie do chatGet.php z parametrem fetch=true, dzieki temu skrypt odrazu pobierze wszytskie wiadomosci
function fetchCurrentMessages(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','chatPoll.php?fetch=true');
    xhr.send();

    //po odebraniu odpowiedzi
    xhr.onload = function(){
        if(xhr.status != 200){ 
            alert('Błąd' + xhr.status + ': ' + xhr.statusText);
        }
        else{
            setChatText(xhr.responseText);
        }
    };

    xhr.onerror = function(){
        alert('Bład wysyłania')
    };
}

function setChatText(messages){
    chatRoom.value = messages;
}

function submitMessage(event){
    event.preventDefault();

    if(!nickIn.value || !messageIn.value){
        alert('Puste pola nick lub wiadomosc');
        return;
    }

    var formData = new FormData(event.target);
    var xhr = new XMLHttpRequest();

    xhr.open('POST','chatPost.php');
    xhr.send(formData);

    chatRoom.value += nickIn.value + ': ' + messageIn.value;

    messageIn.value = '';
}

function getMessages(){
    poll = new XMLHttpRequest();
    poll.open('GET','chatPoll.php');
    poll.send();

    poll.onload = function(){
        if(poll.status != 200){
            alert('Blad' + poll.status + ':' + poll.statusText);
        }
        else{
            //ustawienie wiadomosci w chatboxe
            setChatText(poll.responseText);
            //ponowne połączenie
            getMessages();
        }
    };

    poll.onerror = function(){
        alert('Błąd wysyłania');
    };
}







