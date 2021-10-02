<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Crea Domanda</title>
<?php
//create_topic.php
include 'connect.php';
include 'genericHeader.php';
?>
<script type="text/javascript" lang="javascript" src="postControl.js"></script>

<?php
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) //COME AL SOLITO VEDO SE SONO LOGGATO, SE SI PROCEDO
{
    if($_SERVER['REQUEST_METHOD'] != 'POST') //SE ANCORA NON HO INVIATO LA FORM LA MOSTRO
    {
        
        $query = "SELECT
        lang_id,
        lang_name
    FROM
        languages";
         $result = pg_query($query);
         
         if(!$result)
         {
             //FALLITA LA QUERY MOSTRO ERRORE
             echo 'Errore a prendere i languaggi dal db, prova più tardi'; 
            }
            else{
                //SE NON è FALLITA LA QUERY
            if(pg_num_rows($result) == 0) //SE I LINGUAGGI NELLA TABELLA LINGUAGGI SONO ZERO
            {
                //caso impossibile poichè ci sono già i linguaggi nella tabella lang
                
                    echo 'non ci sono linguaggi'; 
                }
                else
                {                  
                echo '<div class="jumbotron">
                <form method="post" class="form-signin" action="" name="langPostForm" onSubmit="return validatePost();">
                TITOLO: <input type="text"  name="topic_subject" class="form-control" autofocus/> </br>
                LINGUAGGIO:';  
             
               echo '<select class="custom-select" name="topic_lang">'; //DOPO LINGUAGGIO FACCIO UNA SELECT
                while($row = pg_fetch_assoc($result)) //CICLO LA QUERY DEI LINGUAGGI E LI METTO COME OPZIONI DELLA SELECT
                {
                    echo '<option value="' . $row['lang_id'] . '">' . $row['lang_name'] . '</option>';
                }//CHIUDO CICLO
               echo '</select></br>'; 
                 
               echo 'CONTENUTO: <textarea name="post_content" class="form-control" cols="80" rows="8"/></textarea>
                              <button class="btn btn-lg btn-secondary btn-block" type="submit">Posta domanda</button>
                </form>
                </div>';
                //POI METTO IL CONTENUTO DEL TOPIC(DELLA DOMANDA CHE STO FACENDO QUINDI) E IL PULSANTE POSTA DOMANDA 
                //IL TEXTAREA LO VORREI UN Pò PIù GRANDE SIA IN LARGHEZZA CHE ALTEZZA
                }//CHIUDO ELSE TUTTO OK
                  

        }//CHIUDO ELSE NON è FALLITA LA QUERY

    }//CHIUDO IL IF NON HO ANCORA INVIATO LA FORM
    else       
    //QUINDI SE INVIO LA FORM FACCIO LA ROBA SOTTO
    {
    //inizio la transizione
    $query  = "BEGIN WORK;";
        $result = pg_query($query);
        
        if(!$result)
        {
            echo 'errore creazione topic';
        }
        else
        //SE NON DA ERRORI
        {
     
            //abbiamo postato il form, salviamolo.
            //inseriamo prima il topic(la domanda) e poi il post(contenuto) NELLE RISPETTIVE TABELLE

           
           $query = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,  
                               topic_lang,
                               topic_by)
                   VALUES
                        ('" . pg_escape_string($_POST['topic_subject']) . "',
                               NOW(),
                               " . pg_escape_string($_POST['topic_lang']) . ",
                              " . $_SESSION['user_id'] . " )
                RETURNING topic_id";
                             //QUI FACCIO UNA QUERY E INSERISCO IN TOPICS I CAMPI DELLA FORM PRECEDENTE
                             //DOPO L'INSERT FACCIO ANCHE UN RETURN DEL TOPIC_ID(QUELLO APPENNA IMMESSO)
                $result = pg_query($query);
            $topid= pg_fetch_assoc($result)['topic_id']; //METTO IL TOPIC_ID APPENNA IMMESSO NELLA VARIABILE $topid
         
            if(!$result)
            {
                echo 'errore inserimento topic' . pg_last_error();
                $query = "ROLLBACK;"; // RITORNA AL BEGIN DI SOPRA
                $result = pg_query($query);
            }
            else    //SE LA QUERY PER INSERIRE IL TOPIC NON HA DATO PROBLEMI PROSEGUO PER QUELLA DI INSERIMENTO DI POSTS
            {
                //ora inseriamo post    (OVVERO IL CONTENUTO DELLA DOMANDA DELLA FORM PRECENDENTE)        
                $query = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                    VALUES
                            ('" . pg_escape_string($_POST['post_content']) . "',
                                  NOW(),
                                  $topid ,
                                  " . $_SESSION['user_id'] . "
                            )"; 
                $result = pg_query($query);
                 
                if(!$result)
                {
                    echo 'errore inserimento post' . pg_last_error();
                    $query = "ROLLBACK;";
                    $result = pg_query($query);
                }
                else
                {
                    $query = "COMMIT;"; // FINISCE LA TRANSAZIONE QUELLA COMINCIATA CON BEGIN
                    $result = pg_query($query);
                    header("Location: topic.php?id=$topid");
                   
                } 
            }//CHIUSURA ELSE SECONDA QUERY
        }//CHIUSURA ELSE PRIMA QUERY
    }//CHIUSURA ELSE HO INVIATO LA FORM
} //CHIUSURA DELL'IF CHE VEDEVA SE ERO LOGGATO, SE ERO LOGGATO MOSTRAVA TUTTO QUELLO CHE STA SOPRA ALTRIMENTI:
else {
      //ALTRIMENTI MOSTRA QUESTO QUANDO PROVI A FARE UNA DOMANDA DA NON LOGGATO
    echo '<h3 class="alert alert-warning" role="alert">Devi essere loggato con <a class="myAnchor" href="login.php">LOGIN</a> per postare, oppure <a class="myAnchor" href="signin.php">ISCRIVITI</a></h3>'; 
} //CHIUSURA DI QUEST'ULTIMO ELSE
include 'footer.php';
?>