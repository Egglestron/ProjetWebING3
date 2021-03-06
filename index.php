<!doctype html>
<?php
include("config.php");

if(empty($_SESSION['id'])){
  header('location:login.html');
  exit;
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="120">
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

  <title>Feed</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="common.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
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
        <button class="btn btn-default" formaction="search.php" style="" type="submit">Search</button>
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

  <!-- Main page -->
  <div class='container'><h3 style='color:white; font-weight:700; font-size:3em;'>My feed</h3></div>

  <main role="main" class="container">
    <div class="jumbotron">
      <h1>Something to share?</h1>
      <br>
      <form action="post.php" class="form-post" method="post" enctype="multipart/form-data">
        <input class="form-control multitext mr-sm-2" name="description" type="text" placeholder="Write a post" aria-label="Write a post">
        <label for="fileToUpload" class="btn btn-lg btn-default mr-sm-2" style="cursor: pointer;">Add a photo</label>
        <input type="file" name="fileToUpload" value="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
        <button class="btn btn-lg btn-primary mr-sm-2" name="submit" style="" type="submit">Publish</button>
      </form>
      <div class="preview">
        <p>No photo added to the post</p>
      </div>
    </div>
  </main>

  <div>
    <?php

    $id = $_SESSION["id"];

    $requete = "SELECT DISTINCT o.*, us.Firstname, us.Lastname, e.Date, e.Location, e.Status FROM events e, objectposts o, users us ";
    $requete .= " WHERE o.ID = e.ID_Object AND(EXISTS( SELECT * FROM friendships f WHERE f.ID_User1 = o.ID_User AND f.ID_User2 = ? AND f.Status = 'Accepted' ";
    $requete .= " AND ((f.Relationship = 'Friend' AND e.Status IN ('Public','Friends Only','Network')) OR (f.Relationship = 'Pro' ";
    $requete .= " AND e.Status IN ('Network','Public')))) OR (o.ID_User = ?) ) AND us.ID = o.ID_User  ORDER BY o.Date_Post DESC LIMIT 25";

      $req = mysqli_prepare($db, $requete);
      mysqli_stmt_bind_param($req, "ii", $id, $id);
      mysqli_stmt_execute($req);
      mysqli_stmt_store_result($req);
      mysqli_stmt_bind_result($req, $colID, $colID_User, $colDate_Post, $colUrlMedia, $colDescription, $colID_FirstName, $col_LastName, $colDate, $colLocation, $colStatus);

      while(mysqli_stmt_fetch($req)){
        echo "<main role='main' class='container col-sm-5'>";
        echo "<div class='jumbotron float-center text-left'>";
        echo "<a class='h3 mb-1' href='profile_view.php?ident=$colID_User'>$colID_FirstName $col_LastName</a>";
        echo "<br>$colDate_Post";
        if(!empty($colDate)){
          echo "<p class='form-control mr-sm-2' type='text'>à $colLocation<p>";
        }
        if(!empty($colDate = NULL)){
          echo "<p class='form-control mr-sm-2' type='text'>le $colDate<p>";
        }
        echo "<p class='h2 mr-sm-2' type='text' style='margin-top:20px; margin-bottom:10px;'>$colDescription<p>";
        if(!empty($colUrlMedia)){
          echo "<img src ='$colUrlMedia' alt = 'image du post' >";
        }
        echo "<div>";
        echo "<form action='comment.php' class='form-post' method='post'>";
        echo "<input class='form-control mr-sm-2 multitext' name='description' id='description' type='text'  placeholder='Leave a comment' aria-label='Comment' required>";
        echo "<input type='hidden' name='idpost' value='$colID' id='idpost'> ";
        echo "<button class='btn btn-primary mr-sm-2'  style='' type='submit' >Comment</button>";
        echo "</form>";
        echo "</div>";

        $requete = "SELECT o.Date_Post, o.Url_Media, o.Description, u.FirstName, u.LastName FROM objectposts o, users u, comments c ";
        $requete .= " WHERE o.ID = c.ID_Object AND o.ID_User = u.ID AND c.ID_Post = ? ORDER BY o.Date_Post DESC ";
        $req2 = mysqli_prepare($db, $requete);
        mysqli_stmt_bind_param($req2, "i", $colID);
        mysqli_stmt_execute($req2);
        mysqli_stmt_store_result($req2);
        mysqli_stmt_bind_result($req2, $cDate, $cUrlM, $cCom, $cFirstn, $cLastn);
        echo "<div style='margin-top:15px; margin-bottom:0px;'>";

        $i = 0;
        while (mysqli_stmt_fetch($req2)) {
          $i += 1;
          if($i == 4){
            echo "</div>
            <div id='otherComments".$colID."' style =\"display: none;\"> ";
          }
          echo "<p class='mr-sm-2' type='text'>$cFirstn $cLastn ($cDate) : $cCom<p>";
        }
        echo "</div>";
        if($i>3){
          echo "<button class=\"btn btn-sm btn-success btn-block\" onclick=\"showhideComment('$colID')\" id='hidebutton".$colID."' >Show More</button>";
        }
        echo "</div>";
        echo "</main>";
      }
      ?>
    </div>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p>Konnect.ed<br>A. Prat, M. Michel and S. Caddeo</p>
      </div>
    </footer>

    <script src="show.js"></script>
    <script src="index.js"></script>
  </body>
  </html>
