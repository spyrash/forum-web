<!DOCTYPE html>
<html>
<head>
<title>CodeToCode</title>
<?php
    include 'connect.php';
    include 'genericHeader.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" . pg_escape_string($_POST['user_name']) . "', /*pg_escape_string è per le sql injections*/
                       '" . sha1($_POST['inputPassword']) . "',/*sha1 crypta la pass */
                       '" . pg_escape_string($_POST['inputEmail']) . "',
                        NOW(), /* NOW() prende il tempo attuale*/
                        0)";
                         
        $result = pg_query($query);
        if(!$result){
            echo '<div class="alert alert-danger" role="alert">Qualcosa è andato storto nella query</div>';
        }
        else
        {
         echo '<div class="alert alert-success" role="alert"> Registrazione avvenuta con successo. Ora puoi fare il <a class="myAnchor" href="login.php">LOG IN</a> e iniziare a postare!</div>';
        }
    }
    include 'footer.php';
?>