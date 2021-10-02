<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Cancella Post</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{

    echo 'This file cannot be called directly.(non puoi chiamare direttamente questa pagina)';
}
else
{
    //vede se loggato
    if(!isset($_SESSION['signed_in']) or  $_SESSION['signed_in']==false)
    {
        echo '<h3 class="alert alert-warning">Devi essere <a href="signin.php">ISCRITTO</a> ed essere <a href="login.php">LOGGATO</a> per cancellare un post.TORNA AL 
        <a class="myAnchor" href="Q&A.php">Q&A PRECEDENTE</a></h3>';
    }
    else
    { 
        $query="SELECT post_topic,
                       post_by
        FROM posts
        WHERE post_id= ' " . pg_escape_string($_GET['id']) . "' ";
       $result = pg_query($query);
     
       if(!$result)
      {
      echo 'NON è STATO POSSIBILE RITROVARE IL TOPIC.'; 
      }
       else{ 
        $row = pg_fetch_assoc($result);
        $topicid=$row['post_topic'];


        if($_SESSION['user_id']==$row['post_by'] or $_SESSION['user_level']=="1")
        {
         $query="DELETE FROM posts
          WHERE post_id= ' " . pg_escape_string($_GET['id']) . "' ";
        
        $result = pg_query($query);
         
        if(!$result)
         {
            echo 'NON è STATO POSSIBILE CANCELLARE IL TOPIC.'; 
         }
         else{
            header("Location: topic.php?id=$topicid");
         }
        
}
else{
    echo '<h3 class="alert alert-warning" role="alert"> Per eliminare il post devi essere o colui che lo ha postato o un admin del forum. TORNA AL 
                <a class="myAnchor" href="topic.php?id=' . $topicid . '">TOPIC PRECEDENTE</a></h3>';
}
    }
}
}
include 'footer.php';
?>