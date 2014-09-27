<?php

function checkIfExist($vmName){
	$xml = simplexml_load_file('status.xml');
	$vmNames = array();
	for ($i=0; $i < count($xml->host) ; $i++) { 
		array_push($vmNames, $xml->host[$i]->name);
	}

	return in_array($vmName, $vmNames) ;
}
?>