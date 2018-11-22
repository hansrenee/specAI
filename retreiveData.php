<?php

    // Retreive data from dataset
    //2018 Hansrenee WIllysandro 
    //DSS specAI Universitas Multimedia Nusantara

    //debugging for main purpose only

    require("kelasFungsi.php");

    $library = new kelasFungsi("asdfadsfads", 'ehh', '4-4,5');

    
    //$library->sortingHarga($library->ambilData());
    $library->sortingLayar($library->ambilData());

    // $file = file('gsmarena_dataset.csv');

    // foreach($file as $z){
    //     $csv[]= explode(',', $z);
    // }
    // echo count($csv);

?>