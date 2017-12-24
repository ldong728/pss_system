<?php
    global $productId;
?>
<script>
    var productId=<?=$productId?>;
</script>
<script type="application/javascript" src="js/tableController.js"></script>
<script type="application/javascript" src="js/laydate.js"></script>
<div class="block">
    <table class="table sheet">
        <tr><td>商品编号<input type="number" class="product-inf input" data-field="sn"><td>开始日期：<input id="start-time"></td><td>截止日期：<input id="end-time"></td></tr>
        <tr><td>商品名：<input class="product-inf input" data-field="name"></td><td>商品价格：<input class="product-inf" data-field="default_price" disabled></td><td>商品库存：<input class="product-inf" data-field="stock" disabled></td></tr>
        <tr><td colspan="3"><button class="button search">搜索</button></td></tr>
    </table>
    <table class="table sheet">
        <thead>
        <tr>
            <td>时间</td>
            <td>类别</td>
            <td>单号</td>
            <td>库存变化</td>
<!--            <td>操作</td>-->
        </tr>
        </thead>
        <tbody class="stock-list">
        <tr class="tr-template">
            <td class="content" data-field="create_time"></td>
            <td class="type"></td>
            <td class="order-purchase-id"></td>
            <td class="content" data-field="amount"></td>
<!--            <td>-->
<!--                <button class="button detail" data-type="detail">详情</button>-->
<!--                <button class="button print" data-type="print">打印</button>-->
<!--            </td>-->
        </tr>
        </tbody>
    </table>
    <table class="table sheet">
        <tr class="unit-table-foot">
            <td colspan="12">
                <div class="page_link">
                    <div class="in">
                        <a href="#" class="page-change" id="prev">上一页</a>
                        <span>共<span class="page-total"></span>页</span>
                        <span>当前第<span class="page-now"></span>页</span>
                        <a href="#" class="page-change" id="next">下一页</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

<script>
    var trElements;
    $(document).ready(function(){
        initDatePick('#start-time','#end-time');
        trElements=TableController.prepareElement('.tr-template');
        TableController.init('stock_detail',handleTableContent);
        TableController.setPageEvent();
//        TableController.getList();
        registEvent();
        init();
    });
    function init(){

        if(productId){
            getProductInf({product_id:productId});
        }
    }
    function registEvent(){
        $(document).on('click','.search',function(){
            var startTime=$('#start-time').val();
            var endTime=$('#end-time').val();
            console.log(startTime);
            if(startTime)TableController.addFilter({0:'create_time>"'+startTime+'"'});
            if(endTime)TableController.addFilter({1:'create_time<"'+endTime+'"'});
            var productInf={};
            $('input.input').each(function(k,v){
                if($(v).val()){
                    var field=$(v).data('field');
                    productInf[k+10]=field+' like "%'+$(v).val()+'%"';
                }
            });
            getProductInf(productInf);
        })

    }
    function initDatePick(start,end){
        laydate({
            elem:start,
            format: 'YYYY-MM-DD hh:mm:ss',
            show:true,
            start:laydate.now(-30)
        });
        laydate({
            elem:end,
            format: 'YYYY-MM-DD hh:mm:ss',
            show:laydate.now(),
            start:laydate.now()
        });
    }
    function getProductInf(data){
        ajaxPost('product_inf',data,function(back){
            var backValue=backHandle(back);
            if(backValue){
                console.log(backValue)
                productId=backValue.product_id;
                $('.product-inf').each(function(k,v){
                    var field=$(v).data('field');
                    $(v).val(backValue[field]);
                });
                TableController.addFilter({product:productId});
                console.log(TableController.filter);
                TableController.getList();
            }else{
                showToast('商品数据错误')
            }
        })
    }
    function handleTableContent(back){
        console.log(back);
        $('.tr-template').remove();
        $.each(back.list,function(k,v){
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.type').text(v['order_id']>0?'销售':'入库');
            element.find('.order-purchase-id').text(v['order_id']||v['purchase']);
//            element.find('.print').attr('id', 'prt'+v.order_id);
//            element.find('.detail').attr('id', 'dtl'+v.order_id);
            $('.stock-list').append(element);
        });
    }

</script>

