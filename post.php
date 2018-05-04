<?php
include("config.php");
session_start();

//pour les images
$id_User = $_SESSION['id'];

//pour objectposts
$description = isset($_POST["description"])?$_POST["description"]:null;

//pour events
$Date = isset($_POST["Date"])?$_POST["Date"]:null;
$Location = isset($_POST["Location"])?$_POST["Location"]:null;
$Status = isset($_POST["Status"])?$_POST["Url_Media"]:"Public";


// Insertion

if((isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])) || !empty($description)){
  $req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Description) VALUES (?, ?)");
  mysqli_stmt_bind_param($req, "is", $id_User, $description);
  mysqli_stmt_execute($req);

  $lastid = mysqli_insert_id($db);

  $target_file = null;

  //upload de l'image w3schools.com
  include("uploadPicture.php");

  $req = mysqli_prepare($db, "INSERT INTO events (ID_Object, Date, Location, Status) VALUES(?, ?, ?, ?)");
  mysqli_stmt_bind_param($req, "isss", $lastid, $Date, $Location, $Status);
  mysqli_stmt_execute($req);

  mysqli_stmt_close($req);
}

  header('location:index.php');

  ?>
