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
  }

?>