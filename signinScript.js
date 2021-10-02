function validateSigninForm() {
    var name = document.signinForm.user_name.value;
    for(var i=0; i<name.length; i++) {
        var currChar = name.charAt(i);
        var cc = currChar.charCodeAt(0);

        if((cc>47 && cc<58) || (cc>64 && cc<91) || (cc>96 && cc<123) || currChar=="_" || currChar=="-" || currChar=="£" || currChar=="$" || currChar=="%" || currChar=="&" || currChar=="#") {
            continue;
        }
        else {
            alert("L'username deve contenere solo caratteri alfanumerici o da questo insieme: _ - £ $ % & #");
            return false;
        }
    }

    if(document.signinForm.inputPassword.value!=document.signinForm.inputPasswordConfirm.value) {
        alert("Password e conferma password devono essere uguali");
        return false;
    }

    alert("Dati inseriti correttamente");
    return true;
}

function validateLoginForm() {
    var name = document.loginForm.user_name.value;
    for(var i=0; i<name.length; i++) {
        var currChar = name.charAt(i);
        var cc = currChar.charCodeAt(0);

        if((cc>47 && cc<58) || (cc>64 && cc<91) || (cc>96 && cc<123) || currChar=="_" || currChar=="-" || currChar=="£" || currChar=="$" || currChar=="%" || currChar=="&" || currChar=="#") {
            continue;
        }
        else {
            alert("L'username deve contenere solo caratteri alfanumerici o da questo insieme: _ - £ $ % & #");
            return false;
        }
    }

    return true;
}

function validateText() {
    if(document.replyForm.replyContent.value=="") {
        alert("Il messaggio di risposta non può essere vuoto");
        return false;
    }
    else return true;
}

function btnControl() {
    if(confirm("Sei sicuro di voler eliminare questo post (può farlo solo l'autore o un admin del forum)?")) {
        return true;
    }
    else return false;
}
function btnControl2() {
    if(confirm("Sei sicuro di voler eliminare questo topic (può farlo solo l'autore o un admin del forum)?")) {
        return true;
    }
    else return false;
}