<?php
include("config.php");
session_start();

//pour objectposts
$id_User = $_SESSION["id"];
$Url_Media = isset($_POST["Url_Media"])?$_POST["Url_Media"]:null;
$description = isset($_POST["description"])?$_POST["description"]:null;

//pour envoyer un message a la bonne discussion
if(!empty($_POST["idDiscussion"])){
  $idDiscussion = $_POST["idDiscussion"];
}
else {
  $idUser2 = $_SESSION["idUser"];
  $firstname2 = $_SESSION['firstname'];
  $lastname2 = $_SESSION['lastname'];

  $name2 = $firstname2." ".$lastname2;
  echo "2 : $name2";

  $req = mysqli_prepare($db, "SELECT FirstName, Lastname FROM users WHERE ID = ?");
  mysqli_stmt_bind_param($req, "i", $id_User);
  mysqli_stmt_execute($req);

  mysqli_stmt_store_result($req);

  mysqli_stmt_bind_result($req, $firstname, $lastname);

  while(mysqli_stmt_fetch($req)){
    $name = $firstname." ".$lastname;
  }

  echo "1 : $name";

  $req = mysqli_prepare($db, "INSERT INTO chatgroups (ID_User, Name) VALUES (?, ?);");
  mysqli_stmt_bind_param($req, "is", $idUser2, $name);
  mysqli_stmt_execute($req);

  $lastid = mysqli_insert_id($db);
  $idDiscussion = $lastid;

  $req = mysqli_prepare($db, "INSERT INTO chatgroups (ID, ID_User, Name) VALUES (?, ?, ?);");
  mysqli_stmt_bind_param($req, "iis", $lastid, $id_User, $name2);
  mysqli_stmt_execute($req);

}

// Insertion
if(!empty($description) || !empty($Url_Media)){
$req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Url_Media, Description) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($req, "iss", $id_User, $Url_Media,$description);
mysqli_stmt_execute($req);

$lastid = mysqli_insert_id($db);

$req = mysqli_prepare($db, "INSERT INTO chatmessages (ID_Conv, ID_Post) VALUES(?, ?)");
mysqli_stmt_bind_param($req, "ii", $idDiscussion, $lastid);
mysqli_stmt_execute($req);

$req = mysqli_prepare($db, "UPDATE chatgroups SET Notif = 'new' WHERE ID = ? AND ID_User != ?");
mysqli_stmt_bind_param($req, "ii", $idDiscussion, $id_User);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);
}

//echo "<meta http-equiv=\"refresh\" content=\"0\"> ";
header("Location: {$_SERVER['HTTP_REFERER']}");
//exit;
?>
