<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Login</title>
<?php
include 'connect.php';
include 'genericHeader.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{ //SE SIGNED IN è DICHIARATO E SETTATO A TRUE ALLORA SEI LOGGATO
    echo '<div class="alert alert-warning" role="alert">Sei già loggato, puoi fare il <a href="signout.php">LOG OUT</a> se vuoi. </div>';
}
else echo '
    <script type="text/javascript" lang="javascript" src="signinScript.js"></script>
    <form class="form-signin" action="loginQuery.php" method="POST" name="loginForm" onSubmit="return validateLoginForm();">
        <img class="mb-4" id="futaba" src="immagini/futaba_intro.gif" alt="" width="300" height="170"/>
        <h1 class="h3 mb-3 font-weight-normal text-center">Effettua il login</h1>
        <input type="text" name="user_name" class="form-control" placeholder="Username" required autofocus/>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required/>
        <button class="btn btn-lg btn-secondary btn-block" name="signinButton" type="submit">Entra</button>
    </form>';
    
include 'footer.php';
?>

