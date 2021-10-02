<!DOCTYPE html>
<html>
<head>
<title>CodeToCode</title>
<?php
    include 'connect.php';
    include 'genericHeader.php';
?>
      <link rel="stylesheet" type="text/css" href="homeStyle.css">
    <script type="text/javascript" lang="javascript">
        $(document).ready(function(){
            $("#H").fadeIn(1000);
            $(".col-sm-8").fadeIn(2500); 
            });
    </script>

    <div id="H" class="jumbotron text-center">
        <h1>
        Code<i>To</i>Code
        </h1>
    </div>
    <div class="col-sm-8 jumbotron" id="myDiv">
        <h1 class="text-center">Descrizione Forum</h1>
        <div>La programmazione, in informatica, è l'insieme delle attività e tecniche che una o più persone specializzate (team), programmatori o sviluppatori (developer), svolgono per creare un programma o applicazione, ossia un software da far eseguire ad un computer, scrivendo il relativo codice sorgente in un determinato linguaggio di programmazione. 
            Con l'avvento dell'ingegneria del software l'attività di programmazione rappresenta in realtà solo la fase implementativa dell'intero ciclo di sviluppo del software con l'obiettivo ultimo di soddisfare le specifiche funzionali richieste dal committente secondo una predefinita analisi strutturale del progetto software. Assieme al lato sistemistico e al data science, costituisce il ramo o filone di produttività in informatica aziendale, detto terziario avanzato.
            <br>
            Ma programmare non è sempre facile e immediato; anzi, per scrivere il codice di molte applicazioni spesso si riscontrano errori di compilazione, di esecuzione oppure l'output non è quello desiderato. Per questo vengono in aiuto dei programmatori forum dedicati, proprio come <i>CodeToCode</i>.
            <br>
            Iscriviti e inizia a postare usando la barra di navigazione qui sopra!
        </div>
    </div>
<?php
    include 'footer.php';
?>