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
$req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Description) VALUES (?, ?)");
mysqli_stmt_bind_param($req, "is", $id_User, $description);
mysqli_stmt_execute($req);

$lastid = mysqli_insert_id($db);

$target_file = null;
//upload de l'image w3schools.com
if(isset($_FILES["fileToUpload"])){
$target_dir = "uploads/user$id_User/";

  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

  $target_file = $target_dir."post".$lastid.".png";
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image

  if(isset($_POST["submit"])) {
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
      $check = getimagesize($file_temp);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "file exists";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "file is too big";
      $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "file not good";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  // if everything is ok, try to upload file
  } else {
       move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  }
}

if($target_file != null){
  //echo $target_file;
  $req = mysqli_prepare($db, "UPDATE objectposts SET Url_Media = ? WHERE ID = ?");

  mysqli_stmt_bind_param($req, "si", $target_file, $id_User);
  mysqli_stmt_execute($req);
}

$req = mysqli_prepare($db, "INSERT INTO events (ID_Object, Date, Location, Status) VALUES(?, ?, ?, ?)");
mysqli_stmt_bind_param($req, "isss", $lastid, $Date, $Location, $Status);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

//header('location:index.php');

?>
