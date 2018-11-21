<?php

    // Retreive data from dataset
    //2018 Hansrenee WIllysandro 
    //DSS specAI Universitas Multimedia Nusantara

    //debugging for main purpose only

    require("kelasFungsi.php");

    $library = new kelasFungsi("1jtdan1.5jt", 'gaje', 'ehhh');

    
    $library->sortingHarga($library->ambilData());

    // $file = file('gsmarena_dataset.csv');

    // foreach($file as $z){
    //     $csv[]= explode(',', $z);
    // }
    // echo count($csv);

?>