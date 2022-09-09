<?php
error_reporting(0);
$text_title = $_REQUEST['title'];
$final_text = "";
function getmain($text_title){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://en.wikisource.org/w/api.php?action=parse&format=json&page='.$text_title.'&prop=text&formatversion=2',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: GeoIP=NG:LA:Lagos:6.45:3.39:v4; WMF-Last-Access-Global=09-Sep-2022; WMF-Last-Access=09-Sep-2022'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$parse = json_decode($response,true);
// echo $parse->parse
// echo($parse[parse][text]);

//main content
$str = $parse[parse][text];
return $str;



}


// echo $str;

 


// echo $final_output;
function getsub($url){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://en.wikisource.org'.$url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: GeoIP=NG:LA:Lagos:6.45:3.39:v4; WMF-Last-Access-Global=09-Sep-2022; WMF-Last-Access=09-Sep-2022'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
}

function filterAnchor($str){
    
$dom = new DomDocument();
$dom->loadHTML($str);
$output = array();
foreach ($dom->getElementsByTagName('a') as $item) {
   $output[] = array (
      'str' => $dom->saveHTML($item),
      'href' => $item->getAttribute('href'),
      'anchorText' => $item->nodeValue
   );
}

//get all the sub pages or links
$count = 0;
 $fn = "";
while($count <= count($output)){
    $url = $output[$count][href].'<br>';
 
    $atext=  $output[$count][anchorText];
    $aurl = $output[$count][href];
    $fc =  substr($url,0,1);
    if($fc=="/"){
        
        $nu = getsub($atext);
        $nnu = getsub($aurl);
         $fn = $fn."<br><br> <center><b>".$atext."</b></center>".$nu."<br>".$nnu;
    }else{
        // echo "no";
    }
    $count = $count +1;
}

return $fn;
}



$str = getmain($text_title);


$final_text = $final_text.$str;
$new = filterAnchor($str);
$final_text = $final_text.$new;
echo $final_text;









?>