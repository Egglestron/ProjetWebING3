<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$idp = isset($_GET['ident'])?$_GET['ident']:null;
$relation = isset($_GET['rel'])?$_GET['rel']:null;

// Insertion
$req = mysqli_prepare($db, "INSERT INTO friendships (ID_User1, ID_User2, Status, Relationship) VALUES (?, ?, 'Request sent', ?)");
mysqli_stmt_bind_param($req, "iis", $id, $idp, $relation);
mysqli_stmt_execute($req);

$req = mysqli_prepare($db, "INSERT INTO friendships (ID_User1, ID_User2, Status, Relationship) VALUES (?, ?, 'Waiting', ?)");
mysqli_stmt_bind_param($req, "iis", $idp, $id, $relation);
mysqli_stmt_execute($req);

echo '<META HTTP-EQUIV=Refresh CONTENT="0.1; URL=profile.php">';
//exit;
?>
