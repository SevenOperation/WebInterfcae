<?php
$target_dir = "/var/www/html/WebInterface/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1 ;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        if($check[0] != $check[1]){
         echo "But width and height are not the same Uploading Aborted ";
         return;
        }
        # if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        #echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    #} else {
    #    echo "Sorry, there was an error uploading your file.";
    #}
    #} else {
    #    echo "File is not an Image.";
    #    $uploadOk = 0;
    }
?>