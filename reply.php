<!DOCTYPE html>
<html>
<head>
<?php
include 'connect.php';
include 'genericHeader.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{

    echo 'This file cannot be called directly.(non puoi chiamare direttamente la pagina)';
}
else
{
    if(!isset($_SESSION['signed_in']) or  $_SESSION['signed_in']==false)
    {
        echo '<h3 class="alert alert-warning">Devi essere iscritto ed essere loggato per postare una risposta. Entra con <a class="myAnchor" href="login.php">LOGIN</a></h3>';
    }
    else
    {
        $query = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ( '". pg_escape_string($_POST['replyContent']) ."',
                        NOW(),
                        " . pg_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = pg_query($query);
                         
        if(!$result)
        {
            echo '<h3 class="alert alert-danger"> La tua risposta non è stata registrata, riprova più tardi</h3>';
        }
        else
        {
            $repid= htmlentities($_GET['id']);
            header("Location: topic.php?id=$repid");
        }
    }
}
 
include 'footer.php';
?>