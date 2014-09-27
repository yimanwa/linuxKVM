<?php
$xml = simplexml_load_file('simple.xml');
print_r($xml);
echo $xml->to;

$xml->to = "nobody";
$xml_text = $xml->asXML();
$fp = fopen("simple.xml","w");
fwrite($fp, $xml_text);
fclose($fp);
?>