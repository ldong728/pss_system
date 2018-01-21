<?php
global $purchaseId
?>
<script>var purchaseId =<?php echo $purchaseId?>;</script>
<div class="block" style="display: none">
    <div class="head">
        进货信息
    </div>
    <table class="table">
        <tr>
            <td style="text-align: right">序列号</td>
            <td class="purchase-id"></td>
            <td style="text-align: right">供应商：</td>
            <td class="provider"></td>
            </tr>
        <tr>
            <td style="text-align: right">操作员：</td>
            <td class="operator"></td>
            <td style="text-align: right">时间：</td>
            <td class="create-time"></td>
        </tr>
    </table>
    <div class="space"></div>
    <div class="head">
        进货详情
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <td>商品名</td>
            <td>商品序列号</td>
            <td>进货量</td>
        </tr>
        </thead>
        <tbody class="detail-table">
        <tr class="tr-template">
            <td class="content" data-field="product_name"></td>
            <td class="content" data-field="product_sn"></td>
            <td class="content" data-field="amount"></td>
        </tr>
        </tbody>
    </table>
</div>
</table>
<table class="table">
    <tr>
        <td>进货序列号：</td><td><input type="text" class="purchase-id-input" placeholder="输入进货序列号"> <button class="button submit">查询</button></td>
    </tr>
</table>

<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var elements;
    $(document).ready(function () {
        elements = TableController.prepareElement('.tr-template');
        TableController.init('get_purchase_detail', handleDetail);
        if (purchaseId) {
            TableController.setFilter({purchase_id: purchaseId});
            TableController.getList();
        }

    });


    function handleDetail(back) {
        console.log(back);
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements();
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            $('.detail-table').append(element);
            $('.provider').text(back.inf.unit);
            $('.operator').text(back.inf.operator_name||'系统管理员');
            $('.purchase-id').text(back.inf.purchase_id);
            $('.create-time').text(back.inf.create_time);
            $('.block').show();
        });
    }

</script>