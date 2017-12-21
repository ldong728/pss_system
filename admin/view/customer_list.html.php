<?php

?>
<style>
    .search-button {
        margin-left: 5px;
        max-width: 60px;
        min-width: 30px;
        width: 50px;

    }
</style>
<div class="block">
    <div class="head">
        客户列表
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <th>顾客姓名</th>
            <th>联系电话</th>
            <th>联系地址</th>
            <th>操作</th>
        </tr>
        </thead>
       <tbody class="customer-container">
       <tr class="tr-template">
           <td class="content" data-field="customer_name"></td>
           <td class="content" data-field="customer_tel"></td>
           <td class="content" data-field="customer_address"></td>
           <td>
               <button class="button edit" data-type="edit">编辑</button>
               <button class="button delete" data-type="detail">交易记录</button>
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
    <table class="table">
        <tr>
            <td>按姓名搜索:</td><td><input class="name-search-text" type="text" placeholder="请输入姓名关键字" maxlength="10"><button class="button search-button" data-type="search-name" id="sch1">搜索</button></td>
            <td>按电话搜索:</td><td><input class="tel-search-text" type="text" placeholder="请输入电话号码" maxlength="10"><button class="button search-button" data-type="search-tel" id="sch2">搜索</button></td>
            <td>按地址搜索:</td><td><input class="address-search-text" type="text" placeholder="请输入关键字" maxlength="10"><button class="button search-button" data-type="search-address" id="sch3">搜索</button></td>
        </tr>
    </table>
    <div>

    </div>

</div>
<script type="application/javascript" src="js/tableController.js"></script>

<script>
    var trElements;
    $(document).ready(function(){
        trElements=TableController.prepareElement('.tr-template');
        TableController.init('customer_list',handleTableContent);
        TableController.getList();
        TableController.setPageEvent();
        registEvent();

    });
    function registEvent(){
        $(document).on('click','.button',function(){
            var type=$(this).data('type');
            var id=this.id.slice(3);
            console.log(id);
            switch(type){
                case 'edit':
                    var href=getHref('customer_edit');
                    location.href=href+'&customer_id='+id;
                    break;
                case 'search-name':
                    var text=$('.name-search-text').val();
                    TableController.setfilter({0:'customer_name like "%'+text+'%"'});
                    TableController.getList();
                    break;
                case 'search-address':
                    var text=$('.address-search-text').val();
                    TableController.setfilter({0:'customer_address like "%'+text+'%"'});
                    TableController.getList();
                    break;
                case 'search-tel':
                    var text=$('.tel-search-text').val();
                    TableController.setfilter({0:'customer_tel like "%'+text+'%"'});
                    TableController.getList();
                    break;
                default :
                    break;
            }
        });
        $(document).on('change','.category-select',function(){
            var id=this.value;
            var categoryFilter=null;
            $(this).nextAll('select').remove();
            if(id>0){
                var element=getSubCategoryElment(id);

                if(element){

                    $(this).after(element);
                    categoryFilter=getAllSubCategory(id);
                    categoryFilter.push(id);
                }else{
                    categoryFilter=id;
                }
            }
            if(categoryFilter){
                TableController.filter.where.category=categoryFilter;
            }else{
                delete TableController.filter.where.category;
            }
            TableController.getList(handleTableContent);
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
            element.find('.edit').attr('id', 'edt'+v.customer_id);
            element.find('.detail').attr('id', 'dtl'+v.customer_id);
            $('.customer-container').append(element);
        });
    }






</script>