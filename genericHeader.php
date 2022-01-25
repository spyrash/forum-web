        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="CodeToCode forum"/>
        <meta name="keywords" content="CodeToCode, programmazione, coding issues, problemi con codice"/>    
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="forumStyle.css"> 
        <script src="js/bootstrap.min.js"></script> 
    </head>
    <body>
        <div class="nav-bar">
            <a href="index.php">HOME</a>

                    <a href="C.php?id=1">C</a>
                    <a href="C++.php?id=2">C++</a>
                    <a href="Java.php?id=4">JAVA</a>
                    <a href="JavaScript.php?id=5">JAVASCRIPT</a>
                    <a href="Python.php?id=3">PYTHON</a>
                    <a href="Scala.php?id=6">SCALA</a>
                    <a href="Q&A.php">Q&A</a>
 
            <?php
            session_start();//QUESTO CREA O RIPRENDE SE GIA CREATA UNA SESSIONE E CON SE PRENDE I METODI GET E POST CHE USEREMO
            if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
             echo '<a href="signout.php">LOG OUT</a><div id="logDiv">Benvenuto ' . $_SESSION['user_name'] . '. Non sei tu?</div>';
            }
            else {

                echo '<a href="login.php">LOGIN</a> <a href="signin.php">ISCRIVITI</a>.';
            }
            ?>
        </div>
   
     
