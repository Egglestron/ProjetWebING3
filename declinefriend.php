<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$idp = isset($_GET['ident'])?$_GET['ident']:null;

// Insertion

$req = mysqli_prepare($db, "DELETE FROM friendships WHERE ID_User1 = ? AND ID_User2 = ?");
mysqli_stmt_bind_param($req, "ii", $id, $idp);
mysqli_stmt_execute($req);

$req = mysqli_prepare($db,  "DELETE FROM friendships WHERE ID_User1 = ? AND ID_User2 = ?");
mysqli_stmt_bind_param($req, "ii", $idp, $id);
mysqli_stmt_execute($req);

echo '<META HTTP-EQUIV=Refresh CONTENT="0.1; URL=profile.php">';
//exit;
?>
