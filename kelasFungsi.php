<?php
    // Library fungsi untuk aplikasi DSS specAI
    // ///////////////////////////////////////
    // Format Kolom CSV dalam indeks array: 
    //         [0] => brand
    //         [1] => model
    //         [2] => network_technology
    //         [3] => 2G_bands
    //         [4] => 3G_bands
    //         [5] => 4G_bands
    //         [6] => network_speed
    //         [7] => GPRS
    //         [8] => EDGE
    //         [9] => announced
    //         [10] => status
    //         [11] => dimentions
    //         [12] => weight_g
    //         [13] => weight_oz
    //         [14] => SIM
    //         [15] => display_type
    //         [16] => display_resolution // inchi, tapi harusnya kebalik ama indeks 17
    //         [17] => display_size // resolusi, tapi harusnya kebalik ama indeks 16
    //         [18] => OS
    //         [19] => CPU
    //         [20] => Chipset
    //         [21] => GPU
    //         [22] => memory_card
    //         [23] => internal_memory
    //         [24] => RAM
    //         [25] => primary_camera
    //         [26] => secondary_camera
    //         [27] => loud_speaker
    //         [28] => audio_jack
    //         [29] => WLAN
    //         [30] => bluetooth
    //         [31] => GPS
    //         [32] => NFC
    //         [33] => radio
    //         [34] => USB
    //         [35] => sensors
    //         [36] => battery
    //         [37] => colors
    //         [38] => approx_price_EUR
    //         [39] => img_url
    //         [40] => ---->kosong dari database csvnya
    // dataset diambil dari database GSM arena resmi tahun 2017
    // 2018 Hansrenee Willysandro 
    // DSS specAI Universitas Multimedia Nusantara

    class kelasFungsi{

        
        //bangun parameter konstruktor
        public function __construct($budget_pilihan, $keperluan_pilihan, $layar_pilihan){
            $this->budget_pilihan = $budget_pilihan;
            $this->keperluan_pilihan = $keperluan_pilihan;
            $this->layar_pilihan = $layar_pilihan;
        }
////////////////////////////PROSES PENGAMBILAN DATA////////////////////////////////////////////////////
        public function ambilData(){
            //$file = file('gsm_arena_example.csv');
            $file = file("gsmarena_dataset.csv");
            foreach($file as $z){
                $tampungcsv[]= explode(',', $z);
            }
            return $tampungcsv;
        }

        public function displayData(){

        }

        //buat clean layar
        public function dataCleansing($data_tampung){

            $bersih = explode(' ', $data_tampung);
            return intval($bersih[0]);

        }

        public function dataCleansingBatre($data_tampung){
            $bersih = explode(' ', $data_tampung);
            if($bersih[2] == null){
                return 0;
            } else {
                return intval($bersih[2]);
            }
        }

        public function dataClenasingKamera($data_tampung){
            $bersih = explode(' ', $data_tampung);
            if($bersih[0] == null || $bersih[0]==""){
                return 0;
            } else {
                return intval($bersih[0]);
            }
        }

        public function dataCleansingMemory($data_tampung){
            $bersih = explode(' ', $data_tampung);
            if($bersih[0] == null || $bersih[0]==""){
                return 0;
            } else {
                return intval($bersih[0]);
            }
        }
///////////////////////////////////////////////////////////////////////////////////////////////////
        public function tampungLoopHarga($harga1, $harga2, $tampungcsv){
            $arrTampung;

            // for($i=0;$i<10;$i++){
            //     $arrTampung[$i] = $tampungcsv[$i];
            //     //echo var_dump($tampungcsv[$i])."<br><br>";
            // }
            
            $indeksTampung =0;
            for($i = 1;$i<count($tampungcsv);$i++){
                if(($tampungcsv[$i][38] >= $harga1) && ($tampungcsv[$i][38] <= $harga2)){
                    $arrTampung[$indeksTampung] = $tampungcsv[$i];
                    $indeksTampung++;
                }
            }
            //  echo var_dump($arrTampung)."<br><br>";
            return $arrTampung;
        }

        
        public function tampungLoopLayar($inch1, $inch2, $tampungcsv){
            $arrTampung;
            $indeksTampung =0;
            for($i=0;$i<count($tampungcsv);$i++){
                if(($this->dataCleansing(($tampungcsv[$i][16])) >= $inch1) && ($this->dataCleansing($tampungcsv[$i][16]) <=$inch2)){
                    $arrTampung[$indeksTampung] = $tampungcsv[$i];
                    $indeksTampung++;
                }
            }
            if(!isset($arrTampung)){
                return 0;
            } else {
                return $arrTampung;
            }
            
        }

        public function DolarToRupiah($harga){
            $hasilKonversi = $harga * 13500;
            return $hasilKonversi;
        }

        public function RupiahToDolar($harga){
            $hasilKonversi = $harga/13500;
            return $hasilKonversi;
        }

        public function richMan($tampungcsv){
            //fungsi buat orang kaya nyari hp diatas 10 jeti
            $arrTampung;
            for($i = 1;$i<count($tampungcsv);$i++){
                if($tampungcsv[$i][38] > $this->RupiahToDolar(10000000)){
                    $arrTampung[$i] = $tampungcsv[$i];
                }
            }
            return $arrTampung;
        }

        public function sortingHarga($data_tampung){
            if($this->budget_pilihan == '1jtdan1.5jt'){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(1000000), $this->RupiahToDolar(1500000), $data_tampung);
                //var_dump($tampung_sort);
                
            } else if($this->budget_pilihan == "2jtdan2.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(2000000), $this->RupiahToDolar(2500000), $data_tampung);
            } else if($this->budget_pilihan == "3jtdan3.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(3000000), $this->RupiahToDolar(3500000), $data_tampung);
            } else if($this->budget_pilihan == "4jtdan4.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(4000000), $this->RupiahToDolar(4500000), $data_tampung);
            } else if($this->budget_pilihan=="5jtdan5.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(5000000), $this->RupiahToDolar(5500000), $data_tampung);
            } else if($this->budget_pilihan =="6jtdan6.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(6000000), $this->RupiahToDolar(6500000), $data_tampung);
            } else if($this->budget_pilihan =="7jtdan7.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(7000000), $this->RupiahToDolar(7500000), $data_tampung);
            } else if($this->budget_pilihan == "8jtdan8.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(8000000), $this->RupiahToDolar(8500000), $data_tampung);
            } else if($this->budget_pilihan == "9jtdan9.5jt"){
                $tampung_sort = $this->tampungLoopHarga($this->RupiahToDolar(9000000), $this->RupiahToDolar(1500000), $data_tampung);
            } else { //pilihan 10 juta keatas
                $tampung_sort = $this->richMan($data_tampung);
                //var_dump($tampung_sort);
            }
            return $tampung_sort;
        }

        public function sortingLayar($data_tampung){
            if($this->layar_pilihan == "4-4,5"){
                $tampung_sort= $this->tampungLoopLayar(4, 4.5, $data_tampung);
                //echo "berhasil";
                //var_dump($tampung_sort);
            } else if($this->layar_pilihan == "5-5,5"){
                $tampung_sort= $this->tampungLoopLayar(5, 5.5, $data_tampung);
                //var_dump($tampung_sort);
            } else if($this->layar_pilihan == "6-6,5"){
                $tampung_sort= $this->tampungLoopLayar(6, 6.5, $data_tampung);
                //var_dump($tampung_sort);
            } else{
                $tampung_sort= $this->tampungLoopLayar(7, 10, $data_tampung);
                //var_dump($tampung_sort);
            }

            return $tampung_sort;
        }

        public function getKeperluan($value_keperluan){

        }
/////////////////Pengambilan Nilai beban dan tambah/////////////////////////////////////////
        public function getMaxInternal($data_tampung){
            $maxInternal;
            for($i = 0;$i<count($data_tampung);$i++){
                $maxInternal[$i] = $data_tampung[$i]["internal_memori"];
            }

            return $maxInternal;
        }

        public function getMaxLayar($data_tampung){
            $maxLayar;
            for($i = 0;$i<count($data_tampung);$i++){
                $maxLayar[$i] = $data_tampung[$i]["layar"];
            }

            return $maxLayar;
        }

        public function getMaxBatre($data_tampung){
            $max;
            for($i = 0;$i<count($data_tampung);$i++){
                $max[$i] = $data_tampung[$i]["batre"];
            }

            return $max;
        }

        public function getMaxKamera($data_tampung){
            $max;
            for($i = 0;$i<count($data_tampung);$i++){
                $max[$i] = intval($data_tampung[$i]["kamera"]);
            }

            return $max;
        }
        public function getMinBerat($data_tampung){
            $min;
            $indeks_array = 0;
            for($i = 0;$i<count($data_tampung);$i++){
                if(intval($data_tampung[$i]["berat"])!=0){
                    $min[$indeks_array] = intval($data_tampung[$i]["berat"]);
                    $indeks_array++;
                }
                
            }
            return $min;
        }

        public function getMinHarga($data_tampung){
            $min;
            $indeks_array =0;
            for($i = 0;$i<count($data_tampung);$i++){
                if(intval($data_tampung[$i]["harga"])!=0){
                    $min[$indeks_array] = intval($data_tampung[$i]["harga"]);
                    $indeks_array++;
                }
            }
            return $min;
        }

        public function getThreeHP($data_tampung){
            $max;
            //$indeks_array;
            for($i =0;$i<count($data_tampung);$i++){
                if($data_tampung[$i]['hasil_bobot_akhir']==INF){
                    
                    $max[$i] = 0;
                } else {
                    $max[$i] = $data_tampung[$i]['hasil_bobot_akhir'];
                }
            }
            rsort($max);
            return  $max;
        }
///////////////////////////////////////////////////////////////
        public function kalkulasiSAW($data_sorted){
            $hp;
            if($this->keperluan_pilihan =="social_media"){
                
                //buat matriks hp terhadap kriteria
                for($i=0;$i<count($data_sorted);$i++){
                    $hp[$i] = array(
                        "nama" => $data_sorted[$i][0]." ".$data_sorted[$i][1],
                        "url_gambar" => $data_sorted[$i][39],
                        "chipset" => $data_sorted[$i][20],
                        "RAM" => $data_sorted[$i][24],
                        ////////////////array kriteria///////////////////////////////////////
                        "internal_memori" => (int)$this->dataCleansingMemory($data_sorted[$i][23]),
                        "layar" => $this->dataCleansing($data_sorted[$i][16]),
                        "batre" => $this->dataCleansingBatre($data_sorted[$i][36]),
                        "kamera" => $this->dataClenasingKamera($data_sorted[$i][25]),
                        "berat" => $data_sorted[$i][12],
                        "harga" => $data_sorted[$i][38],
                        ////////////////////////////////////////////////////////////////////
                    );
                    //echo var_dump($hp);
                }
                $hp_properties_sorted = $hp;
                $max_internal = max($this->getMaxInternal($hp));
                $max_layar = max($this->getMaxLayar($hp));
                $max_batre = max($this->getMaxBatre($hp));
                $max_kamera = max($this->getMaxKamera($hp));
                $min_berat = min($this->getMinBerat($hp));
                $min_harga = min($this->getMinHarga($hp));

                //echo var_dump($this->getMaxKamera($hp));
                //echo var_dump($min_harga);
                for($z=0;$z<count($hp);$z++){
                    $hp[$z]['internal_memori'] = $hp[$z]['internal_memori']/$max_internal;
                    $hp[$z]['layar'] = $hp[$z]['layar']/$max_layar;
                    $hp[$z]['kamera'] = $hp[$z]['kamera']/$max_kamera;
                    $hp[$z]['batre'] = $hp[$z]['batre']/$max_batre;
                    $hp[$z]['berat'] = $min_berat/$hp[$z]['berat'];
                    $hp[$z]['harga'] = $min_harga/$hp[$z]['harga'];
                }

                //echo var_dump($hp);

                //perkalian bobot kriteria yang ditentukan untuk sosial media
                for($z=0;$z<count($hp);$z++){
                    $hp[$z]['internal_memori'] = $hp[$z]['internal_memori'] * 0.15;
                    $hp[$z]['layar'] = $hp[$z]['layar'] * 0.15;
                    $hp[$z]['kamera'] = $hp[$z]['kamera'] * 0.2;
                    $hp[$z]['batre'] = $hp[$z]['batre'] * 0.2;
                    $hp[$z]['berat'] = $hp[$z]['berat'] * 0.15;
                    $hp[$z]['harga'] = $hp[$z]['harga'] * 0.15;
                }
                //echo var_dump($hp);
                

                //Pertambahan dari hasil perkalian bobot kriteria
                $ListHasil_pertambahanHP;

                for($z=0;$z<count($hp);$z++){
                    $ListHasil_pertambahanHP[$z] = array(
                        "nama" => $hp[$z]['nama'],
                        "hasil_bobot_akhir" => $hp[$z]["internal_memori"]+$hp[$z]["layar"] + 
                        $hp[$z]["kamera"]+$hp[$z]["batre"] + 
                        $hp[$z]["berat"]+ $hp[$z]["harga"]
                    );
                }           
                //echo var_dump($ListHasil_pertambahanHP);

                /////ambil 3 bobot hp terbesar 
                $bobothp = $this->getThreeHP($ListHasil_pertambahanHP);
                $bestHP = array($bobothp[0], $bobothp[1], $bobothp[2]);

                /////looping buat nyari informasi dari 3 HP tersebut////
                $indeks_spec_hp = array();
                //$indeks = 0;
                for($indeks = 0;$indeks<3;$indeks++){
                    for($i =0; $i<count($ListHasil_pertambahanHP);$i++){

                            if($ListHasil_pertambahanHP[$i]["hasil_bobot_akhir"] == $bestHP[$indeks]){
                                $indeks_spec_hp[$indeks] = $i;
                                if($indeks == 2){
                                    break;
                                }
                                //$indeks++;
                                
                            }
                        }
                    }

                
                //echo var_dump($indeks);
                //echo var_dump($bestHP);
                //echo var_dump($ListHasil_pertambahanHP);

                
                /////////////////////print hasil 3 hp terbaik //////////////////////////////////////
                echo var_dump($indeks_spec_hp);     
                for($i=0;$i<3;$i++){
                    echo var_dump($hp_properties_sorted[$indeks_spec_hp[$i]]);
                }           
               

                
            } else if($this->keperluan_pilihan == "gaming"){

            } else{

            }

        }
        
    }


?>