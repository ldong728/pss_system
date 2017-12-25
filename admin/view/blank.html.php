<div class="main">
<!--    <table class="table">-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td width="100">当前版本：</td>-->
<!--            <td width="150">GOODUO PHP V1.0</td>-->
<!--            <td width="100">最新版本：</td>-->
<!--            <td width="150">GOODUO PHP V1.0</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>网站目录：</td>-->
<!--            <td>--><?php //echo DOMAIN?><!--</td>-->
<!--            <td>服务器时间：</td>-->
<!--            <td>--><?php //echo timeUnixToMysql(time())?><!--</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>用户IP：</td>-->
<!--            <td>--><?php //echo $_SERVER['REMOTE_ADDR']?><!--</td>-->
<!--            <td>用户浏览器：</td>-->
<!--            <td>--><?php //echo $_SERVER['HTTP_USER_AGENT'] ?><!--</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>服务器名：</td>-->
<!--            <td>--><?php //echo $_SERVER['HTTP_HOST']?><!--</td>-->
<!--            <td>服务器IP：</td>-->
<!--            <td>--><?php //echo $_SERVER['SERVER_ADDR']? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR']?><!--</td>-->
<!--        </tr>-->
<!---->
<!--        </tbody>-->
<!--    </table>-->

    <div class="block">
        <div class="head">
            <span>库存警示</span>
        </div>
        <table class="table sheet">
            <thead>
            <tr>
                <td>品名</td>
                <td>编号</td>
                <td>库存量</td>
            </tr>
            </thead>
            <tbody class="product-table">
            <tr class="tr-template">
                <td class="content" data-field="name"></td>
                <td class="content" data-field="sn"></td>
                <td class="content" data-field="stock"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var trElements;
    $(document).ready(function(){
        trElements=TableController.prepareElement('.tr-template');
        TableController.init('stock_alert',handleTableContent);
        TableController.setNumber(30);
        TableController.addFilter({12:'stock<10'});
        TableController.getList();

    });
    function handleTableContent(back){
        $('.tr-template').remove();
        $.each(back.list,function(k,v){
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.img').attr('src', v.img);
            $('.product-table').append(element);
        });
    }
</script>