<?php

function getFiles(){
    if(isset($_POST['image'], $_POST['image_tmp_name'], $_POST['hash'])){
        $image = $_POST['image'];
        $type = getMimeType($image);
        $image_tmp_name = $_POST['image_tmp_name'];
        $hash = $_POST['hash'];

        $allowed_types = array('application', 'model');

        if($hash === hash_file('sha1', $image)){
            if(in_array($type, $allowed_types)){
                echo "Данные файлы не поддерживаются сервером!";
                return;
            }else{
                echo "Файл получен";
            }

        }else{
            echo "Файл был повреждён :(";
        }
    }
}

function getMimeType($file){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file);
    finfo_close($finfo);

    return $mime_type;
}

getFiles();