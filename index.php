<?php 

include "Yardimci_Sinif.php";

$cek = new Yardimci_Sinif();



$metin = "Bu bir deneme yazısı ğşl";
echo $cek->seo_url_olustur($metin);
?>