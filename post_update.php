<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$descri = $_POST["description"];
$pos = $_POST["position"];

// Insertion
$req = mysqli_prepare($db, "UPDATE users us SET Description = ? , Position = ? WHERE us.ID = ?");
mysqli_stmt_bind_param($req, "ssi",$descri, $pos, $id);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header('location:profile.php');
?>
