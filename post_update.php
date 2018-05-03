<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$descri = isset($_POST["description"])?$_POST["description"]:null;
$pos = isset($_POST["position"])?$_POST["position"]:null;
$pseu = isset($_POST["pseudo"])?$_POST["pseudo"]:null;

// Modification
$req = mysqli_prepare($db, "UPDATE users SET Description = ? , Position = ?, Pseudo = ? WHERE ID = ?");
mysqli_stmt_bind_param($req, "sssi",$descri, $pos, $pseu, $id);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header('location:profile.php');
?>
