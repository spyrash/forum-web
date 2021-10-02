function validatePost() {
    if(document.langPostForm.topic_subject.value=="" && document.langPostForm.post_content.value=="") {
        alert("Il post non può avere sia titolo che contenuto vuoti. Riempi i campi");
        return false;
    }
    else if(document.langPostForm.topic_subject.value=="") {
        alert("Attenzione: hai lasciato vuoto il titolo del post");
        return false;
    }
    else if(document.langPostForm.post_content.value=="") {
        alert("Attenzione: hai lasciato vuoto il contenuto del post");
        return false;
    }
    else return true;
}