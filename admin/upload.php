<?php
include_once '../includePackage.php';
include_once 'libs/PHPExcel.php';
include_once 'upload.class.php';
session_start();
if(isset($_SESSION[DOMAIN]['login'])&&DOMAIN==$_SESSION[DOMAIN]['login']) {
    if(isset($_GET['excel_file'])){
        include_once '../libs/PHPExcel.php';
        $excelReader=new PHPExcel_Reader_Excel2007();
        $excelWriter=new PHPExcel();
        $notInput=array();
        if(!$excelReader->canRead($_FILES['excel-file']['tmp_name'])){
            $excelReader=new PHPExcel_Reader_Excel5();
            if(!$excelReader->canRead($_FILES['excel-file']['tmp_name'])){
                mylog('can\'t read');
            }
            $myExcel=$excelReader->load($_FILES['excel-file']['tmp_name']);
            $currentSheet=$myExcel->getSheet();
            $totalRow=$currentSheet->getHighestRow();
            for($i=1;$i<$totalRow+1;$i++){
                $name=$currentSheet->getCell('A'.$i);
                if($name instanceof PHPExcel_RichText){
                    $name=$name->__toString();
                    mylog('name is richText');
                }
                $phone=$currentSheet->getCell('D'.$i);
                if($phone instanceof PHPExcel_RichText){
                    $phone=$phone->__toString();
                }
                $address=$currentSheet->getCell('B'.$i);
                if($address instanceof PHPExcel_RichText){
                    $address=$address->__toString();
                }
                if($name&&$phone){
                    $updateSuccess=pdoUpdate('user_tbl',array('address'=>$address),array('user_phone'=>$phone,'category'=>1),'limit 1');

                    if(!$updateSuccess){
                        $notInput[]=array('name'=>$name,'phone'=>$phone);
                        mylog($name.': '.$phone);
                    }
                }


            }
            if(count($notInput)>0){

            }

        }
        mylog('excel-file-uploaded');
        echo json_encode($inf);
    }



}
function fileFilter($file, array $type, $size)
{
    if (in_array($file['type'], $type) && $file['size'] < $size) {
        if ($file['error'] > 0) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
?>