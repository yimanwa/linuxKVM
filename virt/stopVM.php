<?php
include("command.php");

$vmName = $_GET['name'];

stop($vmName);

function stop($vmName){
	$comStr="virsh destroy ".$vmName;
	run($comStr);
}

?>