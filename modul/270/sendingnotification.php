<!DOCTYPE html>

<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
?>
<?php

$query = "SELECT * FROM push_notification order by pk DESC LIMIT 1";
$result = mysql_query($query,$Link) or die(mysql_error($Link));
        $row = mysql_fetch_assoc($result);

        $title = $row['title'];
        $body = $row['description'];
        $link = $row['link'];

?>
<html>
<head>
	<title>
		
	</title>


	<link rel="manifest" href="manifest.json">
<script>
(function(p,u,s,h,x){p.pushpad=p.pushpad||function(){(p.pushpad.q=p.pushpad.q||[]).push(arguments)};h=u.getElementsByTagName('head')[0];x=u.createElement('script');x.async=1;x.src=s;h.appendChild(x);})(window,document,'https://pushpad.xyz/pushpad.js');

pushpad('init', 2832);
pushpad('subscribe');
</script>
<?php
	require_once('init.php');
?>
<?php

	$notification = new Pushpad\Notification(array(
  'body' => $body, # max 120 characters
  'title' => $title, # optional, defaults to your project name, max 30 characters
  'target_url' => $link, # optional, defaults to your project website
  'icon_url' => "", # optional, defaults to the project icon
  'requireInteraction' => 'true',
  'ttl' => 604800 # optional, drop the notification after this number of seconds if a device is offline
));
    $testTag = GIS;
	$newTemp = $rowMac['Mac'];
	$notification->broadcast(["tags" => ["$testTag"]]);	
	echo "<meta http-equiv='refresh' content='0; url=?page=MarketingCampaign'>";

?>

</head>

</html>