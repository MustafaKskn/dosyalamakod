<?php

 ini_set ( 'display_errors' , 1 ); 
 ini_set ( 'display_startup_errors' , 1 ); 
 error_reporting ( E_ALL );  
 
 require_once ('vt_baglanti.php');
  
 if (isset($_POST['Submit'])>0) {
  
 move_uploaded_file($_FILES["resim"]["tmp_name"],"../dosyalar/" . $_FILES["resim"]["name"]);			
 $dosya=$_FILES["resim"]["name"];
 $boy=$_FILES["resim"]["size"];
 $tip=$_FILES["resim"]["type"];
}if ($boy>0) {
    

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "INSERT INTO tbl_resim (byte_boyutu, tip,dosyaad)
 VALUES ('$boy', '$tip', '$dosya')";
  
 $conn->exec($sql);
 echo "<script>alert('Dosya başarıyla kayıt edildi!!! ');</script>";
 header("Refresh: 1;URL=http://127.0.0.1/dosyalama/dosyalaar/anasayfa.php");
 } 
 else {
    echo "<script>alert('Dosya başarıyla kayıt edilmedi lütfen dosya ekleyiniz!!! ');</script>";
 //header("Refresh: 1;URL=http://127.0.0.1/dosyalama/dosyalaar/anasayfa.php");
 }
 
 ?>