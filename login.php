<?php

include("config.php");
session_start();
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form

$myusername=addslashes($_POST['email']);
$mypassword=addslashes($_POST['password']);


$req= $bdd->prepare('SELECT id, password FROM users WHERE email='$myemail'');
$req-> execute(array('email'=>$myemail));
$result=$req->fetch();

$isPasswordCorrect = password_verify($_POST['pass'], $result['pass']);

if (!$result)
{
    header("location: log_page.html");
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $mymail;
        header("location: welcome.php");
    }
    else {
        header("location: log_page.html");
    }
}
?>
