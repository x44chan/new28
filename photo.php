<?php
	session_start();
	$rawData = $_POST['imgBase64'];
	$filteredData = explode(',', $rawData);
	$unencoded = base64_decode($filteredData[1]);

	$datime = date("YmdHia"); # - 3600*7

	// name & save the image file 
	$fp = fopen('images/'.$_SESSION['acc_id'].'.jpg', 'w');
	fwrite($fp, $unencoded);
	fclose($fp);

?>