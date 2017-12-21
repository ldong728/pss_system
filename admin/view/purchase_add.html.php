<?php

?>
<style>
    .search-input {
        width: 100px;
        min-width: 30px;
    }
    .search-button {
        width: 60px;
        min-width: 30px;
    }
</style>
<div class="block">
    <div class="head">
        进货列表
    </div>
    <table class="table sheet pre-purchase-table" style="display: none">
        <thead>
        <tr>
            <td>品名</td>
            <td>序列号</td>
            <td>数量</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="pre-purchase">
        <tr class="pre-purchase-tr">
            <td class="name"></td>
            <td class="sn"></td>
            <td><button class="button minus" data-type="number-button" style="width: 30px;min-width: 30px;display: none">-</button><input class="purchase-number" type="number" style="width: 50px"><button class="button plus" data-type="number-button" style="width: 30px;min-width: 20px;display: none">+</button></td>
            <td><button class="button remove"  data-type="remove">移除</button></td>
        </tr>
        </tbody>
        <tfoot>
            <tr><td colspan="2">选择供应商：<span class="provider-container"></span></td><td colspan="2"><button class="button" data-type="submit">提交此笔记录</button></td></tr>
        </tfoot>
    </table>

    <div class="space"></div>
    <div class="head">
        待选列表
    </div>
    <table class="table">
        <tr>
            <td>选择类别：</td><td class="category-filter"><select class="category-template category-select"><option class="option-template"></option></select></td>
            <td>按名称搜索:</td><td><input class="name-search-text search-input" type="text" placeholder="输入名称" maxlengtd="10"><button class="button search-button" data-type="search-name" id="sch1">搜索</button></td>
            <td>按序列号搜索:</td><td><input class="sn-search-text search-input" type="text" placeholder="输入序列号" maxlengtd="10"><button class="button search-button" data-type="search-sn" id="sch1">搜索</button></td>
        </tr>
    </table>
    <table class="table sheet prepare-table" style="display: none">
        <tr>
            <td>名称</td>
            <td>序列号</td>
            <td>库存</td>
            <td>操作</td>

        </tr>
        <tr class="prepare-tr-template">
            <td class="content" data-field="name"></td>
            <td class="content" data-field="sn"></td>
            <td class="content" data-field="stock"></td>
            <td>
                <button class="button add" data-type="add">添加</button>
            </td>
        </tr>
    </table>

</div>
<script type="application/javascript" src="js/tableController.js"></script>

<script>
    var categoryList,prePurchaseObj,prepareList;
    var prepareElementsTemplate,categoryDisplayElementsTemplate,prePurchaseElementTemplate;
    $(document).ready(function(){
        prePurchaseObj={provider:null,total_price:null,detail:{}};
        prepareElementsTemplate=TableController.prepareElement('.prepare-tr-template');
        prePurchaseElementTemplate=TableController.prepareElement('.pre-purchase-tr');
        TableController.init('product_list',handlePrepareTableContent);
        TableController.setPageEvent();
        registEvent();
        initCategory();
        initProvider();

    });
    function registEvent(){
        $(document).on('click','.button',function(){
            var type=$(this).data('type');
            var id=this.id.slice(3);
            switch(type){
                case 'add':
                    if(prePurchaseObj.detail[id]){
                        prePurchaseObj.detail[id].amount++;
                    }else{
                        prePurchaseObj.detail[id]={product:id,amount:1}
                    }
                    setPrePurchaseTr(id);
                    $('.pre-purchase-table').show();
                    break;
                case 'remove':
                    console.log('remove');
                    delete prePurchaseObj.detail[id];
                    $(this).parents('tr').remove();
                    var count=0;
                    for(var i in prePurchaseObj.detail){
                        count++;
                    }
                    if(0==count){
                        console.log(prePurchaseObj.detail);
                        $('.pre-purchase-table').hide();
                    }
                    break;
                case 'search-name':
                    var text=$('.name-search-text').val();
                    TableController.filter.where[0]='name like "%'+text+'%"';
                    TableController.getList(handlePrepareTableContent);
                    break;
                case 'search-sn':
                    var text=$('.sn-search-text').val();
                    if(text){
                        TableController.filter.where[1]='sn like "%'+text+'%"';
                        TableController.getList(handlePrepareTableContent);
                    }
                    break;
                case 'number-button':

                    if($(this).hasClass('minus')){

                    }else{

                    }
                    break;
                case 'submit':
                    $('purchase-number').each(function(k,v){
                        var id= $(v).attr('id').slice(3);
                        var number=parseInt($(v).val());
                        prePurchaseObj.detail[id].amount=number;
                    });
                    submitPurchase();
                    break;
                default :
                    break;
            }
        });
        $(document).on('change','.purchase-number',function(){
            var id=$(this).attr('id').slice(3);
            var number=$(this).val();
            prePurchaseObj.detail[id].amount=number;
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
                TableController.setfilter({category:categoryFilter});
//                TableController.filter.where.category=categoryFilter;
            }else{
                TableController.setfilter({});
            }
            TableController.getList();
        });
        $(document).on('change','.provider-select',function(){
            var providerId=$(this).val();
            prePurchaseObj.provider=providerId
        })
    }

    function initCategory(){
        categoryDisplayElementsTemplate=TableController.prepareElement('.category-template','.option-template');
        ajaxPost('category_list',{},function(back){
            var backValue=backHandle(back);
            if(backValue){
                categoryList=backValue;
                $('.category-filter').append(getSubCategoryElment(0));
                console.log(categoryList);
            }
        });
    }
    function setPrePurchaseTr(productId){
        $('#ppc'+productId).remove();
        var trElement=prePurchaseElementTemplate();
        trElement.attr('id','ppc'+productId);
        trElement.find('.name').text(prepareList[productId].name);
        trElement.find('.sn').text(prepareList[productId].sn);
        trElement.find('.purchase-number').val(prePurchaseObj.detail[productId].amount).attr('id','num'+productId);
        trElement.find('.minus').attr('id','min'+productId);
        trElement.find('.plus').attr('id','pls'+productId);
        trElement.find('.remove').attr('id','rmv'+productId);
        $('.pre-purchase').append(trElement);

//        console.log(trElement);
    }
    function getSubCategoryElment(currentId){
        var hasSub=false;
        var current=parseInt(currentId);
        var title=current?'子分类':'主分类';
        var disable=current?'disabled':'';
        var selectElement=categoryDisplayElementsTemplate('.category-template');
        selectElement.append('<option '+disable+' selected>请选择'+title+'</option>');
        $.each(categoryList,function(k,v){
            var optionElement=categoryDisplayElementsTemplate('.option-template');
            var id=parseInt(v.category_id);
            var pId=parseInt(v.p_category);
            if(pId==current){
                hasSub=true;
                optionElement.attr('value',id);
                optionElement.text(v.category_name);
                selectElement.append(optionElement);
            }
        });
        return hasSub?selectElement:false;
    }
    function getAllSubCategory(currentId){
        var subList=[];
        for(var i in categoryList){
            if(categoryList[i].p_category==currentId){
                subList.push(categoryList[i].category_id);
                subList=subList.concat(getAllSubCategory(categoryList[i].category_id));
            }
        }
        return subList;
    }
    function getAllSubCategoryObj(currentId){
        return encodeListToTree(categoryList,'category_id','p_category',currentId);
    }
    function handlePrepareTableContent(back){
        $('.prepare-tr-template').remove();
        prepareList={};
        $.each(back.list,function(k,v){
            var element = prepareElementsTemplate('.prepare-tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.add').attr('id', 'add'+v.product_id);
            $('.prepare-table').append(element);
            prepareList[v.product_id]=v;
        });
        $('.prepare-table').show();
    }
    function submitPurchase(){
        if(prePurchaseObj.provider&&prePurchaseObj.detail){
            ajaxPost('purchase_add_recode',prePurchaseObj,function(back){
               var backValue=backHandle(back);
                if(backValue){
                    location.reload(true);
                }else{
                    showToast(backValue);
                }
            });
        }else{
            showToast('请先选择供应商');
        }
    }
    function initProvider(){
        var selectElement=categoryDisplayElementsTemplate('.category-template');
        selectElement.removeClass('category-select');
        selectElement.addClass('provider-select');
        selectElement.append('<option value="0" disabled="true" selected>请选择供应商</option>');
        ajaxPost('provider_list',{page:0},function(back){
            var backValue=backHandle(back);
            $.each(backValue.list,function(k,v){
               var optionElement=categoryDisplayElementsTemplate('.option-template');
                optionElement.attr('value', v.provider_id);
                optionElement.text(v.unit);
                selectElement.append(optionElement);
            });
            $('.provider-container').append(selectElement);
        })
    }






</script>