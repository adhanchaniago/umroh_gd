<?php
DEFINE("DBHOST", "localhost"); 
DEFINE("DBUSER", "u4784502_wiwe360");
DEFINE("DBPASS", "infotech");
DEFINE("DBNAME", "u4784502_wiwe360");
$Link=mysql_connect(DBHOST,DBUSER,DBPASS) or die ("Couln't connect to database");
mysql_select_db(DBNAME,$Link);


?>