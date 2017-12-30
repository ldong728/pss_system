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
            <td>采购单号</td>
            <td>供应商</td>
            <td>总价格</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="caigou-list">
        <tr class="tr-template">
            <td class="content" data-field="create_time"></td>
            <td class="content" data-field="caigou_id"></td>
            <td class="content" data-field="provider_name"></td>
            <td class="content" data-field="total_fee"></td>
            <td>
                <button class="button detail" data-type="detail">详情</button>
                <button class="button print" data-type="print">打印</button>
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
</div>

<script>
    var trElements;
    $(document).ready(function(){
        initDatePick('#start-time','#end-time');
        trElements=TableController.prepareElement('.tr-template');
        TableController.init('caigou_list',handleTableContent);
        TableController.setPageEvent();
        TableController.getList();
        registEvent();
    });
    function registEvent(){
        $(document).on('click','.print',function(){
            var id=$(this).attr('id').slice(3);
            ajaxPost('caigou_print',{id:id},function(back){
                $(back).jqprint({debug: false,importCSS:true});
            });
        });
        $(document).on('click','.detail',function(){
            var id=$(this).attr('id').slice(3);
            var href=getHref('caigou_detail');
            location.href=href+'&caigou_id='+id;
        });
        $(document).on('click','.time-search',function(){
            var startTime=$('#start-time').val();
            var endTime=$('#end-time').val();
            if(startTime)TableController.addFilter({0:'create_time>"'+startTime+'"'});
            if(endTime)TableController.addFilter({1:'create_time<"'+endTime+'"'});
            TableController.getList();
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
    function handleTableContent(back){
        $('.tr-template').remove();
        $.each(back.list,function(k,v){
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.print').attr('id', 'prt'+v.caigou_id);
            element.find('.detail').attr('id', 'dtl'+v.caigou_id);
            $('.caigou-list').append(element);
        });
    }

</script>

