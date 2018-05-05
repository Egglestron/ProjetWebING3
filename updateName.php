<?php

include("config.php");

if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}

if(!empty($_POST["name2"])){
  $idDiscussion = $_SESSION["idDiscussion"];
  $name = $_POST["name2"];

  $req = mysqli_prepare($db, "UPDATE chatgroups SET Name = ? WHERE ID = ?");
  mysqli_stmt_bind_param($req, "si", $name, $idDiscussion);
  mysqli_stmt_execute($req);
  mysqli_stmt_close($req);
}

header("Location: messages.php");
exit;
?>
