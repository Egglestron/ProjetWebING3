<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="60">
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

    <title>Profile </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="common.css" rel="stylesheet">
    <link href="search.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
  </head>



  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand" href="index.php" style="font-weight: 700;">Konnect.ed</a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="network.php">Network</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jobs.php">Jobs</a>
          </li>
        </ul>
      </div>

      <div class="mx-auto order-2">
        <form class="navbar-brand mx-auto form-inline" method="post">
          <input class="form-control multitext" name="information" type="text" placeholder="Who are you looking for?" aria-label="Search">
          <button class="btn btn-default" formaction="search.php" type="submit">Search</button>
        </form>
      </div>

      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <form class="form-inline nav-item">
              <button class="btn btn-default" formaction="logout.php" style="font-weight:600;" type="submit">Disconnect</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
<?php
    include("config.php");
    session_start();
    $id = $_SESSION['id'];

    if(empty($_POST["information"])){
      if(!empty($_SESSION["information"])){
        $info = $_SESSION["information"];
      }
      else{
        $info = "";
      }
    }
    else {
      // code...
      $info = $_POST["information"];
      $_SESSION["information"] = $info;
    }

    $requete = "SELECT DISTINCT us.Firstname, us.LastName, us.Pseudo, us.ID FROM users us WHERE (us.FirstName LIKE  ? OR us.LastName LIKE ?) AND us.ID != ?";
    //echo $requete;

    $info .= "%";

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "ssi", $info, $info, $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_FirstName, $col_LastName, $col_Pseudo, $col_ID);
    echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Noms</h3>";
    while(mysqli_stmt_fetch($req)){
      $firstN = $col_FirstName ;
      $lastN = $col_LastName;
      $pseudo = $col_Pseudo;
      $idp = $col_ID;
      echo "<a href=\"profile_view.php?ident={$idp}\" class=\"label\">$firstN $lastN";
      if(!empty($pseudo)){
        echo "- $pseudo";
      }
      echo "<br/></a>";
    }
?>

<footer class="mastfoot mt-auto">
  <div class="inner">
    <p>Konnect.ed<br>A. Prat, M. Michel and S. Caddeo</p>
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
