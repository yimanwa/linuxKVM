<?php

$myfile = fopen("status", "r") or die("Unable to open file!");

$status = array();

fgets($myfile);

while(($line = fgets($myfile))!='') {
	$line = ltrim($line);
	$line = rtrim($line);
	array_push($status, split(' ', $line));
}
fclose($myfile);

$output = json_encode($status);

echo $output;
?>