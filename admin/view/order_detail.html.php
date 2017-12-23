<?php global $orderId ?>

<script>
    var orderId=<?=$orderId?>;
</script>
<style>
    .hidden{
        display: none;;
    }
</style>
<div class="block">
    <table class="table">
        <tr>
            <td>订单号：<input type="number" class="order-id-input">
                <button class="button button-after-input order-id-search">搜索</button>
            </td>
        </tr>
    </table>
    <div class="space"></div>
    <table class="table hidden">
        <tr>
            <td>客户姓名：</td>
            <td class="info" data-field="customer_name"></td>
            <td>联系电话：</td>
            <td class="info" data-field="customer_tel"></td>
        </tr>
        <tr>
            <td>客户地址：</td>
            <td colspan="3" class="info" data-field="customer_address"></td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td class="info" data-field="create_time"></td>
            <td>总价格：</td>
            <td>￥<span class="info" data-field="total_fee"></span></td>
        </tr>
    </table>
    <div class="space">
    </div>
    <div class="head hidden">订单详情</div>
    <table class="table sheet hidden">
        <thead>
        <tr>
            <td>产品名</td>
            <td>序列号</td>
            <td>单价</td>
            <td>数量</td>
            <td>单位</td>
        </tr>
        </thead>
        <tbody class="order-detail">
        <tr class="tr-template">
            <td data-field="product_name"></td>
            <td data-field="product_sn"></td>
            <td data-field="price"></td>
            <td data-field="amount"></td>
            <td data-field="unit"></td>
        </tr>
        </tbody>

    </table>


</div>
<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var trelemnt;
    $(document).ready(function(){
        trElement = TableController.prepareElement('.tr-template');
        registEvent();
        if(orderId)getOrderDetail(orderId);
    });

    function registEvent(){
        $(document).on('click','.order-id-search',function(){
            var id=$('.order-id-input').val();
            getOrderDetail(id);
        });
    }
    function getOrderDetail(orderId){
        $('.order-id-input').val(orderId);
        $('.tr-template').remove();
        ajaxPost('order_detail',{id:orderId},function(back){
            var backValue=backHandle(back);
            if(backValue&&backValue.inf){
                console.log(backValue);
                $('.info').each(function(k,v){
                    $(v).text(backValue.inf[$(v).data('field')]);
                });
                $.each(backValue.detail,function(id,value){
                    var tr=trElement();
                    tr.find('td').each(function(k,v){
                        $(v).text(value[$(v).data('field')]);
                    });
                    $('.order-detail').append(tr);
                });
                $('.hidden').show();

            }else{
                $('.hidden').hide();
            }
        });
    }




</script>