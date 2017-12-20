<?php

include 'includePackage.php';
//$url=isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:$_SERVER['QUERY_STRING'];
//$query_string = explode('/',$url);
//$postData = json_decode(file_get_contents('php://input'), true);
//$postData=!$postData?$_POST:$postData;
//mylog($postData);
//echo json_encode(['error'=>0,'msg'=>'ok']);
//exit;
pdoQueryNew('product_tbl',null,['category>0','product_id'=>'0','or product_id <10'],null);


?>