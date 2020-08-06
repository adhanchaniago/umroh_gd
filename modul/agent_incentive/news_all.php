<!DOCTYPE html>

<?php
session_start();
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 1;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM push_news";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);
?>
<html>
<head>
    <title>Umroh Management</title>
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

<style>
     .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }


            table{
              width: 100%
            }


            th, td {

            		height: 20px;
            		padding: 10px;

                border-collapse: collapse;
            	border-radius: 0px;
            }
            tr:nth-child(even) {
                background-color:rgba(0,0,0,.3);
            }

            th, td {
            	  border-bottom: 1px solid black;
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
                <i class="pe-7s-graph1"></i>
              <span>News </span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=270" onclick="window.location='?page=270';">Management</a>
              </li>
               </ul>
           </div>


      </header>

<div class = "row">
          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">

              </header>

              <div class="widget__content ">

                <table >
                <tr>
                  <thead>
                  <th>
                Content News
                  </th>

                </thead>
                </tr>



                <tr>
                  <?php
                    $mySql  = "SELECT * FROM push_news ORDER BY `id_news` DESC LIMIT $hal, $row";
                    $myQry  = mysql_query($mySql, $Link)  or die ("Query  salah : ".mysql_error());
                    $nomor  = 0;
                    while ($myData = mysql_fetch_array($myQry)) {
                      $nomor++;
                      $Kode = $myData['id_news'];
                    ?>
                  <tbody>

                  <td>
                    <div class="media ">
                		<figure class="pull-left post__img">
                      <a href='modul/<?php echo $myData['image']; ?>' target='_blank'  title="News">
                    <img src="modul/<?php echo $myData['image']; ?> "  height="400px"; style="padding-top:3px ;padding-left:10px";/></a>&nbsp;</div>

                		</figure>
                		<div class="media-body post_desc">
                			<h3><p style="color:red"><?php echo $myData['title']; ?></p></h3> <hr>
                			<p><?php echo $myData['content']; ?></p>
                		</div>
                	</div>

                  </td>


                </tbody>
                   <?php } ?>
                </tr>
                </table>
       <ul class="pagination pull-left no-margin">
<li class="" >
<strong style="font-weight: bold;">Total Records :</strong>
                                <?php echo $jml; ?>
</ul>

<?php

    $prev = $hal - $row;
    if ($prev <= -$row) { $prev = 0;}
    $next = $hal + $row;
    $Selisih = $jml - $row;
    if ($Selisih <= 0) {$Selisih = 0;}

    if ($next >= $jml) { $next =  $Selisih;}
?>

    <ul class="pagination pull-right no-margin">
      <li class="prev">
    <?php
    echo "
      <a href='?page=News_All_Incentive&hal=$prev'>
      <i class='pe-7s-prev'></i>
      </a>";
      ?>
      </li>
    <li class="" >
      <?php
      for ($h = 1; $h <= $max; $h++) {
        $list[$h] = $row * $h - $row;
        echo " <a href='?page=News_All_Incentive&hal=$list[$h]'>$h</a> ";
      }
      ?>
    </li>
    <li class="next">
        <?php
    echo "
      <a href='?page=News_All_Incentive&hal=$next'>
      <i class='pe-7s-next'></i>
      </a>";
      ?>
    </li>
      </ul>




              </div> <!-- /widget__content -->

            </article><!-- /widget -->
          </div>

        </div>

      <footer class="footer-brand">
          <?php include "footer.php"; ?>
      </footer>
    </section> <!-- /content -->

    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

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
