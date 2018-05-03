<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$descri = $_POST["description"];
$pos = $_POST["position"];
$pseu = $_POST["pseudo"];

// Modification
$req = mysqli_prepare($db, "UPDATE users SET Description = ? , Position = ?, Pseudo = ? WHERE ID = ?");
mysqli_stmt_bind_param($req, "sssi",$descri, $pos, $pseu, $id);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header('location:profile.php');
?>
