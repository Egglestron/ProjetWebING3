<?php
include("config.php");
$id = $_SESSION["id"];
$idp = isset($_GET["idpost"])?$_GET["idpost"]:null;

$requete = "INSERT INTO jobreacts (ID_Offer, ID_User) VALUES (?, ?)");



$req = mysqli_prepare($db, $requete);
mysqli_stmt_bind_param($req, "ii", $idp, $id);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header("Location: jobs.php");
