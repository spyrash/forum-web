<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Q&A generale</title>
<?php
include 'connect.php';
include 'genericHeader.php';
?>

<link rel="stylesheet" type="text/css" href="GenericFade.css">
  <script type="text/javascript" lang="javascript" src="signinScript.js"></script>
  <script type="text/javascript" lang="javascript" src="ColoraTabella.js"></script>
  <script type="text/javascript" lang="javascript" src="tabellaselect.js"></script>
  <script type="text/javascript" lang="javascript" src="fade.js"></script>
<?php
$num_elem_pagine=4; //limito per le pagine
//FACCIO SUBITO UNA QUERY IN CUI JOINO TOPICS,USERS E LANGUAGES CORRELATI TRA LORO
$query = "SELECT
  users.user_name,
   topics.topic_id,
   topics.topic_subject,
   topics.topic_date,
   topics.topic_lang,
   topics.topic_by,
   languages.lang_name
  FROM
   topics
    JOIN 
   languages
   on
   topics.topic_lang=languages.lang_id 
    JOIN
   users
   on
   topics.topic_by=users.user_id
   WHERE
   topics.topic_lang=languages.lang_id AND topics.topic_by=users.user_id
   ORDER BY topics.topic_date DESC LIMIT $num_elem_pagine "; 
$result = pg_query($query);
if(!$result)
{
    echo '<p> ERRORE QUERY TOPICS</p>';
}
else
{
  if(pg_num_rows($result) == 0)
  {
      echo'<br><br>
        <div id="div2" class="alert alert-dark display-4">Non esistono topic<br>  
        PROVA FAI UNA <a class="myAnchor" href="creadomanda.php">DOMANDA</a> ANCHE TU!</div>';//QUESTO è IL CASO NON CI SIANO TOPIC ( DOMANDE)
  }
  else{
    //SE CI SONO DOMANDE INVECE DICHIARO UNA TABELLA E SETTO I TITOLI
        //IL COL-SM A QUANTO HO CAPITO PRENDE TOT COLONNE DELLA PAGINA
        echo '<br><br><div id="div2" class="alert alert-dark display-4">PROVA, FAI UNA <a class="myAnchor" href="creadomanda.php">DOMANDA</a> ANCHE TU!</div>';
        
        echo'<div id="div1" class="divtable" >
        <select onchange="selectTab();" id="mySelect" class="custom-select">
                  <option value="Tutti">Tutti</option>
                  <option value="C">C</option>
                  <option value="C++">C++</option>
                  <option value="Java">Java</option>
                  <option value="JavaScript">JavaScript</option>
                  <option value="Python">Python</option>
                  <option value="Scala">Scala</option>
              </select>
    <table id="postab" class="table" border="2"> 
    <thead>
    <tr title="Intest">
    <th scope="col"> Linguaggio </th>
    <th class="w-35" scope="col"> Titolo </th>
    <th scope="col"> Pubblicato il </th>
    <th scope="col"> Da utente </th>
    <th scope="col"> Cancella </th>
    </tr>
    </thead>
    <tbody>'; 
    $var=0;
    $count=0; //variabili che forse servono per limitare
    
    while($row = pg_fetch_assoc($result)){ //CICLO LA QUERY DELLE DOMANDE E A OGNI CICLO METTO UN RIGA IN ROW E METTO TUTTO NELLA TABELLA
    //OSS: TR=TABLE-ROW TD=TABLE-DATA TH=TABLE-HEADER
    
                
                               
                    echo '<tr class="riga" onmouseover="myFunction(this)" onmouseout="myFunction1(this)" title="'. $row['lang_name'] . '"> ';
                  
                    echo '<td> <h4><a class="myAnchor" href="'. $row['lang_name'] . '.php" </a> '. $row['lang_name'] . '</h4></td>';//NEL PRIMO CAMPO METTO IL NOME LINGUAGGIO DELLA RIGA ATTUALE DELLA QUERY
                        echo '<td >';
                            echo '<h4><a class="myAnchor" href="topic.php?id=' . $row['topic_id'] . '">' .htmlspecialchars ($row['topic_subject']) . '</a><h4>';//METTO IL TITOLO DEL TOPIC COME LINK AL SUO ID IL LINK PORTA A TOPIC.PHP SE VEDI
                        echo '</td>';
                        echo '<td>';
                        echo date('(d-m-Y) ', strtotime($row['topic_date'])); echo'</br>';// QUA METTO DATA E SOTTO ORA 
                        echo date('(H:i:s) ', strtotime($row['topic_date']));
                          echo '</td>';
                          echo'<td>
                          <h4>'. $row['user_name'] .' </h4> 
                          </td>';//E ALLA FINE METTO L'USER_NAME DI CHI HA FATTO LA DOMANDA
                          echo'<td><form method="POST" action="canceltopic.php?id='. $row['topic_id'] .'" name="cancella" onSubmit="return btnControl2();">
                          <input type="submit" class="btn-dark" value="Cancella" />
                          </form></td>' ; 
                          echo '</tr>';//CHIUDO LA RIGHA DELLA TABELLA E RICOMINCIO IL WHILE
               
              
            }
            
              echo'<nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#" onClick="'. $num_elem_pagine=10 .'">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" onclick=" ' . $num_elem_pagine=10 .'">Next</a>
                </li>
              </ul>
            </nav>';
 
                echo '</tbody></table></div>';
                echo'<nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" onclick=" ' . $num_elem_pagine=10 .'">Next</a>
                </li>
              </ul>
            </nav>';// CHIUDO IL DIV DELLA TABELLA E MESSO IL PROVA FAIN UNA DOMADA, ABBELLIBILE INOLTRE NON SO PERCHè LO METTE SOPRA LA TABELLA :DD
  }// CHIUSURA ELSE LA QUERY NON ERA VUOTA
}// CHIUSURA ELSE LA QUERY ANDAVA A BUON FINE
//OSS: IL PROVA FAI UNA DOMANDA TI PORTA A CREDOMANDA.PHP
include 'footer.php';
?>