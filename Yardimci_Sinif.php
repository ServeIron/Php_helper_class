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

   
      function html_temizle(){

        $gelen_arg_sayisi = func_num_args();
        
        for($i =0; $i < $gelen_arg_sayisi; $i++){
                                 
              $veri = func_get_arg($i);

              $form_kontrol = strip_tags(htmlentities(htmlspecialchars($veri)));

              $xssl_karakterler = array(
                  '?','&','gt',';','&quot','&lt','&gt','amp','"',
              );
              $temizle = array(
                  '', '', '', '', '', '','','','',
              );

            $sonucla[] = str_replace($xssl_karakterler,$temizle, $form_kontrol);          
                       
         
        }
  
        print_r($sonucla);
    
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

 
  }

