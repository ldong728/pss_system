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

    .pop-up {
        position: absolute;
        left: 15%;
        top: 15%;
        width: 70%;
        height: 80%;
        /*padding-top: 5px;*/
        border-radius: 4px;
        border: solid 1px #ccc;
        background-color: #fff;
    }
    .pop-up .pop-up-head{
        background: #ccc;
        height: 25px;
        line-height: 25px;
        padding-left: 5px;
        font-size: 15px;
        font-weight: 600;
    }
    .pop-up .table-container {
        box-sizing: border-box;
        overflow-y: scroll;
        /*padding-left: 5px;*/
        height: 90%;
    }
    .pop-up .table-container table td{
        background: #eee;
    }

    .pop-up .button-container {
        box-sizing: border-box;
        text-align: center;
        height: 90%;
    }

    .pop-up .search-button {
        min-height: 20px;
        height: 23px;
        margin-left: 4px;;
    }
</style>
<div class="block">
    <div class="head">
        收货人
    </div>
    <table class="table order-inf">
        <tr>
            <td>选择客户：<span class="customer-container"></span></td>
            <td>输入电话：<input type="tel" class="customer-input customer-auto" data-field="customer_tel"
                            placeholder="输入电话" maxlength="11"> <span class="tips"></span></td>
            <td>输入姓名：<input type="text" class="customer-input" data-field="customer_name" placeholder="输入姓名" maxlength="6"><span
                    class="tips"></span></td>
        </tr>
        <tr>

            <td colspan="2">输入地址：<input type="text" class="customer-input" data-field="customer_address"
                                        placeholder="输入地址" style="max-width: 500px;width: 250px" maxlength="20"> <span
                    class="tips"></span></td>
            <td>
                <button class="button show-product-list">添加产品</button>
            </td>
        </tr>
    </table>
    <div class="space">

    </div>
    <div class="head pre-order-table" style="display: none">
        发货列表
    </div>
    <table class="table sheet pre-order-table" style="display: none">
        <thead>
        <tr>
            <td>品名</td>
            <td>序列号</td>
            <td>数量</td>
            <td>单价</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="pre-order">
        <tr class="pre-order-tr">
            <td class="name"></td>
            <td class="sn"></td>
            <td>
                <button class="button minus" data-type="number-button"
                        style="width: 30px;min-width: 30px;display: none">-
                </button>
                <input class="order-number" type="number" style="width: 50px">
                <button class="button plus" data-type="number-button" style="width: 30px;min-width: 20px;display: none">
                    +
                </button>
            </td>
            <td>
                ￥<span class="default-price"></span>
            </td>
            <td>
                <button class="button remove" data-type="remove">移除</button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                总计：￥<span class="total-price"></span>
                <button class="button" data-type="submit">提交订单</button>
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="space"></div>


</div>


<div class="pop-up" style="display: none">
    <div class="table-container">
        <div class="pop-up-head">
            待选列表
        </div>
        <table class="table">
            <tr>
                <td>选择类别：</td>
                <td colspan="3" class="category-filter"><select class="category-template category-select">
                        <option class="option-template"></option>
                    </select></td>
            </tr>
            <tr>
                <td>按名称搜索:</td>
                <td><input class="name-search-text search-input" type="text" placeholder="输入名称" maxlengtd="10">
                    <button class="button search-button" data-type="search-name" id="sch1">搜索</button>
                </td>
                <td>按序列号搜索:</td>
                <td><input class="sn-search-text search-input" type="text" placeholder="输入序列号" maxlengtd="10">
                    <button class="button search-button" data-type="search-sn" id="sch1">搜索</button>
                </td>
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
    <div class="button-container">
        <button class="button" data-type="close-popup">关闭</button>
    </div>

</div>


<script type="application/javascript" src="js/tableController.js"></script>
<script>
var preOrderObj, prepareList;
var prepareElementsTemplate, categoryDisplayElementsTemplate, preOrderElementTemplate;
$(document).ready(function () {
    preOrderObj = {customer: null, total_price: null, detail: {}};
    prepareElementsTemplate = TableController.prepareElement('.prepare-tr-template');
    preOrderElementTemplate = TableController.prepareElement('.pre-order-tr');
    TableController.init('product_list', handlePrepareTableContent);
    TableController.setPageEvent();
    registEvent();
    initCategory();
    initCustomer();
//    scannerReady();

});
function registEvent() {
    $(document).on('click', '.button', function () {
        var type = $(this).data('type') || 'default';
        var id = this.id.slice(3);
        switch (type) {
            case 'add':
                if (preOrderObj.detail[id]) {
                    preOrderObj.detail[id].amount++;
                } else {
                    preOrderObj.detail[id] = {product: id,price:prepareList[id].default_price, amount: 1}
                }
                calcPreOrderTotalPrice();
                setPreOrderTr(id);
                $('.pre-order-table').show();
                break;
            case 'remove':
                console.log('remove');
                delete preOrderObj.detail[id];
                $(this).parents('tr').remove();
                calcPreOrderTotalPrice();
                var count = 0;
                for (var i in preOrderObj.detail) {
                    count++;
                }

                if (0 == count) {
                    console.log(preOrderObj.detail);
                    $('.pre-order-table').hide();
                }
                break;
            case 'search-name':
                var text = $('.name-search-text').val();
                TableController.filter.where[0] = 'name like "%' + text + '%"';
                getPrepareList()
                break;
            case 'search-sn':
                var text = $('.sn-search-text').val();
                if (text) {
                    TableController.filter.where[1] = 'sn like "%' + text + '%"';
                    getPrepareList()
                }
                break;
            case 'submit':
                $('order-number').each(function (k, v) {
                    var id = $(v).attr('id').slice(3);
                    var number = parseInt($(v).val());
                    preOrderObj.detail[id].amount = number;
                });
                calcPreOrderTotalPrice();
                console.log(preOrderObj);
                submitOrder();
                break;
            case 'close-popup':
                $('.pop-up').hide();
                break;
            default :
                break;
        }
    });
    $(document).on('click', '.show-product-list', function () {
        $('.pop-up').show();
    });
    $(document).on('change', '.order-number', function () {
        var id = $(this).attr('id').slice(3);
        var number = $(this).val();
        preOrderObj.detail[id].amount = number;
        calcPreOrderTotalPrice();
    });
    $(document).on('change', '.category-select', function () {
        var id = this.value;
        var categoryFilter = null;
        $(this).nextAll('select').remove();
        if (id > 0) {
            var element = getSubCategoryElment(id);

            if (element) {

                $(this).after(element);
                categoryFilter = getAllSubCategory(id);
                categoryFilter.push(id);
            } else {
                categoryFilter = id;
            }
        }
        if (categoryFilter) {
            TableController.setfilter({category: categoryFilter});
//                TableController.filter.where.category=categoryFilter;
        } else {
            TableController.setfilter({});
        }
        getPrepareList()
    });
    $(document).on('change', '.customer-select', function () {
        var customerId = $(this).val();
        preOrderObj.customer = customerId;
        getCustomerDetail({customer_id: customerId}, null);
    });
    $(document).on('change', '.customer-auto', function () {
        var field = $(this).data('field');
        var element = $(this).next('.tips');
        var value = $(this).val();
        var data = {0: field + ' like "%' + value + '%"'};
        $('.tips').empty();
        getCustomerDetail(data, element);
    });
//    $(document).on('click','#right',function(){
//       $('.pop-up').hide();
//    });
}

function initCategory() {
    categoryDisplayElementsTemplate = TableController.prepareElement('.category-template', '.option-template');
    ajaxPost('category_list', {}, function (back) {
        var backValue = backHandle(back);
        if (backValue) {
            categoryList = backValue;
            $('.category-filter').append(getSubCategoryElment(0));
            console.log(categoryList);
        }
    });
}
function setPreOrderTr(productId) {
    $('#ppc' + productId).remove();
    var trElement = preOrderElementTemplate();
    trElement.attr('id', 'ppc' + productId);
    trElement.find('.name').text(prepareList[productId].name);
    trElement.find('.sn').text(prepareList[productId].sn);
    trElement.find('.order-number').val(preOrderObj.detail[productId].amount).attr('id', 'num' + productId);
    trElement.find('.minus').attr('id', 'min' + productId);
    trElement.find('.plus').attr('id', 'pls' + productId);
    trElement.find('.remove').attr('id', 'rmv' + productId);
    trElement.find('.default-price').text(preOrderObj.detail[productId].price);
    trElement.find('.sub-total-price').text((preOrderObj.detail[productId].amount*preOrderObj.detail[productId].price).toFixed(2));

    $('.pre-order').append(trElement);

//        console.log(trElement);
}
function getSubCategoryElment(currentId) {
    var hasSub = false;
    var current = parseInt(currentId);
    var title = current ? '子分类' : '主分类';
    var disable = current ? 'disabled' : '';
    var selectElement = categoryDisplayElementsTemplate('.category-template');
    selectElement.append('<option ' + disable + ' selected>请选择' + title + '</option>');
    $.each(categoryList, function (k, v) {
        var optionElement = categoryDisplayElementsTemplate('.option-template');
        var id = parseInt(v.category_id);
        var pId = parseInt(v.p_category);
        if (pId == current) {
            hasSub = true;
            optionElement.attr('value', id);
            optionElement.text(v.category_name);
            selectElement.append(optionElement);
        }
    });
    return hasSub ? selectElement : false;
}
function getAllSubCategory(currentId) {
    var subList = [];
    for (var i in categoryList) {
        if (categoryList[i].p_category == currentId) {
            subList.push(categoryList[i].category_id);
            subList = subList.concat(getAllSubCategory(categoryList[i].category_id));
        }
    }
    return subList;
}
function getAllSubCategoryObj(currentId) {
    return encodeListToTree(categoryList, 'category_id', 'p_category', currentId);
}
function getPrepareList(){
    TableController.setNumber(50);
    TableController.addFilter({5:'stock > 0'});
    TableController.getList();
}
function handlePrepareTableContent(back) {
    $('.prepare-tr-template').remove();
    prepareList = {};
    $.each(back.list, function (k, v) {
        var element = prepareElementsTemplate('.prepare-tr-template');
        $.each(element.find('.content'), function (index, value) {
            $(value).text(v[$(value).data('field')]);
            $(value).removeAttr('data-field');
        });
        element.find('.add').attr('id', 'add' + v.product_id);
        $('.prepare-table').append(element);
        prepareList[v.product_id] = v;
    });
    $('.prepare-table').show();
}
function submitOrder() {
//    $('.customer_auto').trigger('change');
    var newCustom=null;
    if(!preOrderObj.customer){
        console.log(123);
        preOrderObj.customer={};
        $('.customer-input').each(function(k,v){
            var value=$(v).val();
            console.log(value);
            var field=$(v).data('field');
            if(!value){
                preOrderObj.customer=null;
                return false;
            }else{
                preOrderObj.customer[field]=value;
            }
        });
    }
    if (preOrderObj.customer && preOrderObj.detail) {
        ajaxPost('order_add', preOrderObj, function (back) {
            var backValue = backHandle(back);
            if (backValue) {
                location.reload(true);
            } else {
                showToast(backValue);
            }
        });
    } else {
        showToast('请先补全客户信息');
    }
}
function getCustomerDetail(data, displayJqueryElement) {
    ajaxPost('customer_detail', data, function (back) {
        var detail = backHandle(back);
        if (detail) {
            $('customer-select').val(detail.customer_id);
            $('.customer-input').each(function (k, v) {
                var field = $(v).data('field');
                $(v).val(detail[field]);
            });
            preOrderObj.customer = detail.customer_id;
        } else {
            preOrderObj.customer = null;
            $('.customer-input').each(function (k, v) {
               if(!$(v).hasClass('customer-auto'))$(v).val(null);
            });
            displayJqueryElement.text('无符合条件客户')

        }
    });
}
function initCustomer() {
    var selectElement = categoryDisplayElementsTemplate('.category-template');
    selectElement.removeClass('category-select');
    selectElement.addClass('customer-select');
    selectElement.append('<option value="0" disabled="true" selected>请选择客户</option>');
    ajaxPost('customer_list', {page: 0, number: 20,order:'desc',orderby:'customer_id'}, function (back) {
        var backValue = backHandle(back);
        $.each(backValue.list, function (k, v) {
            var optionElement = categoryDisplayElementsTemplate('.option-template');
            optionElement.attr('value', v.customer_id);
            optionElement.text(v.customer_name);
            selectElement.append(optionElement);
        });
        $('.customer-container').append(selectElement);
    })
}
function calcPreOrderTotalPrice(){
    preOrderObj.total_price=0;
    $.each(preOrderObj.detail,function(k,v){
        preOrderObj.total_price+= v.amount* v.price;
    });
    $('.total-price').text(preOrderObj.total_price.toFixed(2));
}
function scannerReady(){
    $('.sn-search-text').attr('onkeypress','confirmFunc(event)')
}
function confirmFunc(event){
    if(13==event.keyCode){

    }
//    alert(event.keyCode);
}



</script>