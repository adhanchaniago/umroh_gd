<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";
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

        .widget__form input[type=number] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}
.widget__form input[type=text] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}
.widget__form input[type=date] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
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
              <span>Itenenary </span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=270" onclick="window.location='?page=270';">Management</a>
              </li>
               </ul>
           </div>


      </header>

      <div class = "row">


                   <div class="row">

                <div class="col-md-12">
                  <article class="widget">
                    <header class="widget__header">
                      <div class="widget__title">
                        <i class="pe-7s-menu"></i><h3>Add New Itenenary</h3>
                      </div>
                      <div class="widget__config">
                        <a href="#"><i class="pe-7f-refresh"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                      </div>
                    </header>

<form action="../modul/proses/proses_itenenary.php"  method="post" target="_self" enctype ="multipart/form-data">

  <div class="widget__content table-responsive">

             <table class="table table-striped media-table">
               <thead>
                 <tr>
                   <th width="270">Description</th>
                   <th>Post Info</th>
                   <th>Required</th>
                 </tr>
               </thead>
               <tbody class="widget widget__form">

                                     <tr class="spacer"></tr>
                                     <tr>
                                       <td>
                                         <div class="media">
                                           <div class="media-body post_desc">
                                             <h3>Input File Itenenary</h3>
                                           </div>
                                         </div>
                                       </td>
                                       <td>

        <input name="nama_file" type="file" id="nama_file" size="30" required />
                                       <p>* <i>format foto "jpg/png"</i></td>
                                     </td>
                                     <td>
                      <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                     </td>
                   </tr>


  
  </table>
  <br>
<hr>
  <center><button  type="submit" name="btnSimpan" value=" Upload " class="btn btn-info" type="button" style="width: 50% ;border:solid blue">Save</button></center>
                <hr>

</form>
</article><!-- /widget -->
        </div>


      </div> <!-- /row -->


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
