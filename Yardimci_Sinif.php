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

      //Xssl açığı kapatma, form güvenliği 
      function html_temizle($veri){
          
        if($veri == ' " ' && $veri == " ' " || empty($veri) || $veri == " "){

            echo "hatalı";
        }
          
        else{
      
            $form_kontrol = strip_tags(htmlentities(htmlspecialchars($veri)));

            $xssl_karakterler = array(
                '?','&','gt',';','&quot','&lt','&gt','amp','"',
            );
            $temizle = array(
                '', '', '', '', '', '','','','',
            );
            return str_replace($xssl_karakterler,$temizle, $form_kontrol);
          
        }      
    
      }
/* 
Şifre oluştur düzenlenecek.
*/
      function sifre_olustur($sifre){ 
        $encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
        $secret_key = '11*_33'; //sifreleme anahtari
        $secret_iv = '22-=**_'; //gerekli sifreleme baslama vektoru
        $key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
        $iv = substr(hash('sha256', $secret_iv), 0, 16); 
        
        $sifrelendi = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);        
        
        $sifre_cozuldu = openssl_decrypt($sifrelendi,$encrypt_method, $key, false, $iv);
        
      }
  }

?>