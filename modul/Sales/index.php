<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>


	<link rel="manifest" href="manifest.json">
<script>
(function(p,u,s,h,x){p.pushpad=p.pushpad||function(){(p.pushpad.q=p.pushpad.q||[]).push(arguments)};h=u.getElementsByTagName('head')[0];x=u.createElement('script');x.async=1;x.src=s;h.appendChild(x);})(window,document,'https://pushpad.xyz/pushpad.js');

pushpad('init', 2669);
pushpad('subscribe');
</script>
<?php
	require_once('init.php');
?>
<?php

	$notification = new Pushpad\Notification(array(
  'body' => "Hello world!", # max 120 characters
  'title' => "Website Name", # optional, defaults to your project name, max 30 characters
  'target_url' => "http://example.com", # optional, defaults to your project website
  'icon_url' => "http://example.com/assets/icon.png", # optional, defaults to the project icon
  'ttl' => 604800 # optional, drop the notification after this number of seconds if a device is offline
));

	$notification->broadcast(); 

?>

</head>
<body>
Hallo


</body>
</html>