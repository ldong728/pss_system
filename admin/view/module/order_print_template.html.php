<link rel="stylesheet" type="text/css" media="print" href="stylesheet/print.css?v=<?=rand(1000, 9999) ?>">

<div class="main-title">销售清单</div>
<div class="info-container">
    <table class="info" width="100%">
        <tr>
            <td width="50%">销售单号：<?=$orderInf['order_id']?></td>
            <td width="50%">创建日期：<?=$orderInf['create_time']?></td>
        </tr>
        <tr>
            <td>收货人：<?=$orderInf['customer_name']?></td>
            <td>联系电话：<?=$orderInf['customer_tel']?></td>
        </tr>
        <tr>
            <td colspan="2">收货地址：<?=$orderInf['customer_address']?></td>
        </tr>
    </table>
</div>
<div class="detail-container">
    <table class="detail">
        <tr>
            <td>名称</td>
            <td>编号</td>
            <td>价格</td>
            <td>单位</td>
            <td>数量</td>
            <td>小计</td>
        </tr>
        <?php foreach($orderDetail as $row):?>
        <tr>
            <td><?=$row['product_name']?></td>
            <td><?=$row['product_sn']?></td>
            <td>￥<?=$row['price']?></td>
            <td><?=$row['unit']?></td>
            <td><?=$row['amount']?></td>
            <td>￥<?=number_format(($row['amount']*$row['price']),2)?></td>
        </tr>
        <?php endforeach?>
        <tr>
            <td>合计</td>
            <td colspan="5">￥<?=$orderInf['total_fee']?></td>
        </tr>
        <tr>
            <td colspan="6">备注：<?=$orderInf['remark']?></td>
        </tr>
    </table>
</div>
