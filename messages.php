<!doctype html>
<?php
session_start();

if(empty($_SESSION['id'])){
  header('location:login.html');
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="30">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <title>Messagerie perso</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="register.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <!-- style="background-color:  #000099;"  Pour avoir la navbar en bleu-->
    <a class="navbar-brand" href="index.php">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notif.php">Notifications </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="network.php">Network </a>    <!--<a class="nav-link disabled" href="#">Network </a>  pour griser la case-->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="messages.php">Messages </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jobs.php">Jobs </a>
        </li>
      </ul>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary mr-sm-2" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
        <button class="btn btn-primary" formaction="logout.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
      </form>
    </div>
  </nav>

  <div class="col-sm-3">
    <?php
    include("config.php");
    $id = $_SESSION["id"];

    $requete3 = "SELECT ID, Name FROM chatgroups WHERE ID_User = ?";

    $requete = "SELECT DISTINCT us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
    $requete .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Pro'";

    $requete2 = "SELECT DISTINCT us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
    $requete2 .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Friend'";

    //echo $requete;

    $req = mysqli_prepare($db, $requete3);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_ID, $col_Name);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Discussions existantes</h3>";
    while(mysqli_stmt_fetch($req)){
      echo "<button class=\"btn btn-lg btn-primary btn-block\" id=\"accessConv\" onclick=\"myFunction($col_ID)\" > $col_Name</button><br>";

    }

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_FirstName, $col_LastName, $col_Pseudo);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Pros</h3>";
    while(mysqli_stmt_fetch($req)){
      echo "$col_FirstName $col_LastName <br>";

    }

    $req = mysqli_prepare($db, $requete2);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_FirstName, $col_LastName, $col_Pseudo);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Friends</h3>";
    while(mysqli_stmt_fetch($req)){
      echo "<p class=\"button\" onclick=\"myFunction()\" $col_FirstName $col_LastName - $col_Pseudo <br>";
    }

    echo"</div>";
    echo"<div class=\"col-sm-9\">";
    echo "hello";


    //echo "</div>";

  echo "</div>";

  //w3schools
  echo "";
  ?>
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>LonkedOn by Arthur Prat, Maxime Michel and Sam Caddeo</p>
    </div>
  </footer>



  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
  <script src="../../../../assets/js/vendor/popper.min.js"></script>
  <script src="../../../../dist/js/bootstrap.min.js"></script>
</body>
</html>
