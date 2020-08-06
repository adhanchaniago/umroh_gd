<!DOCTYPE html>

<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
?>




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
            		<i class="pe-7s-mail-open-file"></i>
            	<span>Push Message Content</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
        
        <div class="main-header__date">
        <button onclick="window.location='?page=SalesMessageContent';">Back</button>
       
        <input hidden>
        </div>
	</header>

<br><br>

<br>
        <form method ="POST" class ="widget widget__form" name ="form1" action ="?page=SalesSavePushMessage" target = "_self" role ="form">
              <input type="text" class="stacked-input" name = "nama" placeholder="Name" value ="">
                 <input type="text" class="stacked-input" name ="description" placeholder="Description" value ="">
                    <input id="field" type="text" class="stacked-input" name = "link" placeholder="Attach your link to your content here " value ="http://">
                  <button type ="submit" onclick="window.location='?page=SalesSavePushMessage';">Send</button>
            
</form>

<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

<script type="text/javascript">
  
  var readOnlyLength = $('#field').val().length;

 $('#output').text(readOnlyLength);

$('#field').on('keypress, keydown', function(event) {
    var $field = $(this);
    $('#output').text(event.which + '-' + this.selectionStart);
    if ((event.which != 37 && (event.which != 39))
        && ((this.selectionStart < readOnlyLength)
        || ((this.selectionStart == readOnlyLength) && (event.which == 8)))) {
        return false;
    }
});                    
</script>
</body>
</html>


