<script type="application/javascript" src="js/tableController.js"></script>
<script type="application/javascript" src="js/laydate.js"></script>

<div class="block">
    <table class="table">
        <tr><td>开始日期：<input id="start-time"></td><td>截止日期：<input id="end-time"></td><td><button class="button time-search">搜索</button></td></tr>
    </table>
    <div class="space"></div>
    <table class="table sheet">
        <thead>
        <tr>
            <td>时间</td>
            <td>销售单号</td>
            <td>客户姓名</td>
            <td>总价格</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="order-list">
        <tr class="tr-template">
            <td class="content" data-field="create_time"></td>
            <td class="content" data-field="order_id"></td>
            <td class="content" data-field="customer_name"></td>
            <td class="content" data-field="total_fee"></td>
            <td>
                <button class="button detail" data-type="detail">详情</button>
            </td>
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
    <div class="space"></div>
    <table class="table sheet order-table" style="display: none">
        <thead>
        <tr>
            <td>商品名</td>
            <td>序列号</td>
            <td>数量</td>
            <td>状态</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="detail-container">
        <tr class="detail-tr-template">
            <td class="content" data-field="product_name"></td>
            <td class="content" data-field="product_sn"></td>
            <td class="content" data-field="amount"></td>
            <td class="status"></td>
            <td><button class="button stock-out">出库</button></td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"><button class="button detail-print-button print">打印出库单</button></td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    var trElements;
    var detailTrElement;
    var preStockList={};
    $(document).ready(function(){
        initDatePick('#start-time','#end-time');
        trElements=TableController.prepareElement('.tr-template');
        detailTrElement=TableController.prepareElement('.detail-tr-template');
        TableController.init('order_list',handleTableContent);
        TableController.addFilter({delivery_status:0});
        TableController.setNumber(5);
        TableController.setPageEvent();
        TableController.getList();
        registEvent();
    });
    function registEvent(){
        $(document).on('click','.detail',function(){
            var id=$(this).attr('id').slice(3);
            initOrderDetail(id);
        });

        $(document).on('click','.time-search',function(){
            var startTime=$('#start-time').val();
            var endTime=$('#end-time').val();
            if(startTime)TableController.addFilter({0:'create_time>"'+startTime+'"'});
            if(endTime)TableController.addFilter({1:'create_time<"'+endTime+'"'});
            TableController.getList();
        });
        $(document).on('click','.stock-out',function(){
            var _=$(this);
           var id=$(this).attr('id').slice(3);
            stockOut([preStockList[id]],function(back){
                $('#sta'+id).text('已出库');
                _.remove();
            });
            console.log(id);
        });
        $(document).on('click','.print',function(){
            var id=$(this).attr('id').slice(3);
            ajaxPost('stock_out_print',{id:id},function(back){
                $(back).jqprint({debug: false,importCSS:true});
                TableController.getList();
                $('.order-table').hide();
//                location.reload(true);
//                printElement(back);
            });
        })

    }
    function stockOut(data,callback){
        ajaxPost('stock_out',data,function(back){
           var backValue=backHandle(back);
            if(backValue&&callback){
                callback(back);
            }
        });
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
    function initOrderDetail(id){
        ajaxPost('order_detail',{id:id},function(back){
            $('.detail-print-button').attr('id','prt'+id);
            $('.detail-container').empty();
            console.log(back);
            var backValue=backHandle(back);
            if(backValue){
                console.log(backValue);
                $.each(backValue.detail,function(k,v){
                    var element=detailTrElement();
                    var statusName='未出库';
                    if(1==v.status){
                        statusName='已出库';
                        element.find('.stock-out').remove();
                    }else{
                        preStockList[v.order_detail_id]=v;
                    }
                    element.find('.status').text(statusName);
                    element.find('.status').attr('id','sta'+ v.order_detail_id);
                    element.find('.stock-out').attr('id','ord'+ v.order_detail_id);
                    element.find('.content').each(function(id,e){
                        var field=$(e).data('field');
                        $(e).text(v[field]);
                    });

                    $('.detail-container').append(element);
                });
            }
            $('.order-table').show();
        });
    }
    function handleTableContent(back){
        $('.tr-template').remove();
        $.each(back.list,function(k,v){
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.print').attr('id', 'prt'+v.order_id);
            element.find('.detail').attr('id', 'dtl'+v.order_id);
            $('.order-list').append(element);
        });
    }

</script>

