<?php
    
    $htmlMentah= file_get_contents("https://www.kimovil.com/en/samsung-galaxy-j7-max/antutu");
    libxml_use_internal_errors(true);

    //echo $htmlMentah;
    $HTMLParse = new DOMDocument();
    $HTMLParse->loadHTML($htmlMentah);  

    $elemen = $HTMLParse->getElementsByTagName("h2");
    foreach ($elemen as $table) 
{ 
    echo DOMValue($table); 
} 

    $nama_kelas = "h1";
    $finder = new DomXPath($HTMLParse);
    $spaner = $finder->query("//*[contains(@class, '$nama_kelas')]");



    // $stringLINK;
    // $stringLinkTampung;
    // foreach($spaner as $links){
    //     //$links->getAttribute('href');
    //     foreach($links->attributes as $arr){
    //         $name = $arr->nodeName;
    //         $value = $arr->nodeValue;
    //         //echo $name;

    //         // $stringLINK = explode("/", $value);
    //         // $stringLinkTampung = $stringLinkTampung. $stringLINK[1] ."\n";
    //         echo $value ."<br>";
    //     }
    // }
?>