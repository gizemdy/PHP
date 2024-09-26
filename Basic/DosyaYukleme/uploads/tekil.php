
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

    </head>
    <body>
        <form action="tekil.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <input type="submit" Value="Dosya Yükle" name="submit">
        </form>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $target_dir = "uploads/";

        $uploadOk = 1;
        $imageFilesType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

        $newFileName = uniqid() . '_' . time() . '.' . $imageFilesType;
        $target_file = $target_dir . $newFileName;

        if(file_exists($target_file)){
            echo "Dosya zaten mevcut.";
            $uploadOk = 0;
        }

        if($_FILES["fileToUpload"]["size"] > 5000000){
            echo "Dosya boyutu en fazla 5 MB olmalı!";
            $uploadOk =0;

        }
        if($imageFilesType != "jpg" &&  $imageFilesType != "png" &&  $imageFilesType != "jpeg") {
            echo "Sadece jpeg, jpg, png türüne izin vardır.";
            $uploadOk = 0;
        }
        if($uploadOk == 0){
            echo "Dosya yüklenemedi";
        }else{
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
            {
                echo "Dosya '".htmlspecialchars(basename($newFileName))."' başarılı şekilde yüklendi";
            }
            else{
                echo "Dosya yükleme hatası!";
                }
            }

        }
    ?>
        
</body>
</html>
