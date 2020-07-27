<?php 

include "Yardimci_Sinif.php";

$cek = new Yardimci_Sinif();

$string = 'denemeYazi';

$encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
$secret_key = '11*_33'; //sifreleme anahtari
$secret_iv = '22-=**_'; //gerekli sifreleme baslama vektoru
$key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
$iv = substr(hash('sha256', $secret_iv), 0, 16); 

$sifrelendi = openssl_encrypt($string,$encrypt_method, $key, false, $iv);


$sifre_cozuldu = openssl_decrypt($sifrelendi,$encrypt_method, $key, false, $iv);

?>