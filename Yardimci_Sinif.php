<?php 
  
  class Yardimci_Sinif {

    function turkce_cevir($metin){
        $turkce_karakterler = array(
          'ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü'
        );
        $latin_karsiliklari = array(
          'c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U'
        );
      
        return str_replace($turkce_karakterler, $latin_karsiliklari, $metin);
      }

      function seo_url_olustur($cumle){

        $dizi =  explode(" ", $cumle);
        $ayrac = implode("-",$dizi);
        $sonuc = mb_strtolower($ayrac,"UTF-8");

        return $this->turkce_cevir($sonuc);
      }

   
      function xss_temizle(){

        $gelen_arg_sayisi = func_num_args();
        
        for($i =0; $i < $gelen_arg_sayisi; $i++){
                                 
              $veri = func_get_arg($i);

              $form_kontrol = strip_tags(htmlentities(htmlspecialchars($veri)));

              $xssl_karakterler = array(
                  '?','&','gt',';','&quot','&lt','&gt','amp','"',"'"
              );
              $temizle = array(
                  '',
              );

            $sonucla[] = str_replace($xssl_karakterler,$temizle, $form_kontrol);          
                       
         
        }
  
       return $sonucla;
    
      }

   // true şifreli verir false ise çözer   
      function sifre_olustur($sifre,$kontrol = true){ 

        $encrypt_method = 'AES-256-CBC'; //sifreleme yontemi

        $secret_key = '11*_33'; //sifreleme anahtari

        $secret_iv = '22-=**_'; //gerekli sifreleme baslama vektoru

        $key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
        
        $iv = substr(hash('sha256', $secret_iv), 0, 16);     
        $sifrelendi = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);  

        $sifre_cozuldu = openssl_decrypt($sifrelendi,$encrypt_method, $key, false, $iv);

          if($kontrol == true){      

            return $sifrelendi;
          }
          else if($kontrol == false){

            return $sifre_cozuldu;

          }
                
      }


      function tc_id($get_tc){

        $arr = str_split($get_tc);
    
        if(count($arr) == 11 && is_int($get_tc)){
    
            $toplam = array_sum($arr);
    
            $on = ((($arr[0] + $arr[2] + $arr[4] + $arr[6] + $arr[8]) * 7) - ($arr[1] + $arr[3] + $arr[5] + $arr[7])) % 10; 
    
            $onbir = ($toplam - $arr[10]) % 10;
    
            echo $on == $arr[9] && $onbir == $arr[10] ? "Tc kimlik numarası doğru." : "Tc kimlik numarası yanlış";
    
           
        }
        else{
    
            echo "Girdiğiniz değer 11 haneli ve rakam olmalı.";
            
         }
      
    }



function multi_file_up($file_nme,$file_type,$file_size,$file_base){

            if($_POST["submit"])
            {
                $filecount = count($_FILES[$file_nme]['name']);

                $file_type_select = $file_type;

                $uyari = array();
                $kont = array();

                for($i = 0; $i < $filecount; $i++){
                                
                    $fileName = substr($_FILES[$file_nme]['name'][$i],-4,4);

                    $fileRandName= rand(0,999999).$fileName;

                    $fileSize = $_FILES[$file_nme]['size'][$i];

                    $fileTmp = $_FILES[$file_nme]['tmp_name'][$i];

                    $fileType = explode('.',$_FILES[$file_nme]['type'][$i]);

                        foreach($fileType as $cek){

                            if(in_array($cek,$file_type_select) === false){

                                $kont[] = "false";

                                $uyari[] = "Dosya tipi uyuşmuyor";   
                            
                            break;

                            }

                            if($fileSize > $file_size) {

                                $kont[] = "false";

                                $uyari[] = "Dosya boyutu fazla.";

                            break;
                        
                            }

                            $deneme[] = $fileRandName;

                            $file_tp[] = $fileTmp;
                                    
                        }

                    
                } 
                        if(in_array("false",$kont)){
                        
                            return $uyari;
                        
                        }
                        else 
                        {
                              for($k = 0; $k < count($deneme); $k++)
                              {

                                     move_uploaded_file($file_tp[$k],$file_base.$deneme[$k]);
                                     
                              }
                               
                              return $deneme;
                        }

            }
       }




 
  }

