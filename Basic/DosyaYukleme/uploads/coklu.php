<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>coklu</title>

    </head>
    <body>
        <form action="coklu.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files" id="files" multiple>
        <br><br>
        <input type="submit" value="submit" value="Dosyaları yukle">
    </form>

    </body>
    </html>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $target_dir = "uploads/";

        $uploadOk = 1;
        $total = count($_FILES['files']['name']);
        for($i=0; $i < $total; $i++){
            
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
            echo "Dosya" . htmlspecialchars(basename
            ($newFileName)). "yuklenemedi . <br>";
        }


    }
       
}
?>
 