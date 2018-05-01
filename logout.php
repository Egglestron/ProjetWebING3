<?php
session_start();

//Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
if(session_destroy())
{
header("location: log_page.html");
}
?>
