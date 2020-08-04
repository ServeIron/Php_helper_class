<?php 
  
  class Yardimci_Sinif {

    function turkish_convert($text){

        $turkishCharacter = array(
          'ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü'
        );
        $latinCharacter = array(
          'c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U'
        );
      
        return str_replace($turkishCharacter, $latinCharacter, $text);
      }

      function seo_url_create($content){

        $arrayConvert =  explode(" ", $content);
        $reserve = implode("-",$arrayConvert);
        $result = mb_strtolower($reserve,"UTF-8");

        return $this->turkish_convert($result);
      }

   
      function xss_clear(){

        $getNumArg = func_num_args();

        for($i =0; $i < $getNumArg; $i++){

              $getArg = func_get_arg($i);
              $formControl = strip_tags(htmlentities(htmlspecialchars($getArg)));
              $xssChars = array(
                  '?','&','gt',';','&quot','&lt','&gt','amp','"',"'"
              );
              $clear = array(
                  '',
              );

            $result[] = str_replace($xssChars,$clear, $formControl);        
 
        }
         return $result;
    
      }

  
      function encrypt($sifre,$control = true){ 

        $encrypt_method = 'AES-256-CBC';
        $secret_key = '11*_33'; 
        $secret_iv = '22-=**_'; 
        $key = hash('sha256', $secret_key); 
        
        $iv = substr(hash('sha256', $secret_iv), 0, 16);     
        $encrypted = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);  
        $decrypt = openssl_decrypt($encrypted,$encrypt_method, $key, false, $iv);

          if($control == true){      

            return $encrypted;
          }
          else if($control == false){

            return $decrypt;

          }
                
      }


      function tc_id($get_tc){

        $arr = str_split($get_tc);
    
        if(count($arr) == 11 && is_int($get_tc)){
    
            $sum = array_sum($arr);    
            $ten = ((($arr[0] + $arr[2] + $arr[4] + $arr[6] + $arr[8]) * 7) - ($arr[1] + $arr[3] + $arr[5] + $arr[7])) % 10;     
            $eleven = ($sum - $arr[10]) % 10;    
            echo $ten == $arr[9] && $eleven == $arr[10] ? "Tc kimlik numarası doğru." : "Tc kimlik numarası yanlış";
    
           
        }
        else{    
            echo "Girdiğiniz değer 11 haneli ve rakam olmalı.";            
         }
      
    }


      function multi_file_up($fileSetName,$file_type,$file_size,$file_base){

        if($_POST["submit"])
        {
            $filecount = count($_FILES[$fileSetName]['name']);
            $file_type_select = $file_type;

            $warning = array();
            $control = array();

            for($i = 0; $i < $filecount; $i++){
                            
                $fileName = substr($_FILES[$fileSetName]['name'][$i],-4,4);
                $fileRandName= rand(0,999999).$fileName;
                $fileSize = $_FILES[$fileSetName]['size'][$i];
                $fileTmp = $_FILES[$fileSetName]['tmp_name'][$i];
                $fileType = explode('.',$_FILES[$fileSetName]['type'][$i]);       
          
                    foreach($fileType as $cek){

                        if(in_array($cek,$file_type_select) === false){

                            $control[] = false;
                            $warning[] = "Dosya tipi uyuşmuyor";  
                        break;

                        }
                        if($fileSize > $file_size) {
                            $control[] = false;
                            $warning[] = "Dosya boyutu fazla.";
                        break;
                    
                        }
                        $fileGetName[] = $fileRandName;
                        $file_tp[] = $fileTmp;                                
                    }                
                  } 
                    if(in_array(false,$control)){                    
                        return $warning;                    
                    }
                    else 
                    {
                        for($k = 0; $k < count($fileGetName); $k++){
                          move_uploaded_file($file_tp[$k],$file_base.$fileGetName[$k]);                        
                        }
                    return $fileGetName;
                  }

          }
      }




 
  }

