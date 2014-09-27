<?php
include("command.php");
include("check.php");

$name = $_GET['name'];

// if (!checkIfExist($name)) {
// 	echo "Failure: VM is not exist";
// 	exit();
// }

$xml = simplexml_load_file('status.xml');

deleteInXML($xml,$name);
delete($name);

function deleteInXML($xml,$name){

	for ($i=0; $i < count($xml->host) ; $i++) { 
		if ($xml->host[$i]->name == $name) {
			unset($xml->host[$i]);   
			break ;
		}
	}

	$xml_text=$xml->asXML();
	$fp = fopen("status.xml","w");
	fwrite($fp, $xml_text);
	fclose($fp);
}

function delete($name){
	$stopStr="virsh destroy ".$name;
	$undefineStr = "virsh undefine ".$name;
	$rmimgStr = "rm -rf /var/lib/libvirt/images/".$name.".img";
	run($stopStr);}

?>