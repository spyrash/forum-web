<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - C</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if(!isset($_GET['id']) or $_GET['id'] != 1 or !is_numeric($_GET['id'])){ //CONTROLLO SE L'URL HA UN ID E SE L'ID è GIUSTO
    header("Location: C.php?id=1"); //SE NON LO è PER UN MOTIVO O UN ALTRO LO RICONDUCO ALLA PAGINA GIUSTA
}
?>
   <link rel="stylesheet" type="text/css" href="GenericFade.css">
   <script type="text/javascript" lang="javascript" src="animScript.js"></script>
   <script type="text/javascript" lang="javascript" src="fade.js"></script>  
   <script type="text/javascript" lang="javascript" src="postControl.js"></script>
 <div class="align-text-top"> 
 <h1 id="divT" class="text-uppercase text-success">Linguaggio C<hr></h1> 
</div>
<div class="row no-gutters">
    <div id="divS" class="col no-gutters">
      <div>
       <div class="testo text-xl-left"> <!-- PARTE SINISTRA -->
         <h1 class="text-uppercase">C</h1> <hr>
             <p>
              In informatica C è un linguaggio di programmazione imperativo di natura procedurale:
             i programmi scritti in questo linguaggio sono composti da espressioni matematiche e
              da istruzioni imperative raggruppate in procedure parametrizzate in grado di manipolare
               vari tipi di dati.
            Viene definito come un linguaggio di programmazione ad alto livello 
            e integra caratteristiche dei linguaggi di basso livello, ovvero caratteri, numeri e indirizzi,
             che possono essere indicati tramite gli operatori aritmetici e logici di cui si servono le macchine 
             reali. Il C è stato concepito per essere snello e performante, si avvale peraltro di numerose librerie
              per far fronte ad ogni tipo di esigenza, in particolare la libreria standard del C. Tali librerie, sotto 
              forma di file di intestazione o header file con suffisso .h, possono essere caricate mediante la direttiva 
              include del preprocessore.
              </p>
              <h1 class="text-uppercase">STORIA</h1> <hr>
              <p>
              Il linguaggio fu originariamente sviluppato da Dennis Ritchie[5] presso i Bell Labs della AT&T tra il 1969 e il 1973, con lo scopo di utilizzarlo per la stesura del sistema operativo UNIX, precedentemente realizzato da Ken Thompson e Ritchie stesso in assembly del PDP-7. Nel 1972 esordì il primo sistema UNIX su un DEC PDP-11, scritto interamente col nuovo linguaggio di programmazione C.[6] Nel 1978 la pubblicazione del libro Il linguaggio C ne fece crescere rapidamente la diffusione, portando alla nascita di diversi dialetti e dunque alla necessità di definire uno standard.

            La prima standardizzazione del C fu realizzata dall'ANSI nel 1989 (ANSI X3.159-1989), nota come C89. La stessa versione, solo con modifiche di formattazione minime, fu poi standardizzata anche dall'ISO nel 1990 (ISO/IEC 9899:1990), nota come C90. Successivamente l'ISO ha rilasciato altre quattro versioni del linguaggio C, note come C95 (ISO/IEC 9899/AMD1:1995), C99 (ISO/IEC 9899:1999), C11 (ISO/IEC 9899:2011/Cor 1:2012) e C18 (ISO/IEC 9899:2018). Di queste, la C99 ha portato i principali miglioramenti al linguaggio di programmazione, introducendo nuovi tipi di dato, gli inizializzatori designati per gli array, gli array di dimensione variabile ed altri miglioramenti mutuati da C++.
          <p class="text-primary text-uppercase">  per altre informazioni riportiamo il seguente <a  class ="myAnchor" href="https://it.wikipedia.org/wiki/C_(linguaggio)" target="_blank"> LINK</a>.</p></p>
       </div>
      </div>
   </div>   
   <div id="divD" class="col no-gutters"> <!-- PARTE DESTRA -->
   <div>
      <div>
      <img class="langImg" src="immagini/programmare-in-linguaggio-c.png">
      </div> 
            <button class="myButton" name="bottoneC">Posta una domanda riguardante C</button>
                <?php
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) //COME AL SOLITO VEDO SE SONO LOGGATO, SE SI PROCEDO
                {
                    if($_SERVER['REQUEST_METHOD'] != 'POST') //SE ANCORA NON HO INVIATO LA FORM LA MOSTRO
                    {
                    //MA PRIMA FACCIO UNA QUERY CHE PRENDERà IL LINGUAGGIO CORRETTO RISPETTO ALLA PAGINA ( CI SERVIRà PER LA SELECT DI DOPO)
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
                                echo 'non ci sono linguaggi'; // CASO IMPOSSIBILE RIPETO MA POSSIBILE SE CI SONO PROBLEMI COL DB
                            }
                            else
                            {     //SE è TUTTO OK , QUESTO è QUELLO CHE MOSTRO QUINDI :               
                                echo '<div class="myCode">
                                <form method="post" class="form-signin" action="" name="langPostForm" onSubmit="return validatePost();">
                                TITOLO: <input type="text"  name="topic_subject" class="form-control" autofocus/> </br>
                                LINGUAGGIO:';  // METTO UNA CASELLA PER IL TITOLO
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
                            echo 'errore creazione topic';// ERRORE NEL CREARE IL TOPIC(LA DOMANDA)
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
                                echo 'errore inserimento topic' . pg_last_error(); //PG_LAST_ERROR RITORNA L'ERRORE DI POSTGRES 
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
include 'footer.php';
?>