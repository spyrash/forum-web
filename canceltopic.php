<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Cancella Domanda</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{

    echo 'This file cannot be called directly.(NON PUOI CHIAMARE DIRETTAMENTE LA PAGINA)';
}
else
{   
    if(!isset($_SESSION['signed_in']) or  $_SESSION['signed_in']==false)
    {
        echo '<h3 class="alert alert-warning" role="alert">Devi essere loggato per cancellare una domanda. Torna al <a class="myAnchor" href="Q&A.php">Q&A</a></h3>';
    }
    else
    { 
        $query="SELECT topic_id,
                       topic_by
        FROM topics
        WHERE topic_id= ' " . pg_escape_string($_GET['id']) . "' ";
       $result = pg_query($query);
       if(!$result)
       {
       echo 'NON è STATO POSSIBILE RITROVARE IL TOPIC.'; 
       }
        else{ 
            $row = pg_fetch_assoc($result);
        if($_SESSION['user_id']==$row['topic_by'] or $_SESSION['user_level']=="1")
       {
        $query="DELETE FROM topics
        WHERE topic_id= ' " . pg_escape_string($_GET['id']) . "' ";
       
       $result=pg_query($query);
       if(!$result)
       {
          echo 'NON è STATO POSSIBILE CANCELLARE IL TOPIC. QUERY FALLITA'; 
       }
       else{
        header("Location: Q&A.php"); 
       }
       } 
       else{
        echo '<h3 class="alert alert-warning" role="alert"> Non puoi eliminare questo topic, devi essere colui che lo ha postato o un admin del forum. TORNA AL <a class="myAnchor" href="Q&A.php">Q&A</a></h3>';
    }
}
}
}
include 'footer.php';
?>
     