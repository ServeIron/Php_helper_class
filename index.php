<?php 
include "Yardimci_Sinif.php";
error_reporting(0);
$cek = new Yardimci_Sinif();

  
$gel = $cek->multi_file_up("name",array("image/png"),50000,'dosya/');
print_r($gel);
?>

<form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="name[]" id="name" multiple />
         <input type="submit" name="submit"/>
      </form>
