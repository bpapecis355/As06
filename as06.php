<?php 

main();

#-----------------------------------------------------------------------------
# FUNCTIONS
#-----------------------------------------------------------------------------
function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	// line below stopped working on CSIS server
	// $json_string = file_get_contents($apiCall); 
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
	$data = $obj->Countries;
	$sorted  = rsort($data);
	// echo html head section
	echo '<html>';
	echo '<head>';
	echo '	<link rel="stylesheet" href="as06style.css" type="text/css" />';
	echo '</head>';
	
	// open html body section
	echo '<body onload="loadDoc()">';
	
	echo '<table style="width:25%">' ;
	echo ' <tr> ';
	echo ' <th> Country Name </th> ';
	echo ' <th> # of Cases </th> ';
	echo ' </tr> ';
	echo ' <tr> ';
function comparator($object1, $object2) { 
    return $object1->TotalConfirmed > $object2->TotalConfirmed; 
} 
usort($data, 'comparator');
$y = count($data) - 1;
	for ($x = $y; $x >= $y - 10; $x--){

	
	echo ' <td> ' . $data[$x]->Country  ;
	echo ' </td> ';

	echo ' <td> ' . $data[$x]->TotalConfirmed;
	echo ' </td> ';
	
	echo ' </tr> ';
	}
	echo '</table>';
		
	// close html body section
	echo '</body>';
	echo '</html>';
}


#-----------------------------------------------------------------------------
// read data from a URL into a string
function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>












