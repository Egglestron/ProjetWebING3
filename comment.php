<?php
include("config.php");

if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}

if(empty($_POST["description"])){
  header('location:index.php');
  exit;
}

//pour objectposts
$id_User = $_SESSION['id'];
$Url_Media = isset($_POST["Url_Media"])?$_POST["Url_Media"]:null;
$description = isset($_POST["description"])?$_POST["description"]:null;

//pour comments
$id_Post = $_POST["idpost"];

// Insertion
$req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Url_Media, Description) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($req, "iss", $id_User, $Url_Media,$description);
mysqli_stmt_execute($req);

$lastid = mysqli_insert_id($db);

$req = mysqli_prepare($db, "INSERT INTO comments (ID_Object, ID_Post) VALUES(?, ?)");
mysqli_stmt_bind_param($req, "ii", $lastid, $id_Post);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

//echo "<meta http-equiv=\"refresh\" content=\"0\"> ";
header("Location: index.php");
exit;
?>
