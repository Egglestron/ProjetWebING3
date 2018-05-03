<?php
include("config.php");
session_start();

if(!empty($_GET['idDiscussion'])){
  //on enregistre l'id de la discussion
  $idDiscussion = $_GET['idDiscussion'];

  $_SESSION['idUser'] = null;
  $_SESSION['firstname'] = null;
  $_SESSION['lastname'] = null;

  $req = mysqli_prepare($db, "UPDATE chatgroups SET Notif = 'viewed' WHERE id = ?");
  mysqli_stmt_bind_param($req, "i", $idDiscussion);
  mysqli_stmt_execute($req);

}
else {
  $_SESSION['idDiscussion'] = null;
  $_SESSION['idUser'] = $_POST['idUser'];
  $_SESSION['firstname'] = $_POST['firstname'];
  $_SESSION['lastname'] = $_POST['lastname'];

  $id_User = $_SESSION['id'];
  $idUser2 = $_POST['idUser'];

  $requete = "select a.ID from chatgroups a join chatgroups b on b.ID = a.ID and a.ID_User != b.ID_User ";
  $requete .= " where a.ID_User = ? or a.ID_User = ? GROUP BY a.ID HAVING COUNT(*) = '2' ";

  $req = mysqli_prepare($db, $requete);
  mysqli_stmt_bind_param($req, "ii", $id_User, $idUser2);
  mysqli_stmt_execute($req);

  mysqli_stmt_store_result($req);

  mysqli_stmt_bind_result($req, $idD);

  while(mysqli_stmt_fetch($req)){
    if(!empty($idD)){
      $idDiscussion = $idD;
    }
  }
}

$_SESSION['idDiscussion'] = $idDiscussion;

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
