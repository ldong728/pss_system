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
                mylog('add');
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
        echo ajaxBack(null,9,'无权限');
        exit;
    }
}

function provider_list($data){
    verifyPms('provider_list');
    mylog(json_encode($data));
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
function product_list($data){
    verifyPms('product_list');
    $back=getList('product_tbl','product_tbl',$data);
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

function getList($tableName, $countTableName, $data)
{
    mylog($data);
    $number = 12;
    $orderby = isset($data['orderby'])&&$data['orderby']?$data['orderby']:'';
    $order = isset($data['order'])&&$data['order']?$data['order']:'';
    $start = $data['page'] * $number;
    $filter = $orderby&&$order?"order by $orderby $order":'';
    $limit = " limit $start,$number";
    $where = isset($data['where'])&&$data['where'] ? $data['where'] : null;
    mylog($where);
    $count = pdoQueryNew($countTableName, array('count(*) as count'), $where, $filter)->fetch()['count'];
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
