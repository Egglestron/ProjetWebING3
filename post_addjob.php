<?php
include("config.php");

if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}

if(!empty($Company = $_POST["company"])){
//pour objectposts
$id_User = $_SESSION['id'];
$JobLoc = $_POST["jobloc"];
$Company = $_POST["company"];
$Title = $_POST["title"];
$JobDescri = isset($_POST["jobdescri"])?$_POST["jobdescri"]:null;
$Length = isset($_POST["len"])?$_POST["len"]:null;
$Skills = isset($_POST["skills"])?$_POST["skills"]:null;
$Area = isset($_POST["area"])?$_POST["area"]:null;

// Insertion
$req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User) VALUES(?)");
mysqli_stmt_bind_param($req, "i", $id_User);
mysqli_stmt_execute($req);

$lastid = mysqli_insert_id($db);

$req = mysqli_prepare($db, "INSERT INTO joboffers (ID_Object, JobLocation, Company, Title, JobDescription, Length, Skills, Area) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($req, "issssdss", $lastid, $JobLoc, $Company, $Title, $JobDescri, $Length, $Skills, $Area);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);
}

//echo "<meta http-equiv=\"refresh\" content=\"0\"> ";
header("Location: jobs.php");
exit;
?>
