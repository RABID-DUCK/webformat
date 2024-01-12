<?php

if(isset($_POST['image'], $_POST['image_tmp_name'], $_POST['hash'])){
    $image = $_POST['image'];
    $image_tmp_name = $_POST['image_tmp_name'];
    $hash = $_POST['hash'];

    if($hash === hash_file('sha1', $image)){
        echo "Файл получен!";
    }else{
        echo "Файл был повреждён :(";
    }
}
