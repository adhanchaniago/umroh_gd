<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Umroh Management</title>
   <link rel="icon" sizes="192x192" href="img/Icon.png"/>
  
  
  
      <link rel="stylesheet" href="css/login_css.css">

  
</head>

<body>
  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>

 <div class="container">


      <div id="login">

       <form class="form" method="POST" action="cek_login.php">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span>
          	<input type="text" name="Email" placeholder="Email" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock"></span>
           <input type="password" name="Password" placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" value="Sign In"></p>

          </fieldset>

        </form>

        <p><a href="#" class="blue">Sign up now for Umroh Garisdev  V.5.0</a><span class="fontawesome-arrow-right"></span></p>

      </div> <!-- end login -->

    </div>
    <div class="bottom">  <h3><a href="https://garisdev.com/">www.garisdev.com</a></h3></div>

  
  
</body>
</html>
