<?php
include('vt_baglanti.php');
if (isset($_POST['sil'])) {
    //Seçilenleri pdo ile toplu silme kodu:
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $conn->prepare('DELETE FROM tbl_resim  WHERE tbl_resim_id IN (' . $silinecekler . ')');
    $sorgu->execute();
    $id=$conn->prepare("SELECT dosyaad FROM tbl_resim where tbl_resim_id in($silinecekler) ");
    $durum=@unlink($id['dosyaad']);
    if ($durum)
        echo "silindi";
    else
        echo "silinemedi";
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
            <button type="submit" class="btn btn-danger my-3"> Seçilenleri Sil</button>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="">
                    </th>
                    <th>No</th>
                    <th>Dosyaadı</th>
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

</body>
</html>