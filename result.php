<?php

$myfile = fopen("new1.txt", "a") or die("Unable to open file!");

$ch = curl_init();
$timeout=50000;






for ( $roll= "119716"; $roll<120000;$roll++){


//$pass=$_REQUEST['pass'];
$data = array('roll' => "$roll","Result" => "");
$Result = "";
$data=http_build_query($data);
curl_setopt($ch,CURLOPT_URL,"####link_here__#####"); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$data = curl_exec($ch);
//var_dump($data);


$html = $data;
///////////////////////////
$pokemon_doc = new DOMDocument();

libxml_use_internal_errors(TRUE); //disable libxml errors

if(!empty($html)){ //if any html is actually returned

	$pokemon_doc->loadHTML($html);
	libxml_clear_errors(); //remove errors for yucky html
	
	$pokemon_xpath = new DOMXPath($pokemon_doc);

	//get all the h2's with an id
	$pokemon_row = $pokemon_xpath->query('//td');
$r = "";
	if($pokemon_row->length > 0){
		foreach($pokemon_row as $row){
			 $r .= $row->nodeValue . "---- ";
			
		}
	}
}


fwrite($myfile, "\n". $r);


}

echo $r.'<br> ' ; 


////////////////////////////
curl_close($ch);

fclose($myfile);







?>
