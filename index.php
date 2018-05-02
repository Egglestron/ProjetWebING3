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

<div>
  <form action="post.php" class="form-post" method="post" enctype="multipart/form-data">

<<<<<<< HEAD
  <input type="file" name="fileupload" value="fileupload" id="fileupload">


        <input class="form-control mr-sm-2" name="description" type="text" placeholder="Publish" aria-label="Publish">
    <button class="btn btn-primary mr-sm-2" formaction="post.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Publish</button>
=======
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input class="form-control mr-sm-2" name="description" type="text" placeholder="Publish" aria-label="Publish">
    <button class="btn btn-primary mr-sm-2" name="submit" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Publish</button>
>>>>>>> fe5d03a755ad3fc39f422965069a33af1e457108
  </form>
</div>

<div>
  <?php
  include("config.php");
  session_start();
  $id = $_SESSION['id'];

  $requete = "SELECT DISTINCT o.ID, o.ID_User, us.Firstname, us.Lastname, o.Description, o.Date_Post, e.Date, e.Location, e.Status FROM events e, objectposts o, users us ";
  $requete .= " WHERE o.ID = e.ID_Object AND(EXISTS( SELECT * FROM friendships f WHERE f.ID_User1 = o.ID_User AND f.ID_User2 = ? AND f.Status = 'Accepted' ";
  $requete .= " AND ((f.Relationship = 'Friend' AND e.Status IN ('Public','Friends Only','Network')) OR (f.Relationship = 'Pro' ";
  $requete .= " AND e.Status IN ('Network','Public')))) OR (o.ID_User = ?) ) AND us.ID = o.ID_User  ORDER BY o.Date_Post DESC LIMIT 25";

  //echo $requete;

  $req = mysqli_prepare($db, $requete);
  mysqli_stmt_bind_param($req, "ii", $id, $id);
  mysqli_stmt_execute($req);

  mysqli_stmt_store_result($req);

  mysqli_stmt_bind_result($req, $colID, $colID_User, $colID_FirstName, $col_LastName, $colDescription, $colDate_Post, $colDate, $colLocation, $colStatus);

  while(mysqli_stmt_fetch($req)){
    //echo "<p class=\"form-control mr-sm-2\" type=\"text\">$colDescription<p>";
 echo "<main role=\"main\" class=\"container col-sm-5\">";
    echo "<div class=\"jumbotron float-center text-left\">";
        echo "<h1 class=\"h3 mb-1\">$colID_FirstName $col_LastName</h1>";
        echo "<div class=\"col-sm-10\">";
        echo "<label class=\"col-sm-2 control-label text-right\">$colDate_Post</label>";
        echo "</div>";
        if(!empty($colDate)){
          echo "<p class=\"form-control mr-sm-2\" type=\"text\">à $colLocation<p>";
        }
        if(!empty($colDate = NULL)){
          echo "<p class=\"form-control mr-sm-2\" type=\"text\">le $colDate<p>";
        }

        echo "<p class=\"form-control mr-sm-2\" type=\"text\">$colDescription<p>";
        echo "<div>";
        echo "<form class=\"form-post\" method=\"post\">";
        echo "<input class=\"form-control mr-sm-2\" name=\"description\" type=\"text\" placeholder=\"Publish\" aria-label=\"Publish\">";
        echo "<button class=\"btn btn-primary mr-sm-2\" formaction=\"comment.php?idpost=$colID\" style=\"border-color: #000099; color: #000099; background-color: navbar-dark;\" type=\"submit\">Publish</button>";
        echo "</form>";
        echo "</div>";

        $requete = "SELECT o.Date_Post, o.Url_Media, o.Description, u.FirstName, u.LastName FROM objectposts o, users u, comments c ";
        $requete .= " WHERE o.ID = c.ID_Object AND o.ID_User = u.ID AND c.ID_Post = ? ORDER BY o.Date_Post DESC ";

        $req2 = mysqli_prepare($db, $requete);

        mysqli_stmt_bind_param($req2, "i", $colID);
        mysqli_stmt_execute($req2);

        mysqli_stmt_store_result($req2);

        mysqli_stmt_bind_result($req2, $cDate, $cUrlM, $cCom, $cFirstn, $cLastn);

        while (mysqli_stmt_fetch($req2)) {
          // code...
          echo "<p class=\"form-control mr-sm-2\" type=\"text\">$cFirstn $cLastn le $cDate ::: $cCom<p>";
        }
        // <div class="multitext">
        //   <label for="inputFirstname" class="sr-only">First name</label>
        //   <input type="text" name="inputFirstname" id="inputFirstname" class="form-control" placeholder="First name" required>
        //   <label for="inputLastname" class="sr-only">Last name</label>
        //   <input type="text" name="inputLastname" id="inputLastname" class="form-control" placeholder="Last name" required>
        // </div>
        //
        // <div class="multitext">
        //   <label for="inputEmail" class="sr-only">Email address</label>
        //   <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        // </div>
        //
        // <div class="multitext">
        //   <label for="inputPassword" class="sr-only">Password</label>
        //   <input type="password" name='inputPassword' id="inputPassword" class="form-control" placeholder="Password" required>
        //   <label for="inputPasswordCheck" class="sr-only">Re-type password</label>
        //   <input type="password" name="inputPasswordCheck" id="inputPasswordCheck" class="form-control" placeholder="Re-type password" required>
        // </div>
        //
        // <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    echo "</div>";
echo "</main>";

  }

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
