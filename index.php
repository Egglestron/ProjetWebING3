<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Home </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
    <link href="dist/css/normalize.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <!-- style="background-color:  #000099;"  Pour avoir la navbar en bleu-->
      <a class="navbar-brand" href="index.html">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.html">Profile </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notif.html">Notifications </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="network.html">Network </a>    <!--<a class="nav-link disabled" href="#">Network </a>  pour griser la case-->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.html">Messages </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jobs.html">Jobs </a>
          </li>
        </ul>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary mr-sm-2" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
          <button class="btn btn-primary" formaction="logout.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
        </form>
      </div>
    </nav>

<div>
    <form class="form-post">
        <input class="form-control mr-sm-2" type="text" placeholder="Publish" aria-label="Publish">
        <button class="btn btn-primary mr-sm-2" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Publish</button>
  </form>
</div>

<div>
  <?php
  include("config.php");
  session_start();
  SELECT DISTINCT o.ID, o.ID_User, o.Description, o.Date_Post, e.Date, e.Location, e.Status FROM events e, friendships f, objectposts o
  WHERE o.ID = e.ID_Object
  AND(f.ID_User1 = o.ID_User AND f.ID_User2 = '6'
  AND f.Status = 'Accepted'
  AND ((f.Relationship = 'Friend'
  AND e.Status IN ('Public','Friends Only','Network'))
  OR (f.Relationship = 'Pro'
  AND e.Status IN ('Network','Public'))))
  OR (o.ID_User = '6')
  AND e.ID_Object = o.ID ORDER BY o.Date_Post DSC
  $req = mysqli_prepare($db, "INSERT INTO objectposts (ID_User, Url_Media, Description) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($req, "iss", $id_User, $Url_Media,$description);
  mysqli_stmt_execute($req);
  ?>
</div>



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
