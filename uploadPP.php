<?php
if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}

if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])){
$target_dir = "uploads/user$id/";
  echo "yooo";
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

  $basename = basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($basename,PATHINFO_EXTENSION));

  $target_file = $target_dir."profilePicture.".$imageFileType;
  $uploadOk = 1;

  // Check if image file is a actual image or fake image

  if(isset($_POST["submit"])) {
    if (!file_exists($_FILES['fileToUpload']['tmp_name'])) {
    echo "File upload failed. ";
    if (isset($_FILES['fileToUpload']['error'])) {
         echo "Error code: ".$_FILES['fileToUpload']['error'];
    }
    exit;
}
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    echo $file_temp;
      $check = getimagesize($file_temp);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
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
else {
  header('location:index.php');
  exit;
}

?>
