<?php
if(!empty($_SESSION['login_user'])){
$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($db,"select username from admin where username='$user_check' ");

$row=mysqli_fetch_array($ses_sql);

$login_session=$row['username'];

if(!isset($login_session))
{
header("Location: login.php");
exit;
}
}
else {
  // code...
  header('location:index.php');
  exit;
}
?>
