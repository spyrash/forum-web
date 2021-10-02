<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Java</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if(!isset($_GET['id']) or $_GET['id'] != 4 or !is_numeric($_GET['id'])){
    header("Location: Java.php?id=4");
}
?>
   <script type="text/javascript" lang="javascript" src="animScript.js"></script>
   <script type="text/javascript" lang="javascript" src="postControl.js"></script>
 <div class="align-text-top" >

<h1 class="text-uppercase text-success">Linguaggio Java<hr></h1> 
</div>
<div class="row no-gutters">
  
   <div class="col no-gutters">
      <div>
   

       <div class="testo text-xl-left">
         <h1 class="text-uppercase">Java</h1> <hr>
             <p>
             In informatica Java è un linguaggio di programmazione ad alto livello, orientato agli oggetti e a tipizzazione statica, che si appoggia sull'omonima piattaforma software di esecuzione, specificamente progettato per essere il più possibile indipendente dalla piattaforma hardware di esecuzione (tramite compilazione in bytecode prima e interpretazione poi da parte di una JVM) (sebbene questa caratteristica comporti prestazioni in termini di computazione inferiori a quelle di linguaggi direttamente compilati come C e C++ ovvero dunque perfettamente adattati alla piattaforma hardware).
              </p>
              <h1 class="text-uppercase">STORIA</h1> <hr>
              <p>
              Java è stato creato a partire da ricerche effettuate alla Stanford University agli inizi degli anni novanta. Nel 1992 nasce il linguaggio Oak (in italiano "quercia"), prodotto da Sun Microsystems e realizzato da un gruppo di esperti sviluppatori capitanati da James Gosling. Questo nome fu successivamente cambiato in Java per problemi di copyright: il linguaggio di programmazione Oak esisteva già.

Per facilitare il passaggio a Java ai programmatori old-fashioned, legati in particolare a linguaggi come il C++, la sintassi di base (strutture di controllo, operatori ecc.) è stata mantenuta pressoché identica a quella del C++; tuttavia a livello di linguaggio non sono state introdotte caratteristiche ritenute fonte di complessità non necessaria e che favoriscono l'introduzione di determinati bug durante la programmazione, come l'aritmetica dei puntatori e l'ereditarietà multipla delle classi. Per le caratteristiche orientate agli oggetti del linguaggio ci si è ispirati al C++ e soprattutto all'Objective C.

In un primo momento Sun decise di destinare questo nuovo prodotto alla creazione di applicazioni complesse per piccoli dispositivi elettronici; fu solo nel 1993 con l'esplosione di internet che Java iniziò a farsi notare come strumento per iniziare a programmare per internet.

Contemporaneamente Netscape Corporation annunciò la scelta di dotare il suo allora omonimo e celeberrimo browser della Java Virtual Machine (JVM). Questo segna una rivoluzione nel mondo di Internet: grazie agli applet le pagine web diventarono interattive a livello client, ovvero le applicazioni vengono eseguite direttamente sulla macchina dell'utente di internet e non su un server remoto. Per esempio gli utenti poterono utilizzare giochi direttamente sulle pagine web e usufruire di chat dinamiche e interattive.

Java fu annunciato ufficialmente il 23 maggio 1995 a SunWorld.

Il 13 novembre 2006 la Sun Microsystems ha distribuito la sua implementazione del compilatore Java e della macchina virtuale sotto licenza GPL. Non tutte le piattaforme Java sono libere. L'ambiente Java libero si chiama IcedTea.

L'8 maggio 2007 Sun ha pubblicato anche le librerie, tranne alcuni componenti non di sua proprietà, sotto licenza GPL, rendendo Java un linguaggio di programmazione la cui implementazione di riferimento è libera.

Il linguaggio è definito da un documento chiamato The Java Language Specification, spesso abbreviato JLS. La prima edizione del documento è stata pubblicata nel 1996. Da allora il linguaggio ha subito numerose modifiche e integrazioni, aggiunte di volta in volta nelle edizioni successive. A fine 2018 la versione più recente delle specifiche è la Java SE 11 Edition.
          <p class="text-primary text-uppercase">  per altre informazioni riportiamo il seguente <a  class="myAnchor" href="https://it.wikipedia.org/wiki/Java_(linguaggio_di_programmazione)" target="_blank"> LINK</a>.</p></p>
       </div>
      </div>
   </div>   
   <div class="col no-gutters">
   <div>
      <div>
      <img class="langImg" src="immagini/java.png">
      </div> 
      <button class="myButton" name="bottoneC">Posta una domanda riguardante Java</button>
                <?php
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) //COME AL SOLITO VEDO SE SONO LOGGATO, SE SI PROCEDO
                {
                    if($_SERVER['REQUEST_METHOD'] != 'POST') //SE ANCORA NON HO INVIATO LA FORM LA MOSTRO
                    {
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