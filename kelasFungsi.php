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
    //         [16] => display_resolution
    //         [17] => display_size
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
    //2018 Hansrenee Willysandro 
    // DSS specAI Universitas Multimedia Nusantara

    class kelasFungsi{

        
        public function __construct($budget_pilihan, $keperluan_pilihan, $layar_pilihan){
            $this->budget_pilihan = $budget_pilihan;
            $this->keperluan_pilihan = $keperluan_pilihan;
            $this->layar_pilihan = $layar_pilihan;
            
            
        }

        public function ambilData(){
            $file = file('gsmarena_dataset.csv');

            foreach($file as $z){
                $tampungcsv[]= explode(',', $z);
            }
            return $tampungcsv;
        }

        public function displayData(){

        }

        public function tampungLoopData($harga1, $harga2, $tampungcsv){
            $arrTampung;
            for($i = 1;$i<count($tampungcsv);$i++){
                if(($tampungcsv[$i][38] >= $harga1)   && ($tampungcsv[$i][38] <= $harga2)){
                    $arrTampung[$i] = $tampungcsv[$i];
                }
            }
            return $arrTampung;
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
                if($tampungcsv[$i][38] > 10000000){
                    $arrTampung[$i] = $tampungcsv[$i];
                }
            }
            return $arrTampung;
        }

        public function sortingHarga($data_tampung){
            if($this->budget_pilihan == '1jtdan1.5jt'){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(1000000), $this->RupiahToDolar(1500000), $data_tampung);
                var_dump($tampung);
                
            } else if($this->$this->budget_pilihan == "2jtdan2.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(2000000), $this->RupiahToDolar(2500000), $data_tampung);
            } else if($this->budget_pilihan == "3jtdan3.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(3000000), $this->RupiahToDolar(3500000), $data_tampung);
            } else if($this->budget_pilihan == "4jtdan4.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(4000000), $this->RupiahToDolar(4500000), $data_tampung);
            } else if($this->budget_pilihan=="5jtdan5.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(5000000), $this->RupiahToDolar(5500000), $data_tampung);
            } else if($this->budget_pilihan =="6jtdan6.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(6000000), $this->RupiahToDolar(6500000), $data_tampung);
            } else if($this->budget_pilihan =="7jtdan7.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(7000000), $this->RupiahToDolar(7500000), $data_tampung);
            } else if($pulihan == "8jtdan8.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(8000000), $this->RupiahToDolar(8500000), $data_tampung);
            } else if($this->budget_pilihan == "9jtdan9.5jt"){
                $tampung = $this->tampungLoopData($this->RupiahToDolar(9000000), $this->RupiahToDolar(1500000), $data_tampung);
            } else { //pilihan 10 juta keatas
                $tampung = $this->richMan();
            }
        }

        public function sortingLayar(){

        }

        public function kalkulasiAHP(){

        }
        
    }














?>