<?php

include("config.php");
session_start();
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form

$req = mysqli_prepare($db, "SELECT id, passwordhash FROM users WHERE email = ?");
mysqli_stmt_bind_param($req, "s", $_POST['inputEmail']);
mysqli_stmt_execute($req);

mysqli_stmt_store_result($req);

mysqli_stmt_bind_result($req, $colID, $colPasswordhash);


$isPasswordCorrect = false;

while(mysqli_stmt_fetch($req)){

if(password_verify($_POST['inputPassword'], $colPasswordhash)){
    $isPasswordCorrect = true;
    $_SESSION['id'] = $colID;
    //echo $colID;
    break;
}

}


    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['email'] = $mymail;
        header("location: welcome.php");
    }
    else {
      //echo $phash;

        header("location: login.html");
    }

}
?>
