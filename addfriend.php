<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$idp = isset($_GET['ident'])?$_GET['ident']:null;
$relation = isset($_GET['rel'])?$_GET['rel']:null;

// Insertion
$req = mysqli_prepare($db, "INSERT INTO friendships (ID_User1, ID_User2, Status, Relationship) VALUES (?, ?, 'Request sent', ?), (?, ?, 'Waiting', ?)");
mysqli_stmt_bind_param($req, "iisiis", $id, $idp, $relation, $idp, $id, $relation);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header("Location: {$_SERVER['HTTP_REFERER']}");
//exit;
?>
