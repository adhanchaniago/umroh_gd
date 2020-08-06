<?php
DEFINE("DBHOST", "localhost");
DEFINE("DBUSER", "u8846868_hafiza");
DEFINE("DBPASS", "hafiza151015");
DEFINE("DBNAME", "u8846868_umroh");
$Link=mysql_connect(DBHOST,DBUSER,DBPASS) or die ("Couln't connect to database");
mysql_select_db(DBNAME,$Link);

date_default_timezone_set('Asia/Jakarta');

?>
