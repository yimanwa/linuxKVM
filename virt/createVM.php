<?php

include("command.php");
include("check.php");

$xml = simplexml_load_file('status.xml');

$name = $_GET['name'];
$memory = $_GET['memory'];
$belong = $_GET['belong'];
$disk = $_GET['disk'];
$port = randomPort($xml);
$sysType=$_GET['type'];

if (checkIfExist($name)) {
	echo "Failure: VM exist";
	exit();
}

create($name,$port,$memory,$disk,$sysType);
writeToXML($xml,$name,$port,$belong,$memory,$disk);
echo $port;

// add An VM detail to status.XML
function writeToXML($xml,$name,$port,$belong,$memory,$disk){
	$host = $xml ->addChild('host');
	$host->addChild('name',$name);
	$host->addChild('memory',$memory);
	$host->addChild('belong',$belong);
	$host->addChild('port',$port);
	$host->addChild('status','on');
	$host->addChild('disk',$disk);
	$xml_text=$xml->asXML();
	$fp = fopen("status.xml","w");
	fwrite($fp, $xml_text);
	fclose($fp);
}


//return an VM port which is not exist in status.XML
function randomPort($xml){
	
	$ports=array();
	
	for ($i=0; $i < count($xml->host) ; $i++) { 
		array_push($ports, $xml->host[$i]->port);
	}

	$rdPort = 5900;
	$rdPortStr = strval($rdPort);

	while (in_array($rdPortStr, $ports)) {
		$rdPort ++;
		$rdPortStr = strval($rdPort);
	}
	return $rdPortStr ;
}


//create an VM by using command()
function create($name,$port,$memory,$disk,$sysType) {	
	switch ($sysType) {
		case 'win7':
			$img_link = "/var/lib/libvirt/images/win7.iso";
			break;

		case 'Centos':
			$img_link = "/var/lib/libvirt/images/centos.iso";
			break;

		default:
			$img_link = "/var/lib/libvirt/images/win7.iso";
			break;
	}

	$commandStr = 'virt-install --name ' .$name. ' --ram '.$memory. ' --vcpus=2 --disk path=/var/lib/libvirt/images/' .$name. '.img,size=' .$disk.' --cdrom ' .$img_link. ' --graphics spice,port='.$port;
	run($commandStr);
}

?>