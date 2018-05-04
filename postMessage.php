<?php
include("config.php");
session_start();

//pour objectposts
$id_User = $_SESSION["id"];
$description = isset($_POST["description"])?$_POST["description"]:null;

if($description == ""){
  $description = null;
}

// Insertion
if((isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])) || !empty($description)){

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

$req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Description) VALUES (?, ?)");
mysqli_stmt_bind_param($req, "is", $id_User, $description);
mysqli_stmt_execute($req);

$lastid = mysqli_insert_id($db);

$target_file = null;

//include a picture
include("uploadPicture.php");

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
exit;
?>
