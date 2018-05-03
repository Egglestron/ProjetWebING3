<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Search </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
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
          <li class="nav-item active">
            <a class="nav-link" href="network.php">Network</a>    <!--<a class="nav-link disabled" href="#">Network </a>  pour griser la case-->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Messages </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jobs.php">Jobs </a>
          </li>
        </ul>
        <form class="form-inline" method="post">
          <input class="form-control mr-sm-2"  name="information" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary  mr-sm-2" formaction="search.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
          <button class="btn btn-primary" formaction="logout.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
        </form>
      </div>
    </nav>
<?php
    include("config.php");
    session_start();
    $id = $_SESSION['id'];
    $info = $_POST["information"];

    $requete = "SELECT DISTINCT us.Firstname, us.LastName, us.Pseudo, us.ID FROM users us WHERE us.FirstName LIKE  ? OR us.LastName LIKE ?";
    //echo $requete;

    $info .= "%";

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "ss", $info, $info);
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
      echo "<a href=\"profile_view.php?ident={$idp}\" class=\"label\">$firstN $lastN - $pseudo<br/></a>";
    }
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
