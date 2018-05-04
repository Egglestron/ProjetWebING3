<?php
include("config.php");
session_start();

//pour objectposts
$id = $_SESSION['id'];
$idp = isset($_GET['ident'])?$_GET['ident']:null;

// Insertion

$req = mysqli_prepare($db, "DELETE FROM friendships WHERE (ID_User1 = ? AND ID_User2 = ?) OR (ID_User1 = ? AND ID_User2 = ?)");
mysqli_stmt_bind_param($req, "iiii", $id, $idp, $idp, $id);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
