<!DOCTYPE html>
<html>
<head>
<title>CodeToCode</title>
<?php
    include 'connect.php';
    include 'genericHeader.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "SELECT 
                user_id,
                user_name,
                user_level
            FROM
                users
            WHERE
                user_name = '" . pg_escape_string($_POST['user_name']) . "'   
            AND
                user_pass = '" . sha1($_POST['inputPassword']) . "'";     //SHA 1 CODIFICA LE PASS PG_ESCAPE_STRING RENDE SICURE LE QUERY
         
        $result = pg_query($query);
        if(!$result) {
            echo '<div class="alert alert-danger" role="alert">Qualcosa è andato storto nella query</div>'; 
        }    
        else {//èè
            if(pg_num_rows($result) == 0) {
                echo '<h3 class="alert alert-warning" role="alert">Combinazione username/password errata. Riprova il <a class="myAnchor" href="login.php">LOG IN</a></h3>
                    <img src="immagini/error_meme.webp" id="myImg">';
            }
            else {  //SE NON HO PROBLEMI NELLA QUERY
                $_SESSION['signed_in'] = true; //SETTO SIGNED_IN  A TRUE
                while($row = pg_fetch_assoc($result)) { //CICLO LA QUERY E METTO DENTRO ROW
                        $_SESSION['user_id']    = $row['user_id']; //SETTO USER_ID CON L'USER_ID DELLA QUERY( QUELLO LOGGATO)
                        $_SESSION['user_name']  = $row['user_name'];// STESSA COSA USER NAME
                        $_SESSION['user_level'] = $row['user_level']; //STESSA COSA USER_LEVEL 
                }
                header("Location: index.php");
            } //CHIUSURA ELSE SE NON HO PROBLEMI
        }//CHIUSURA ELSE èè  
    }//CHIUSURA ELSE DELLA QUERY SOPRA
    include 'footer.php';
?>