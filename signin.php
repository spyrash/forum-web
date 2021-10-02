<!DOCTYPE html>
<html>
<head>
<title>CodeToCode - Iscriviti</title>
<?php
include 'connect.php';
include 'genericHeader.php';
?>
    <script type="text/javascript" lang="javascript" src="signinScript.js"></script>
    <form class="form-signin" action="signinQuery.php" method="POST" name="signinForm" onSubmit="return validateSigninForm();">
        <img class="mb-4" id="futaba" src="immagini/futaba_intro.gif" alt="" width="300" height="170"/>
        <h1 class="h3 mb-3 font-weight-norma text-center">Registrati</h1>
        <input type="text" name="user_name" class="form-control" maxlength="30" placeholder="Username" required autofocus /> 
        <input type="email" name="inputEmail" class="form-control" placeholder="Email" required/>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required/>
        <input type="password" name="inputPasswordConfirm" class="form-control" placeholder="Conferma password" required/>
        <button class="btn btn-lg btn-secondary btn-block" name="signinButton" type="submit">Iscriviti</button>
    </form>
<?php
    include 'footer.php';
?>