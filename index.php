<?php
include '../library/tracking.php';
// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Rebuild Version</title>
   <link rel="icon" sizes="192x192" href="img/Icon.png"/>
  <link rel="stylesheet" type="text/css" href="css/indexmain.css">
  <link rel="stylesheet" href="css/index.css">



</head>

<body>

  <div class="wrapper" style="padding-top: 22px">
    <div class="container">
        <h2><img src="img/rebuild.png"; style=" height: 250px;"></h2>

        <form class="form" method="POST" action="cek_login.php">
            <input type="text" name="Email" placeholder="Username" id="username" required>
            <input type="password"  name="Password" placeholder="Password" id ="password" required>
            <button type="submit" name="btnLogin" id="login-button" style="background-color: #d5c111"><font size="2px" style="color:#fff;"><strong style="font-weight: bold;">Log In</strong></font></button>
        </form>
        <b><strong style="fontSize:3px;color: #000"> Rebuild Powered by smatech.co.id</strong> </font></b>
    </div>

    <!-- <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul> -->
</div>
<!--
  <script src='js/jquery.min.js'></script>

    <script src="js/index.js"></script>
-->
</body>
</html>
