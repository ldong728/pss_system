<?php global $caigouId ?>

<script>
    var caigouId=<?=$caigouId?>;
</script>
<style>
    .hidden{
        display: none;;
    }
    .img {
        width: 30px;
        height: auto;
    }
</style>
<div class="block">
    <table class="table">
        <tr>
            <td>订单号：<input type="number" class="caigou-id-input">
                <button class="button button-after-input caigou-id-search">搜索</button>
            </td>
        </tr>
    </table>
    <div class="space"></div>
    <table class="table hidden sheet">
        <tr>
            <td>供应商：</td>
            <td class="info" data-field="provider_name"></td>
            <td>联系电话：</td>
            <td class="info" data-field="tel"></td>
        </tr>
        <tr>
            <td>地址：</td>
            <td colspan="3" class="info" data-field="address"></td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td class="info" data-field="create_time"></td>
            <td>总价格：</td>
            <td>￥<span class="info" data-field="total_fee"></span></td>
        </tr>
        <tr>
            <td>交货时间：</td>
            <td class="info" data-field="delivery_time"></td>
            <td>备注：</td>
            <td><span class="info" data-field="remark"></span></td>
        </tr>
    </table>
    <div class="space">
    </div>
    <div class="head hidden">订单详情</div>
    <table class="table sheet hidden">
        <thead>
        <tr>
            <td>图片</td>
            <td>产品名</td>
            <td>序列号</td>
            <td>单价</td>
            <td>数量</td>
            <td>单位</td>
        </tr>
        </thead>
        <tbody class="caigou-detail">
        <tr class="tr-template">
            <td><img class="img"></td>
            <td data-field="name"></td>
            <td data-field="sn"></td>
            <td data-field="price"></td>
            <td data-field="amount"></td>
            <td data-field="unit"></td>
        </tr>
        </tbody>
        <tfoot>
        <tr><td colspan="6"><button class="button print">打印销售单</button></td> </tr>
        </tfoot>

    </table>


</div>
<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var trelemnt;
    $(document).ready(function(){
        trElement = TableController.prepareElement('.tr-template');
        registEvent();
        if(caigouId)getCaigouDetail(caigouId);
    });
    function registEvent(){
        $(document).on('click','.caigou-id-search',function(){
            var id=$('.caigou-id-input').val();
            caigouId=id;
            getCaigouDetail(id);
        });
        $(document).on('click','.print',function(){
            ajaxPost('caigou_print',{id:caigouId},function(back){
                $(back).jqprint({debug: false,importCSS:true});
            });
        });
    }
    function getCaigouDetail(caigouId){
        $('.caigou-id-input').val(caigouId);
        $('.tr-template').remove();
        ajaxPost('caigou_detail',{id:caigouId},function(back){
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
                    tr.find('img').attr('src', value.img);
                    $('.caigou-detail').append(tr);
                });
                $('.hidden').show();

            }else{
                $('.hidden').hide();
            }
        });
    }




</script>