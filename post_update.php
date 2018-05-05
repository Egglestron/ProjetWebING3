<?php
include("config.php");

if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}

if((isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])) || !empty($_POST["description"]) || !empty($_POST["position"]) || !empty($_POST["pseudo"])){
//pour objectposts
$id = $_SESSION['id'];

$descri = isset($_POST["description"])?$_POST["description"]:null;
$pos = isset($_POST["position"])?$_POST["position"]:null;
$pseu = isset($_POST["pseudo"])?$_POST["pseudo"]:null;

if((isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name']))){

$target_file = null;

//include a picture
include("uploadPP.php");
echo "   ".$target_file;

$req = mysqli_prepare($db, "UPDATE users SET Description = ? , Position = ?, Pseudo = ?, ProfilePicture = ? WHERE ID = ?");
mysqli_stmt_bind_param($req, "ssssi",$descri, $pos, $pseu, $target_file, $id);

}
else{
  $req = mysqli_prepare($db, "UPDATE users SET Description = ? , Position = ?, Pseudo = ? WHERE ID = ?");
  mysqli_stmt_bind_param($req, "sssi",$descri, $pos, $pseu, $id);
}

 mysqli_stmt_execute($req);

mysqli_stmt_close($req);
}

header('location:profile.php');
exit;
?>
