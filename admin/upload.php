<?php
include_once '../includePackage.php';
include_once 'libs/PHPExcel.php';
include_once 'upload.class.php';
session_start();
if(isset($_SESSION[DOMAIN]['login'])&&DOMAIN==$_SESSION[DOMAIN]['login']) {
    if(isset($_FILES['product-img'])){
        $fileName=md5_file($_FILES['product-img']['tmp_name']);
        $uploader=new uploader('product-img');
        $uploader->upFile($fileName);
        $inf=$uploader->getFileInfo();
        if($inf['size']>400000){
            compactImg($inf['url']);
        }
        echo json_encode($inf);
        exit;
    }

}
function compactImg($path){
    mylog('too big');
}
?>