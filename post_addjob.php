<?php
include("config.php");
session_start();

//pour objectposts
$id_User = $_SESSION['id'];
$JobLoc = $_POST["jobloc"];
$Company = $_POST["company"];
$Title = $_POST["title"];
$JobDescri = $_POST["jobdescri"];
$Length = $_POST["len"];
$Skills = $_POST["skills"];
$Area = $_POST["area"];

// Insertion
$lastid = mysqli_insert_id($db);
$req = mysqli_prepare($db, "INSERT INTO objectposts (ID, ID_User) VALUES(?, ?)");
mysqli_stmt_bind_param($req, "ii", $lastid, $id_User);
mysqli_stmt_execute($req);

$req = mysqli_prepare($db, "INSERT INTO jobreacts (ID_Offer, ID_User) VALUES(?, ?)");
mysqli_stmt_bind_param($req, "ii", $lastid, $id_User);
mysqli_stmt_execute($req);


$req = mysqli_prepare($db, "INSERT INTO joboffers (ID_Object, JobLocation, Company, Title, JobDescription, Length, Skills, Area) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($req, "issssiss",$lastid, $JobLoc, $Company, $Title, $JobDescri, $Length, $Skills, $Area);
mysqli_stmt_execute($req);

mysqli_stmt_close($req);

//echo "<meta http-equiv=\"refresh\" content=\"0\"> ";
header("Location: jobs.php");
//exit;
?>
