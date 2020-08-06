<?php
	session_start();
	$FirstName = $_SESSION['FirstName'];
	$Travel = $_SESSION['Travel'];
	$role = $_SESSION['role'];
	if ($role == 2) {
		$enable90 = "";
		$enable180 = "disabled='disabled'";
		$enable270 = "disabled='disabled'";
		}
	if ($role == 3) {
		$enable90 = "";
		$enable180 = "";
		$enable270 = "disabled='disabled'";
		$enable360 = "";
		}
	if ($role == 4) {
		$enable90 = "disabled='disabled'";
		$enable180 = "";
		$enable270 = "disabled='disabled'";
		$enable360 = "";
		}
	if ($role == 6) {
		$enable90 = "";
		$enable180 = "";
		$enable270 = "";
		$enable360 = "";
		}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome Page</title>
  <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
</head>
	<!-- Glazzed style -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/welcome.css" />

<!-- amcharts -->
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<style>
body{
	background-color:#313f75;
}
font, a, p, h3, span, td, tr, th, strong, i, li {color: #ffffff}
.btn{color: #ffffff}
</style>
<!-- end amcharts -->
<body>

	<header class="top-bar">
		<ul class="profile">
      <li>
        <div class="main-logo"><img src="../img/rebuild.png"; height="45px"; style="padding-top:3px ;padding-left:10px";></div>
      </li>
    </ul>
		  <div class="main-brand">
      <div class="main-brand__container">
   <!--     <a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a> &nbsp;
        <a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>  &nbsp;
        <a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-config"></i></a>  &nbsp;-->
       </div>
    </div>
	</header> <!-- /top-bar -->


<style>
  .wrap {
    margin-top: 50px;
  }
</style>

</head>
  <body>

  <div class="wrap">
    <section class="container price-item">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="panel panel-info hover-1">
            <div class="panel-heading">
              <div class="price-value">
                <p>
                  <span><img src="../img/bookingicon.png"; height="95px";></span>
                </p>
              </div>
            </div>
            <div class="panel-body">
              <h3>Customer Relation</h3>
              <ul class="list-styled">
                <li>
                  <p class="pull-mid">&#9702 Booking Now</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Customer Receipt</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Manifest Document</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Android Booking</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <button class="btn green btn-sm" type="submit" name="button90" id="submit90" <?php echo $enable90; ?> onclick="window.location.href = '?page=News_All'">Launch</button>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="panel panel-success hover-1">
            <div class="panel-heading">
              <div class="price-value">
                <p>
                  <span><img src="../img/price.png"; height="95px";></span>
                </p>
              </div>

            </div>
            <div class="panel-body">
              <h3>Finance Analysis</h3>
              <ul class="list-styled">
                <li>
                  <p class="pull-mid">&#9702 Data Analysis</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Billing Status</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <button class="btn yellow btn-sm" type="submit" name="button180" id="submit180" <?php echo $enable180; ?> onclick="window.location.href = '?page=Analysisdata'">Launch</button>
            </div>
          </div>
        </div>
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="panel panel-danger hover-1">
            <div class="panel-heading">
              <div class="price-value">
                <p>
                   <span><img src="../img/manager.png"; height="95px";></span>
                </p>
              </div>
            </div>
            <div class="panel-body">
              <h3>Manager</h3>
              <ul class="list-styled">
                <li>
                  <p class="pull-mid">&#9702 Pra-Manifest</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Employee Management</p>
                </li>
                <li>
                  <p class="pull-mid">&#9702 Financial Statements</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <button class="btn blue btn-sm" type="submit" name="button270" id="submit270" <?php echo $enable270; ?> onclick="window.location.href = '?page=270'">Launch</button>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="panel panel-default hover-1">
            <div class="panel-heading">
              <div class="price-value">
                <p>
                   <span><img src="../img/provider.png"; height="95px";></span>
                </p>
              </div>

            </div>
            <div class="panel-body">
              <h3>Monitor</h3>
              <ul class="list-styled">
                <li>
                  <p class="pull-mid">Agent Performance</p>
                </li>
                <li>
                  <p class="pull-mid">SMS Gateway</p>
                </li>
                <li>
                  <p class="pull-mid">Travel Reputation</p>
                </li>
                <li>
                  <p class="pull-mid">Travel Reputation</p>
                </li>
                <li>
                  <p class="pull-mid">&nbsp;</p>
                </li>
              </ul>
            </div>
            <div class="panel-footer">
              <button class="btn red btn-sm" type="submit" name="button360" id="submit360" <?php echo $enable360; ?> onclick="window.location.href = '?page=360'">Launch</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

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
