<?php

include("config.php");
session_start();
$error = "";
// Vérification de la validité des informations

// Hachage du mot de passe
$passwordhash = password_hash($_POST['inputPassword'], PASSWORD_DEFAULT);
$email = $_POST['inputEmail'];
$firstname = $_POST['inputFirstname'];
$lastname = $_POST['inputLastname'];

// Insertion
$req = mysqli_prepare($db,"INSERT INTO users(Email, Passwordhash, Firstname, Lastname) VALUES(?, ?, ?, ?)");
mysqli_stmt_bind_param($req, "ssss", $email, $passwordhash,$firstname,$lastname);
mysqli_stmt_execute($req);
mysqli_stmt_close($req);

header('location: login.html');
?>
