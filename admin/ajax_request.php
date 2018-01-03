<?php
include_once '../includePackage.php';
session_start();
if (isset($_SESSION[DOMAIN]['login'])&&DOMAIN==$_SESSION[DOMAIN]['login']) {

    if(isset($_POST['pms'])&&array_key_exists($_POST['pms'],$_SESSION[DOMAIN]['pms'])){
        if(isset($_POST['method'])){
            switch ($_POST['method']) {
                default:
                    $param=isset($_POST['ajax_data'])?$_POST['ajax_data']:null;
                    $method=trim($_POST['method']);
                    $method($param);
                    break;
            }
        }
        if (isset($_POST['alteTblVal'])) {//快速更改
            $altValues=array();
            foreach ($_POST['col_value'] as $k => $v) {
                $altValues[$k]=addslashes($v);
            }
            $data = pdoUpdate($_POST['tbl'].'_tbl', $altValues, array($_POST['index'] => $_POST['id']),' limit 1');
            if($data){
                echo ajaxBack(array('id'=>$data));
            }else{
                echo ajaxBack(null,1,'记录无法修改');
            }
            exit;
        }
        if (isset($_POST['deleteTblVal'])) {//快速删除
            try{
                pdoDelete($_POST['tbl'].'_tbl', $_POST['value'], ' limit 1');
                                echo ajaxBack();

            }catch(PDOException $e){
                echo ajaxBack(null,1,'记录无法修改');
            }
            exit;
        }
        if (isset($_POST['addTblVal'])) {//快速插入
            try{
                foreach ($_POST['value'] as $k=>$v) {
                    $value[$k]=addslashes($v);
                }
                $id=pdoInsert($_POST['tbl'].'_tbl', $value, $_POST['onDuplicte']);
                echo ajaxBack(array('id'=>$id));
            }catch(PDOException $e){
                echo ajaxBack(null,1,'记录无法修改');
            }
            exit;
        }
        if(isset($_POST['altConfig'])){//快速更改设置
            $path='../config/'.$_POST['name'].'.json';
            $config=getConfig($path);
            if(array_key_exists($_POST['key'],$config)){
                $config[$_POST['key']]=$_POST['value'];
                saveConfig($path,$config);
                echo ajaxBack();
            }else{
                echo ajaxBack(null,'3','不存在的设置项');
            }
            exit;
        }

    }else{
        if('stock_alert'==$_POST['method']){
            product_list($_POST['ajax_data']);
            exit;
        }
        echo ajaxBack(null,9,'无权限');
        exit;
    }
}



function provider_list($data){
    $back=getList('provider_tbl','provider_tbl',$data);
    echo ajaxBack($back);
}
function category_list(){
//    verifyPms(['category_edit','product_list','product_edit']);
    $back=pdoQuery('category_tbl',null,null,'order by p_category asc');
    $back->setFetchMode(PDO::FETCH_ASSOC);
    $back=$back->fetchAll();
    if(!$back){
        $back=[];
    }
    echo ajaxBack($back);
}
function product_inf($data){
    $inf=pdoQueryNew('product_tbl',null,$data,'limit 1')->fetch();
    if($inf){
        echo ajaxBack($inf);
    }else{
        echo ajaxBack(null,1234,'无商品');
    }

}
function product_list($data){
//    verifyPms(['product_list','purchase_add']);
    $back=getList('product_tbl','product_tbl',$data);
    echo ajaxBack($back);
}
function product_provide_list($data){

    $back=getList('product_provider_view',null,$data,false);
    echo ajaxBack($back);
}
function stock_detail($data){
    $back=getList('stock_detail_view','stock_detail_view',$data);
    echo ajaxBack($back);
}
function delete_category($data){
    verifyPms('category_edit');
    $id=$data['id'];
    $query=pdoQueryNew('category_tbl',['category_id'],['p_category'=>$id],'limit 1')->fetch();
    if($query){
        echo ajaxBack(null,21,'不能删除');
    }else{
        pdoDelete('category_tbl',['category_id'=>$id],' limit 1');
        echo ajaxBack('ok');
    }
}
function add_category($data){
    verifyPms('category_edit');
    $name='新类型（双击可更改）';
    $pid=$data['parent_id'];
    $id=pdoInsert('category_tbl',['category_name'=>$name,'p_category'=>$pid],'ignore');
    if($id){
        echo ajaxBack(['id'=>$id,'name'=>$name]);
    }else{
        echo ajaxBack(null,10,'数据库错误');
    }

}
function purchase_add_recode($data){
    verifyPms('purchase_add');
    $provider=$data['provider'];
    $total_price=isset($data['total_price'])?$data['total_price']:0;
    $details=$data['detail'];
    $time=time();
    pdoTransReady();
    try{
        $purchaseId=pdoInsert('purchase_tbl',['provider'=>$provider,'total_price'=>$total_price,'create_time_unix'=>$time,'creator'=>$_SESSION[DOMAIN]['operator_id']],'update');
        if($purchaseId){
            $values=[];
            $valuesStock=[];

            foreach ($details as $k=>$row) {
                $values[$k]=$row;
                $values[$k]['purchase']=$purchaseId;
                $valuesStock[$k]=$values[$k];
                $valuesStock[$k]['create_time_unix']=$time;
                exeNew('update product_tbl set stock=stock+'.$row['amount'].' where product_id='.$row['product']);
            }
            pdoBatchInsert('purchase_detail_tbl',$values);
            pdoBatchInsert('stock_detail_tbl',$valuesStock);
        }
        pdoCommit();
    }catch(PDOException $d){
        mylog($d);
        pdoRollBack();
        echo ajaxBack(null,9,'数据库错误');
    }
        echo ajaxBack('ok');


}
function purchase_list($data){
    $back=getList('purchase_view','purchase_tbl',$data);
    echo ajaxBack($back);
}
function get_purchase_detail($data){
    $purchaseId=$data['where']['purchase_id'];
    if($purchaseId){
        $purchaseInf=pdoQuery('purchase_view',null,['purchase_id'=>$purchaseId],'limit 1')->fetch();
        $purchaseList=pdoQuery('purchase_detail_view',null,['purchase'=>$purchaseId],null);
        $purchaseList->setFetchMode(PDO::FETCH_ASSOC);
        $list=$purchaseList->fetchAll();
        echo ajaxBack(['count'=>0,'page'=>0,'inf'=>$purchaseInf,'list'=>$list]);
    }else{
        echo ajaxBack(null,9,'参数错误');
    }

    mylog($purchaseId);
}
function customer_list($data){
    $back=getList('customer_tbl','customer_tbl',$data);
    echo ajaxBack($back);
}
function customer_detail($data){
    $back=pdoQueryNew('customer_tbl',null,$data,'limit 1')->fetch();
    if($back){
        echo ajaxBack($back);
    }else{
        echo ajaxBack(null,12,'无记录');
    }
}
function order_add($data){
    verifyPms('order_add');
    mylog($data);
    $customer=$data['customer'];
    $detail=$data['detail'];
    $totalPrice=$data['total_price'];
    $discount=$data['discount'];
    $remark=$data['remark'];
    $deliveryTime=$data['delivery'];
    $time=time();
    $orderId=0;
    $productIdList=[];
    $orderDetailValue=[];
    $stockDetailValue=[];
    pdoTransReady();
    try{
        if(is_array($customer)){
            $customerId=pdoInsert('customer_tbl',$customer,'ignore');
        }else{
            $customerId=$customer;
        }

        if($customerId){
            $orderId=pdoInsert('order_tbl',['customer'=>$customerId,'total_fee'=>$totalPrice,'create_time_unix'=>$time,'creator'=>$_SESSION[DOMAIN]['operator_id'],'discount'=>$discount,'remark'=>addslashes($remark),'delivery_time'=>$deliveryTime],'update');
        }
        if($orderId){
            foreach ($detail as $k=>$v) {
                $productIdList[]=$k;
                $orderDetailValue[$k]=['order_id'=>$orderId,'product'=>$v['product'],'amount'=>$v['amount'],];
                $stockDetailValue[$k]=['order_id'=>$orderId,'product'=>$v['product'],'amount'=>-$v['amount'],'create_time_unix'=>$time];
                exeNew('update product_tbl set stock=stock-'.$v['amount'].' where product_id='.$v['product']);
            }
            pdoBatchInsert('order_detail_tbl',$orderDetailValue);
            pdoBatchInsert('stock_detail_tbl',$stockDetailValue);
        }
        echo ajaxBack($orderId);
        pdoCommit();
    }catch(PDOException $e){
        mylog($e->getMessage());
        pdoRollBack();
        echo ajaxBack(null,9,'数据库错误');
    }

//    $pruductInf=pdoQuery('product_tbl',['product_id','default_price'],['product'=>$productIdList],null);



    verifyPms('order_add');

    mylog(json_encode($data,true));
}
function order_list($data){
    $back=getList('order_view','order_view',$data);
    echo ajaxBack($back);
}
function order_detail($data){
    $id=$data['id'];
    $orderInf=pdoQuery('order_view',null,['order_id'=>$id],'limit 1');
    $orderInf->setFetchMode(PDO::FETCH_ASSOC);
    $orderInf=$orderInf->fetch();
    $orderDetail=pdoQuery('order_detail_view',null,['order_id'=>$id],null);
    $orderDetail->setFetchMode(PDO::FETCH_ASSOC);
    $orderDetail=$orderDetail->fetchAll();
    echo ajaxBack(['inf'=>$orderInf,'detail'=>$orderDetail]);
}
function order_print($data){
    global $mypath;
    $id=$data['id'];
    $orderInf=pdoQuery('order_view',null,['order_id'=>$id],'limit 1')->fetch();
    $orderDetail=pdoQuery('order_detail_view',null,['order_id'=>$id],null)->fetchAll();
    if($orderInf){
        include 'view/module/order_print_template.html.php';
    }else{
        echo 'error';
    }

}

function caigou_add($data){
    verifyPms('caigou_edit');
    $caigouDetailList=[];
    $caigouValue=[];
    $remark=$data['remark'];
    $delivery=$data['delivery'];
    foreach ($data['detail'] as $productId=>$row) {
        if(!isset($caigouValue[$row['provider']])){
            $caigouValue[$row['provider']]=['provider'=>$row['provider'],'total_fee'=>($row['amount']*$row['price']),'remark'=>$remark,'delivery_time'=>$delivery];
        }else{
            $caigouValue[$row['provider']]['total_fee']+=$row['amount']*$row['price'];
        }
        $type=isset($row['type'])?$row['type']:'';
        $caigouDetailList[$row['provider']][$row['product']]=['product'=>$row['product'],'price'=>$row['price'],'amount'=>$row['amount'],'type'=>$type];
    }
    pdoTransReady();
    try{
        $detailValue=[];
        foreach ($caigouValue as $providerId=>$row) {
            $caigouId=pdoInsert('caigou_tbl',$row);
            if($caigouId){
                foreach ($caigouDetailList[$providerId] as $pid=>$vElement) {
                    $detailValue[$pid]=$vElement;
                    $detailValue[$pid]['caigou']=$caigouId;
                }
            }
        }
//        mylog($detailValue);
        pdoBatchInsert('caigou_detail_tbl',$detailValue);
        pdoCommit();
        echo ajaxBack('ok');
    }catch(PDOException $e){
        pdoRollBack();
        mylog($e->getMessage());
        echo ajaxBack(null,109,'数据库错误');
    }
//    mylog($caigouDetailList);
//    mylog($caigouValue);

 }
function caigou_list($data){
    $back=getList('caigou_view','caigou_view',$data);
    echo ajaxBack($back);
}
function caigou_detail($data){
    $id=$data['id'];
    $caigouInf=pdoQuery('caigou_view',null,['caigou_id'=>$id],'limit 1');
    $caigouInf->setFetchMode(PDO::FETCH_ASSOC);
    $caigouInf=$caigouInf->fetch();
    $caigouDetail=pdoQuery('caigou_detail_view',null,['caigou'=>$id],null);
    $caigouDetail->setFetchMode(PDO::FETCH_ASSOC);
    $caigouDetail=$caigouDetail->fetchAll();
    echo ajaxBack(['inf'=>$caigouInf,'detail'=>$caigouDetail]);
}
function caigou_print($data){
    global $mypath;
    $id=$data['id'];
    $caigouInf=pdoQuery('caigou_view',null,['caigou_id'=>$id],'limit 1')->fetch();
    $caigouDetail=pdoQuery('caigou_detail_view',null,['caigou'=>$id],null)->fetchAll();
    if($caigouInf){
        include 'view/module/caigou_print_template.html.php';
    }else{
        echo 'error';
    }
}




/*
 *以下为通用方法
 * 非ajax
 */
function verifyPms($pms){
    $query=pdoQuery('pms_view',['f_id'],['f_key'=>$_POST['pms'],'s_key'=>$pms],'limit 1')->fetch();
    if(!$query){
        mylog('ajax 权限错误');
        echo ajaxBack(null,9,'无权限');
        exit;
    }
}

function getList($tableName, $countTableName, $data,$needCount=true)
{
    $number = isset($data['number'])?$data['number']:12;
    $orderby = isset($data['orderby'])&&$data['orderby']?$data['orderby']:'';
    $order = isset($data['order'])&&$data['order']?$data['order']:'';
    $start = $data['page'] * $number;
    $filter = $orderby&&$order?"order by $orderby $order":'';
    $limit = " limit $start,$number";
    $where = isset($data['where'])&&$data['where'] ? $data['where'] : null;
    $count=0;
    if($needCount){
        $count = pdoQueryNew($countTableName, array('count(*) as count'), $where, $filter)->fetch()['count'];
    }
    $query = pdoQueryNew($tableName, null, $where, $filter . $limit);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query = $query->fetchAll();
    $back['list'] = $query;
    $back['count'] = $count;
    $back['page'] = ceil($count / $number);
    return ($back);
}



/*
 * select user_name,user_phone,address FROM duty_view where duty_id in (select content_int from motion_view where attr_name in ("提案人","领衔人","提案联系人") and motion_id in (select motion_id from motion_view where target="unit" and content_int=55))
 */
