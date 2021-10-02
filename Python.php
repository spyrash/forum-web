<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Python</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if(!isset($_GET['id']) or $_GET['id'] != 3 or !is_numeric($_GET['id'])){
    header("Location: Python.php?id=3");
}
?>
   <script type="text/javascript" lang="javascript" src="animScript.js"></script>
   <script type="text/javascript" lang="javascript" src="postControl.js"></script>
 <div class="align-text-top" >

<h1 class="text-uppercase text-success">Linguaggio Python <hr></h1> 
</div>
<div class="row no-gutters">
  
   <div class="col no-gutters">
      <div>
   

       <div class="testo text-xl-left">
         <h1 class="text-uppercase">Python</h1> <hr>
             <p>
             Python è un linguaggio di programmazione di più "alto livello" rispetto alla maggior parte degli altri linguaggi. È orientato a oggetti, ma non in maniera ferrea come ad esempio Java; adatto, tra gli altri usi, a sviluppare applicazioni distribuite, scripting, computazione numerica e system testing.

Fu ideato da Guido van Rossum all'inizio degli anni novanta. Il nome fu scelto per via della passione di van Rossum per i Monty Python e per la loro serie televisiva Monty Python's Flying Circus. Python è spesso paragonato a Ruby, Tcl, Perl, Java, JavaScript, Visual Basic o Scheme.

Spesso viene anche studiato tra i primi linguaggi per la sua somiglianza a uno pseudo-codice. Viene usato spesso anche per simulare la creazione di quei programmi che magari andrebbero attuati in altri linguaggi, ma il testarli in Python permette al programmatore di riordinare le idee a riguardo (come il creare un gioco tramite Pygame o un social-network tramite Flask).
              </p>
              <h1 class="text-uppercase">STORIA</h1> <hr>
              <p>
              E' stato sviluppato dall'olandese Guido van Rossun negli anni Novanta per migliorare il linguaggio Perl. L'intento di van Rossun era di creare un linguaggio potente come il Perl ma più comprensibile e leggibile per l'occhio umano dei programmatori. La sintassi di Python è molto più semplice, questo ne migliora la leggibilità del codice sorgente. L'uso di Python si è diffuso rapidamente nella community globale degli sviluppatori. In poco tempo ha raggiunto la notorietà di altri linguaggi web oriented comed come Java e lo stesso Perl. Nel corso del tempo il linguaggio di programmazione ha beneficiato di una vera e propria evoluzione, soprattutto grazie al fatto d'essere open source. Tutti hanno contribuito a migliorarlo.
          <p class="text-primary text-uppercase">  per altre informazioni riportiamo il seguente <a  class="myAnchor" href="https://it.wikipedia.org/wiki/Python" target="_blank"> LINK</a>.</p></p>
       </div>
      </div>
   </div>   
   <div class="col no-gutters">
   <div>
      <div>
      <img class="langImg" src="immagini/python.jpg">
      </div> 
      <button class="myButton" name="bottoneC">Posta una domanda riguardante Python</button>
                <?php
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) //COME AL SOLITO VEDO SE SONO LOGGATO, SE SI PROCEDO
                {
                    if($_SERVER['REQUEST_METHOD'] != 'POST') //SE ANCORA NON HO INVIATO LA FORM LA MOSTRO
                    {
                    //MA PRIMA FACCIO UNA QUERY CHE PRENDE TUTTI I LINGUAGGI ( CI SERVIRà PER LA SELECT DI DOPO)
                        $query = "SELECT
                        lang_id,
                        lang_name
                        FROM
                        languages
                        WHERE lang_id=' " . pg_escape_string($_GET['id']) . "' ";
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
                            {     //SE è TUTTO OK              
                                echo '<div class="myCode">
                                <form method="post" class="form-signin" action="" name="langPostForm" onSubmit="return validatePost();">
                                TITOLO: <input type="text"  name="topic_subject" class="form-control" autofocus/> </br>
                                LINGUAGGIO:';  
                                echo '<select class="custom-file" name="topic_lang">'; //DOPO LINGUAGGIO FACCIO UNA SELECT
                                $row = pg_fetch_assoc($result);
                                echo '<option value="' . $row['lang_id'] . '">' . $row['lang_name'] . '</option>';
                                echo '</select></br>'; 
                                echo 'CONTENUTO: <textarea  name="post_content" class="form-control" cols="80" rows="6"/></textarea>
                                <button class="btn btn-lg btn-secondary btn-block" type="submit">Posta domanda</button>
                                </form>
                                </div>';
                                //POI METTO IL CONTENUTO DEL TOPIC(DELLA DOMANDA CHE STO FACENDO QUINDI) E IL PULSANTE POSTA DOMANDA 
                                
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
                                    echo '<h3 class="alert alert-secondary" role="alert">TOPIC PUBBLICATO. Controlla in <a class="myAnchor" href="Q&A.php">Q&A</a></h3>';
                                } 
                            }//CHIUSURA ELSE SECONDA QUERY
                        }//CHIUSURA ELSE PRIMA QUERY
                    }//CHIUSURA ELSE HO INVIATO LA FORM
                } //CHIUSURA DELL'IF CHE VEDEVA SE ERO LOGGATO, SE ERO LOGGATO MOSTRAVA TUTTO QUELLO CHE STA SOPRA ALTRIMENTI:
                else {
                    //ALTRIMENTI MOSTRA QUESTO QUANDO PROVI A FARE UNA DOMANDA DA NON LOGGATO
                    echo '<div class="myCode"><h3 class="alert alert-warning" role="alert">Devi essere loggato con <a class="myAnchor" href="login.php">LOGIN</a> per postare, oppure <a class="myAnchor" href="signin.php">ISCRIVITI</a></h3></div>'; 
                } //CHIUSURA DI QUEST'ULTIMO ELSE
                ?>
   </div>
   </div>
</div>
<?php
include 'footer.php'
?>