<?php

    // Retreive data from dataset
    //2018 Hansrenee WIllysandro 
    //DSS specAI Universitas Multimedia Nusantara

    //debugging for main purpose only:
    error_reporting(E_ERROR | E_PARSE);
    /////////////////////////////
    require("kelasFungsi.php");


    $library = new kelasFungsi($_POST['list_harga'], $_POST['list_penggunaan'], $_POST['layar_pilihan']);

    
    $data = $library->ambilData();
    
    $data_clean1 = $library->sortingHarga($data);
    //echo var_dump($data_clean1);
    if($data_clean1!=0){
        $data_clean2 = $library->sortingLayar($data_clean1);
        //echo var_dump($data_clean2);
        if($data_clean2!=0){
            $library->kalkulasiSAW($data_clean2);
        } else {
            echo "HP di range layar tersebut tidak ditemukan";
            //time_sleep_until(20000);
            //echo "<script>window.location.assign('index.html/')</script>";   
        }
    } else {
        echo "HP di range tersebut tidak ada Coba memilih ketentuan yang lain";
    }
    
    

 
    //echo var_dump($data_clean2);
    //echo var_dump($data_clean2);
    //echo $data_clean2[0];
    //echo var_dump($data_clean2);
    //$library->sortingHarga($library->ambilData());

    // $file = file('gsmarena_dataset.csv');

    // foreach($file as $z){
    //     $csv[]= explode(',', $z);
    // }
    // echo count($csv);

?>