<!DOCTYPE html>
<html>
<head>
<?php
    include 'connect.php';
    include 'genericHeader.php';
    session_destroy();
    header("Location: index.php");
    include 'footer.php';
?>