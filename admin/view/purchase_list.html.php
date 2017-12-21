<div class="block">
    <div class="head">
        供应商列表
    </div>
    <table class="table sheet provider-table">
        <tr>
            <th>序号</th>
            <th>供应商</th>
            <th>操作人</th>
            <th>进货日期</th>
        </tr>
        <tr class="tr-template">
            <td class="content" data-field="purchase_id"></td>
            <td class="content" data-field="unit"></td>
            <td class="content" data-field="operator_name"></td>
            <td class="content" data-field="create_time"></td>
            <td>
                <button class="button detail" >详情</button>
            </td>
        </tr>

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


<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var elements;
    $(document).ready(function () {
        elements=TableController.prepareElement('.tr-template');
        TableController.init('purchase_list', contentHandle);
        TableController.getList();
        registEvent();
    });

    function registEvent(){
        $(document).on('click','.detail',function(){
            var id=$(this).attr('id').slice(3);
            var href=getHref('purchase_detail');
            location.href=href+'&purchase_id='+id;
        });
    }
    function contentHandle(back) {
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements();
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.detail').attr('id', 'edt'+v.purchase_id);

            $('.provider-table').append(element);
        });
    }

</script>