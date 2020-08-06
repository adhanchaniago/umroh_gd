<!DOCTYPE html>
<html>
<head>
	<title>WiWE 270- Generate</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap --> 	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
	<!-- Tracker Bar Progess --> 
	<link rel="stylesheet" href="../css/progresstraccerstyle.css">


	<style>
	 .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

      </style>

</head>
<body>
<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<!-- Calling Top Bar & Side Bar --> 
	<?php include "menu.php"; ?>

	<!-- Content --> 
<section class="content">
			<header class = "main-header">
 				<div class="main-header__nav">
          		<h1 class="main-header__title">
            		<i class="pe-7s-mail-open"></i>
            	<span>Email Content</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
        
        <div class="main-header__date">
                <button onclick="window.location='?page=SalesMessageContent';">Back</button>
                <button onclick="window.location='?page=SalesMessageContent';">Save</button>
                <input hidden>
            </div>
          
	</header>

<article class="widget widget__form">             
              <div class="widget__content">
              <input type="text" class="stacked-input" id="input-1" placeholder="Subject">
  </div>
  </article>
  <textarea>Please type your content here, including text, picture, or even link. We will push it right away for you to your value customer. We will make sure your customer notice it. </textarea>

  <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
 
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>


</body>
</html>

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>

