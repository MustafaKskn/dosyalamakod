<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DOSYA KAYIT ETME</title>
</head>
<body>
    <form method="post" action="kayıtet.php"  enctype="multipart/form-data">
    <table class="table1">
	
	<tr>
		<td><label style="color:#3a87ad; font-size:18px;">Dosya Seçin</label></td>
		<td width="30"></td>
		<td><input type="file" name="resim"></td>
	</tr>
</table><br />
<button type="submit" name="Submit" >Yükle</button>
</form>
</body>
</html><br /><br /><br />
<?php
ini_set ( 'display_errors' , 1 ); 
ini_set ( 'display_startup_errors' , 1 ); 
error_reporting ( E_ALL );  

include('vt_baglanti.php');
if (isset($_POST['sil'])) {

            foreach ($_POST["sil"] as $id){
                
                

                $stmt = $conn->prepare("SELECT dosyaad FROM tbl_resim WHERE tbl_resim_id=?  "); 
                $stmt->execute([$id]); 
                $row = $stmt->fetch();
                if($row){
                $SilinecekDosyaYolu		=	"../dosyalar/".$row["dosyaad"];
                unlink($SilinecekDosyaYolu);

                 
                $sorgu = $conn->prepare('DELETE FROM tbl_resim  WHERE tbl_resim_id IN (' . $id. ')');
                $sorgu->execute();
                echo "<script>alert('Dosya başarıyla silindi iyi günler dileriz! ');</script>";}
            
            }
   


        
    
        
        
    if($silinecekler){
        $DosyaSorgusu	=	$conn->prepare("SELECT * FROM tbl_resim WHERE tbl_resim_id = ?");
		$DosyaSorgusu->execute([$silinecekler]);
		$DosyaSayisi	=	$DosyaSorgusu->rowCount();
		$DosyaKaydi	=	$DosyaSorgusu->fetch(PDO::FETCH_ASSOC);

		$SilinecekDosyaYolu		=	"../dosyalar/".$DosyaKaydi["dosyaad"];//dosyalar sizin oluşturacağınız yerel dosyadır

		$DosyaSilme	=	$conn->prepare("DELETE FROM tbl_resim WHERE tbl_resim_id = ? ");
		$DosyaSilme->execute([$silinecekler]);
		$DosyaSilmeKontrol		=	$DosyaSilme->rowCount();
        
		if($DosyaSilmeKontrol){
            
            unlink($SilinecekDosyaYolu);}}
            
			
            
        	
   
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <form action="" method="post">
            <button type="submit" class="btn btn-danger my-3"> Seçilenleri Sil</button><br />

            <table class="table table-bordered">
                <thead>
                <tr>
                <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="">
                    
                    
                    <th>Secim</th>
                    <th>No</th>
                    <th>Uzantılı dosya adı</th>
                    <th>Dosya türü</th>
                    <th>Dosya boyutu</th>
                </tr>
                </thead>
                <tbody>
                <?php
                
                $sorgu = $conn->prepare("SELECT * from tbl_resim ");
                $sorgu->execute();
                while ($sonuc = $sorgu->fetch()) {
                    ?>
                    <tr>
                        <td>
                            <input class="cbSil" type="checkbox" name="sil[]" value="<?= $sonuc['tbl_resim_id']; ?>">
                        </td>
                        <td><?= $sonuc["tbl_resim_id"] ?></td>
                        <td><?= $sonuc["dosyaad"] ?></td>
                        <td><?= $sonuc["tip"] ?></td>
                        <td><?= $sonuc["byte_boyutu"] ?></td>
                        

                        
                       
                    </tr>
                    <?php
                    
                 }
                 

                ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript">
    //Tümünü seçme işlemi yapan script kodları:
    $(document).ready(function () {
        $('#tumunuSec').on('click', function () {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            } else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });
    });
    
</script>
</body>
</html>