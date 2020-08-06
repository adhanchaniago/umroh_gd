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

      label.radio-inline,
	  label.checkbox-inline,
	  label.radio,
	  label.checkbox {
    	margin-right:2%;
    	cursor:pointer;
    	font-weight:400;
    	padding:10px 10px 10px 30px;
    	background-color:#dcdfd400;
    	margin-bottom:10px!important
	  }
	  label.radio-inline.checked,
 	  label.checkbox-inline.checked,
 	  label.radio.checked,
	  label.checkbox.checked {
    	background-color:#266c8e;
    	color:#fff!important;
    	text-shadow:#000 1px 1px 2px!important
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
            		<i class="pe-7s-smile"></i>
            	<span>Target Group</span>
          		</h1>
         	
        </div>
        
        <div class="main-header__date">
                    <button onclick="window.location='?page=270';">Back</button>
                    <button type="submit" onclick="window.location='?page=MessageContent';">Next</button>
                    <input type="radio" hidden>
        </div>
	</header>

<div class ="form-group" >
<form method="POST" action ="?page=MessageContent" target = "_self" role ="form">
 	<div class = "row">
 		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-0">
        <input name="OldMen" id="cb-option-0" value="old_men" type="checkbox" hidden="">
		<center>
		<img src="../img/oldmen.png" alt="user" width="120" class="img-responsive center-block" >
		</center>
		</label>
		<center> Old Men </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-1">
        <input name="YoungMen" id="cb-option-1" value="young_men" type="checkbox" hidden="">
		<center>
		<img src="../img/youngmen.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>	
		<center> Young Men </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-2">
        <input name="TeenageBoys" id="cb-option-2" value="teenage_boys" type="checkbox" hidden="">
		<center>
		<img src="../img/teenageboys.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Teenage Boys </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-3">
        <input name="Boys" id="cb-option-3" value="boys" type="checkbox" hidden="">
		<center>
		<img src="../img/boys.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Boys </center>
		</article>
		</div>
 	</div>
 </div>

<div class ="form-group">
 	<div class = "row">
 		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-4">
        <input name="OldWomen" id="cb-option-4" value="old_women" type="checkbox" hidden="">
		<center>
		<img src="../img/oldwomen.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Old Women </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-5">
        <input name="YoungWomen" id="cb-option-5" value="young_women" type="checkbox" hidden="">
		<center>
		<img src="../img/youngwomen.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Young Women </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-6">
        <input name="TeenageGirls" id="cb-option-6" value="teenage_girls" type="checkbox" hidden="">
		<center>
		<img src="../img/teenagegirl.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Teenage Girls </center>
		</article>
		</div>

		<div class = "col-xs-3">
		<article class = "widget">
		<label class = "checkbox" for="cb-option-7">
        <input name="girls" id="cb-option-7" value="girls" type="checkbox" hidden="">
		<center>
		<img src="../img/girls.png" alt="user" width="120" class="img-responsive center-block">
		</center>
		</label>
		<center> Girls </center>
		</article>
		</div>
 	</div>
 </div>

<article class ="widget">
<div class = "row">
				<div class="col-xs-3">					
					<button class="btn yellow" style="width:100%" href ="#" onclick="return false;">All</button>
					</div>
					<div class="col-xs-3">
						<button class="btn blue" style="width:100%" onclick="return false;">All Male</button>
					</div>
					<div class="col-xs-3">
						
						<button class="btn blue" style="width:100%" onclick="return false;">Young Male</button>
					</div>
					<div class="col-xs-3">
						
						<button class="btn green" style="width:100%" onclick="return false;">Earner</button>
					</div>
</div>
<br>
			<div class = "row">
				<div class="col-xs-3">					
					<button class="btn white" style="width:100%" onclick="return false;">Clear All</button>
					</div>
					<div class="col-xs-3">
						<button class="btn red" style="width:100%" onclick="return false;"> <center>All Female</center> </button>
					</div>
					<div class="col-xs-3">
						<button class="btn red" style="width:100%" onclick="return false;">Young Female</button>
					</div>
					<div class="col-xs-3">
						<button class="btn dark" style="width:100%" onclick="return false;">Ingenerate</button>
					</div>
</div>
</article>
		
			
			</form>
			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript">
		
	//When checkboxes/radios checked/unchecked, toggle background color
$('.form-group').on('click','input[type=radio]',function() {
    $(this).closest('.form-group').find('.radio-inline, .radio').removeClass('checked');
    $(this).closest('.radio-inline, .radio').addClass('checked');
});
$('.form-group').on('click','input[type=checkbox]',function() {
    $(this).closest('.checkbox-inline, .checkbox').toggleClass('checked');
});
	</script>

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

