<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Domanda</title>
<?php
include 'connect.php';
include 'genericHeader.php';
?>
<script type="text/javascript" lang="javascript" src="signinScript.js"></script>
<?php
//FACCIO UNA QUERY CHE SELEZIONA IL TOPIC CHIAMATO TRAMITE IL GET ID
$query = "SELECT
 topic_id,
 topic_subject
FROM
 topics
WHERE
    topics.topic_id = " . pg_escape_string($_GET['id']) . "" ;
 
$result = pg_query($query);
 
if(!$result)
{
    echo 'errore nel mostrare il topic' . pg_last_error();  
}
else
{
    if(pg_num_rows($result) == 0)
    {
        echo '<h3 class="alert alert-warning" role="alert">Questa domanda non esiste</h3>'; 
    }
    else
    //SE INVECE ESISTE LA DOMANDA(TOPIC)
    {
        $row = pg_fetch_assoc($result); //prendo il risultato della query
        echo'<div class="divtable">'; // tabella che 
            echo '<table class="table" border="2"> 
            <thead>
            <tr>
            <th  > Pubblicato il </th>
            <th class="w-60"" ><h4> '. htmlspecialchars($row['topic_subject']) .'</h4></th> 
            <th > Da Utente </th>
            <th > Elimina </th>
            </tr>
            </thead>
            <tbody>
            ';// NELLA TABELLA METTO IL TITOLO DEL TOPIC
        
        $idr=$row['topic_id']; //PRENDO L'ID DEL TOPIC E LO METTO IN $idr
        //FACCIO UNA QUERY IN CUI FACCIO NON SOLO JOIN CON GLI USER PER VEDERE CHI HA POSTATO
        // MA ANCHE CON POST_BY=GET ID OVVERO PRENDE SOLO I POST COLLEGATI ALL'ID DELLA PAGINA NEL'URL OVVERO IL TOPIC CORRENTE
        $query = "SELECT
        posts.post_id,
        posts.post_topic,
        posts.post_content,
        posts.post_date,
        posts.post_by,
        users.user_id,
        users.user_name
    FROM
        posts
    LEFT JOIN
        users
    ON
        posts.post_by = users.user_id
    WHERE
        posts.post_topic =  ' " . pg_escape_string($_GET['id']) . "' 
        ORDER BY post_date";
         //CON L'ORDER BY MOSTRO IN ORDINE DI POST E IL PRIMO POST è LA DOMANDA QUINDI LA DOMANDA STARà SEMPRE IN CIMA
        $result = pg_query($query);
         
        if(!$result)
        {
            echo 'NON è STATO POSSIBILE MOSTRARE IL TOPIC.'; 
        }
        else
        {
            if(pg_num_rows($result) == 0)
            {
                echo '</tbody></table><h3 class="alert alert-secondary"> Non ci sono ancora post in questo topic.</h3>';
                echo'      <form  border="1" method="post" action="reply.php?id='.$idr. '" name="replyForm">';//facendo invia risposta andremo su reply.php con id del topic
                echo '<textarea  class="form-control" id="t" rows="4" name="replyContent" onSubmit="return validateText();"></textarea>
                <input class="btn-secondary" type="submit" value="Pubblica Post" />
            
               </form></div>
              ';
            }
            else
            {
            
               //SE LA QUERY VA A BUON FINE E NON è VUOTA
                while($row = pg_fetch_assoc($result)) //CICLO COME AL SOLITO E METTO RIGA PER RIGA DENTRO $row
                {            
                    echo '<tr>';//comincio la riga della tabella
                        echo '<td>';
                        echo date('(d-m-Y) ', strtotime($row['post_date'])); echo'</br>';
                        echo date('(H:i:s) ', strtotime($row['post_date'])); //metto la data e l'ora nel primo campo
                        echo '</td>';
                        echo '<td class="allineo">';
                        echo'<span> ' .htmlspecialchars( $row['post_content']) .' </span>';//nel secondo il contenuto del post
                        echo '</td>';
                        echo'<td>
                        <h6> '. $row['user_name'] .' </h6></td> ';  //e infine chi ha postato
                        echo'<td><form method="POST" action="cancel.php?id='. $row['post_id'] .'" name="cancella" onSubmit="return btnControl();">
                            <input type="submit" class="btn-dark" value="Cancella post" style="overflow-wrap:break-word;" />
                            </form></td>' ; 
                        echo '</tr>'; //chiudo la riga e ricomincio il ciclo
                }
               
         
          echo'</tbody></table>';//chiudo la tabella
           echo'<form border="1" method="post" action="reply.php?id='.$idr. '" name="replyForm" onSubmit="return validateText();">';//facendo invia risposta andremo su reply.php con id del topic
            echo '<textarea  class="form-control" id="t" rows="4" name="replyContent"></textarea>
            <input type="submit" class="btn-secondary" value="Invia Risposta" style="margin-bottom: 20px;"/>
        
           </form></div>
          ';
        
            }
          }

    }
  
}
 
include 'footer.php';
?>