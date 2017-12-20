<?php

?>
<div class="block">
    <div class="head">
        供应商列表
    </div>
    <table class="table sheet provider-table">
        <tr>
            <th>名称</th>
            <th>地址</th>
            <th>联系人</th>
            <th>操作</th>
        </tr>
        <tr class="tr-template">
            <td class="content" data-field="unit"></td>
            <td class="content" data-field="address"></td>
            <td class="content" data-field="contact"></td>
            <td>
                <button class="button edit" data-type="edit">编辑</button>
                <button class="button delete" data-type="delete">删除</button>
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
        elements = TableController.prepareElement('.tr-template');
//        TableController.methodName = 'provider_list';
        TableController.init('provider_list',backDataHandle);
        TableController.setPageEvent();
        TableController.getList();


        registEvent();


    });
    function registEvent(){
        $(document).on('click','.button',function(){
            var type=$(this).data('type');
            var id=this.id.slice(3);
            console.log(id);
            switch(type){
                case 'edit':
                    var href=getHref('provider_edit');

                    location.href=href+'&provider_id='+id;


                default :
                    break;
            }
        });

    }
    function backDataHandle(back){

        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
//                    console.log(value);
//                    delete value.data-field;
            });
            element.find('.edit').attr('id', 'edt'+v.provider_id);
            element.find('.delete').attr('id', 'del'+v.provider_id);

            $('.provider-table').append(element);
        });
    }



    //    function
</script>
