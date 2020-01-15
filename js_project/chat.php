<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Chat</title>
</head>
<body>

    <div class="form chat">
        <div class="chat_group">
            <input type="checkbox" id="chat_activate">
            <label for="chat_active">Akywacja chatu</label>
        </div>
        <div class = "form_group">
            <textarea class="chat_room" disabled></textarea>
        </div>
        <form class="chat_form">
            <div class="form_group">
                <label for="nick">Nazwa użytkownika:</label>
                <input id="nick" name="nick" type="text" disabled>
            </div>
            <div class="form_group">
                 <label for="message">Wiadomość:</label>
                 <textarea id="message" name="message" class="chat_message" disabled></textarea>
            </div>
            <div class="form_group">
                <button role="submit" class="chat_send" disabled>Wyślij</button>
            </div>
        </form>
    </div>
    <script src="./chat.js"></script>
</body>
</html> 



