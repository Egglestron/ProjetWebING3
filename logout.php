<?php
session_start();

//Suppression des variables de session et de la session
$_SESSION = array();
if(session_destroy())
{
header("location: login.html");
}
?>
