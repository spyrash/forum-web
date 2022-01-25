<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - C++</title>
<?php
include 'connect.php';
include 'genericHeader.php';
if(!isset($_GET['id']) or $_GET['id'] != 2 or !is_numeric($_GET['id'])){
    header("Location: C++.php?id=2");
}
?>
   <link rel="stylesheet" type="text/css" href="GenericFade.css">
   <script type="text/javascript" lang="javascript" src="animScript.js"></script>
   <script type="text/javascript" lang="javascript" src="fade.js"></script>
   <script type="text/javascript" lang="javascript" src="postControl.js"></script>
 <div class="align-text-top" >

<h1 id="divT" class="text-uppercase text-success">Linguaggio C++ <hr></h1> 
</div>
<div class="row no-gutters">
  
  <div id="divS" class="col no-gutters"> <!-- parte sinistra -->
      <div>
   

       <div class="testo text-xl-left">
         <h1 class="text-uppercase">C++</h1> <hr>
             <p>
             In informatica C++ è un linguaggio di programmazione general-purpose, sviluppato in origine da Bjarne Stroustrup nei Bell Labs nel 1983 come evoluzione del linguaggio C inserendo la programmazione orientata agli oggetti, col tempo ha avuto notevoli evoluzioni, come l'introduzione dell'astrazione rispetto al tipo e i funtori.

Il linguaggio venne standardizzato nel 1998 (ISO/IEC 14882:1998 "Information Technology - Programming Languages - C++", aggiornato nel 2003). C++11, conosciuto anche come C++0x, è il nuovo standard per il linguaggio di programmazione C++ che sostituisce la revisione del 2003. Dopo una revisione minore nel 2014 (C++14), l'ultima versione dello standard (nota informalmente come C++17) è stata pubblicata nel 2017.
              </p>
              <h1 class="text-uppercase">STORIA</h1> <hr>
              <p>
              Bjarne Stroustrup iniziò a lavorare al linguaggio nel 1979. L'idea di creare un nuovo linguaggio ebbe origine nelle sue esperienze di programmazione durante la realizzazione della tesi di laurea. Stroustrup trovò che il Simula avesse caratteristiche utili per lo sviluppo di grossi progetti software, ma il linguaggio era troppo lento per l'utilizzo pratico, mentre il BCPL risultava veloce ma troppo a basso livello per lo sviluppo di grosse applicazioni. Quando Stroustrup cominciò a lavorare ai laboratori Bell, gli fu affidato il compito di analizzare il kernel di Unix in ambito di elaborazione distribuita. Ricordandosi del lavoro della tesi, decise di aggiungere al linguaggio C alcune delle caratteristiche di Simula. Fu scelto il C perché era un linguaggio per uso generico portabile e veloce. Oltre al C ed al Simula, si ispirò a linguaggi come l'ALGOL 68, Ada, il CLU ed il linguaggio ML. Inizialmente, le funzionalità di classe, classe derivata, controllo rigoroso dei tipi e argomento di default furono aggiunte al C con Cfront. La prima versione commerciale fu distribuita nell'ottobre del 1985.

Nel 1983 il nome del linguaggio fu cambiato da "C con classi" a C++. Furono aggiunte nuove funzionalità, tra cui funzioni virtuali, overloading di funzioni ed operatori, reference, costanti, controllo dell'utente della gestione della memoria, type checking migliorato e commenti nel nuovo stile ("//"). Nel 1985 fu pubblicata la prima edizione di The C++ programming Language, che fornì un'importante guida di riferimento del linguaggio, che non era ancora stato ufficialmente standardizzato. Nel 1989 fu distribuita la versione 2.0 del C++, le cui novità includono l'ereditarietà multipla, le classi astratte, le funzioni membro statiche, le funzioni membro const, e i membri protetti. Nel 1990 fu pubblicato The Annotated C++ Reference Manual, che fornì le basi del futuro standard. Le ultime aggiunte di funzionalità includono i template, le eccezioni, i namespace, i nuovi tipi di cast ed il tipo di dato booleano.

Così come il linguaggio, anche la libreria standard ha avuto un'evoluzione. La prima aggiunta alla libreria standard del C++ è stata la libreria degli stream di I/O che forniva servizi sostitutivi della libreria C tradizionale (come printf e scanf). In seguito, tra le aggiunte più significative c'è stata la Standard Template Library.

Dopo anni di lavoro, un comitato che presentava membri della ANSI e della ISO hanno standardizzato C++ nel 1998 (ISO/IEC 14882:1998). Per qualche anno seguente alla pubblicazione ufficiale degli standard, il comitato ha seguito lo sviluppo del linguaggio e ha pubblicato nel 2003 una versione corretta dello standard.

Risale al 2005 un report tecnico, chiamato "Technical Report 1" (abbreviato TR1) che, pur non facendo ufficialmente parte dello standard, contiene un numero di estensioni alla libreria standard del C++11.

Non c'è un proprietario del linguaggio C++, che è implementabile senza dover pagare royalty. Il documento di standardizzazione stesso però è disponibile solo a pagamento.
          <p class="text-primary text-uppercase">  per altre informazioni riportiamo il seguente <a  class="myAnchor" href="https://it.wikipedia.org/wiki/C%2B%2B" target="_blank"> LINK</a>.</p></p>
       </div>
      </div>
   </div>   
   <div  id="divD" class="col no-gutters"> <!-- PARTE DESTRA -->
   <div>
      <div>
      <img class="langImg" src="immagini/c-plus-logo.png">
      </div> 
      <button class="myButton" name="bottoneC">Posta una domanda riguardante C++</button>
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
                                echo 'non ci sono linguaggi'; // CASO IMPOSSIBILE 
                            }
                            else
                            {     //SE è TUTTO OK            
                                echo '<div class="myCode">
                                <form method="post" class="form-signin" action="" name="langPostForm" onSubmit="return validatePost();">
                                TITOLO: <input type="text"  name="topic_subject" class="form-control" autofocus/> </br>
                                LINGUAGGIO:';  
                                echo '<select class="custom-file" name="topic_lang">'; 
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
                                    // header("Location: topic.php?id=$topid");
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