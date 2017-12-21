<?php

include_once '../includePackage.php';
include_once 'menu.php';
session_start();
if (isset($_GET['logout'])) {//登出
    unset($_SESSION[DOMAIN]);
    include 'view/login.html.php';
    exit;
}
if (isset($_SESSION[DOMAIN]['login']) && DOMAIN == $_SESSION[DOMAIN]['login']) {
    if (isset($_GET['menu']) && array_key_exists($_GET['menu'], $_SESSION[DOMAIN]['pms'])) {
        $_GET['sub']();
        exit;
    }
    printAdminView('blank.html.php', '管理后台');
    exit;
} else {
    if (isset($_GET['login'])) {
        $name = $_POST['adminName'];
        $pwd = $_POST['password'];
        if ($_POST['adminName'] . $_POST['password'] == ADMIN . PASSWORD) {
            $_SESSION[DOMAIN]['login'] = DOMAIN;
            $_SESSION[DOMAIN]['operator_id'] = -1;
            printAdminView('blank.html.php', '管理后台');
        } else {
            $query = pdoQuery('operator_tbl',array('id'), array('name' => $name, 'md5' => md5($pwd)), ' limit 1');
            $op_inf = $query->fetch();
            if ($op_inf) {
                $_SESSION[DOMAIN]['login'] = DOMAIN;
                $_SESSION[DOMAIN]['operator_id'] = $op_inf['id'];
                printAdminView('blank.html.php', '管理后台');
                exit;
            } else {
                include 'view/login.html.php';
                exit;
            }

        }
        exit;
    }

    include 'view/login.html.php';
    exit;
}

function provider_list(){
    printAdminView('provider_list.html.php','供应商列表');
}
function provider_edit(){
    global $providerInf;
    $providerId=isset($_GET['provider_id'])?$_GET['provider_id']:0;
    $modeName='编辑供应商';
    if($providerId){
        $providerQuery=pdoQuery('provider_tbl',null,['provider_id'=>$providerId],'limit 1');
        $providerQuery->setFetchMode(PDO::FETCH_ASSOC);
        $providerInf=$providerQuery->fetch();
    }else{
        $providerInf=0;
        $modeName='新建供应商';
    }
    printAdminView('provider_edit.html.php',$modeName);
}
function category_edit(){

    printAdminView('category_edit.html.php','分类编辑');
}
function product_list(){
    printAdminView('product_list.html.php','产品列表');
}
function product_edit(){
    global $productInf;
    $productId=isset($_GET['product_id'])?$_GET['product_id']:0;
    $modeName='编辑产品';
    if($productId){
        $productQuery=pdoQuery('product_tbl',null,['product_id'=>$productId],'limit 1');
        $productQuery->setFetchMode(PDO::FETCH_ASSOC);
        $productInf=$productQuery->fetch();
    }else{
        $productInf=0;
        $modeName='新建产品';
    }
    printAdminView('product_edit.html.php',$modeName);
}
function purchase_add(){
    printAdminView('purchase_add.html.php','进货录入');
}
function purchase_list(){
    printAdminView('purchase_list.html.php','进货记录');
}
function purchase_detail(){
    global $purchaseId;
    $purchaseId=isset($_GET['purchase_id'])?$_GET['purchase_id']:0;
    printAdminView('purchase_detail.html.php','进货详情');
}
function customer_list(){
    printAdminView('customer_list.html.php','客户列表');
}
function customer_edit(){
    global $customerInf;
    $customerId=isset($_GET['customer_id'])?$_GET['customer_id']:0;
    $modeName='用户编辑';
    if($customerId){
        $customerQuery=pdoQuery('customer_tbl',null,['customer_id'=>$customerId],'limit 1');
        $customerQuery->setFetchMode(PDO::FETCH_ASSOC);
        $customerInf=$customerQuery->fetch();
    }else{
        $customerInf=0;
        $modeName='新建用户';
    }
    printAdminView('customer_edit.html.php',$modeName);
}

function order_add(){
    printAdminView('order_add.html.php','订单录入');
}

//以下为admin通用方法
function options(){
    global $pmsList,$subMenuList;
    $query=pdoQuery('sub_menu_view',null,null,null);
    foreach ($query as $row) {
        if(isset($row['s_id']))$subMenuList[]=$row;
    }

    $pmsList = pdoQuery('pms_tbl',null,null,null)->fetchAll();
    printAdminView('option.html.php','功能菜单');
}
function operator(){
    global $pmsList,$opList;
    $pms=pdoQuery('pms_tbl',null,null,null);
    foreach ($pms as $row) {
        $pmsList[$row['id']]=$row;
    }

    $op=pdoQuery('op_pms_view',null,null,null);
    foreach ($op as $row) {

        if(!isset($opList[$row['id']])){
            $opList[$row['id']]=$row;
            $opList[$row['id']]['pms']=$pmsList;
        }
        if($row['pms_id'])$opList[$row['id']]['pms'][$row['pms_id']]['checked']='checked';
    }
//    mylog(getArrayInf($opList));
    printAdminView('operator.html.php','操作员管理');

}

