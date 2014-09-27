<?php
  
/**  
 * exactra a command by writing the command string to a file which name command
 *   
 */  


$filename = '/var/www/html/virt/command'; 

function run($command)
{
	if (file_exists($filename)) {
	    echo "The file $filename exists";
	    unlink('command');
	} else {
		lock();
		$handle = fopen("command", "w");
		fwrite($handle, $command);
		fclose($handle);
		unlock();
	}
}

function lock(){
	$lock = file("lock");
	while ($lock[0]=="1") {
		$lock = file("lock");
	}
	$lockFile=fopen("lock", "w");
	fwrite($lockFile,"1");
	fclose($lockFile);
}

function unlock(){
	$lockFile=fopen("lock", "w");
	fwrite($lockFile,"0");
	fclose($lockFile);
}

?>
