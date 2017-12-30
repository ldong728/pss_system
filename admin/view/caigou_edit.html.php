<?php

?>
<script type="application/javascript" src="js/laydate.js"></script>
<style>
    .search-input {
        width: 100px;
        min-width: 30px;
    }

    .search-button {
        width: 60px;
        min-width: 30px;
    }

    .img {
        width: 30px;
        height: auto;;
    }

</style>
<div class="block">
    <div class="head">
        采购列表
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <td>图片</td>
            <td>品名</td>
            <td>型号</td>
            <td>供应商</td>
            <td>数量</td>
            <td>采购单价</td>
            <td>规格说明</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="pre-caigou">
        <tr class="pre-caigou-tr">
            <td><img class="img" src="" alt="图片"></td>
            <td class="name"></td>
            <td class="sn"></td>
            <td class="provider"></td>
            <td>
                <button class="button minus" data-type="number-button"
                        style="width: 30px;min-width: 30px;display: none">-
                </button>
                <input class="caigou-number" type="number" style="width: 50px">
                <button class="button plus" data-type="number-button" style="width: 30px;min-width: 20px;display: none">
                    +
                </button>
            </td>
            <td>
                ￥<span class="default-price"></span>
            </td>
            <td>
                <textarea class="type-input" cols="20" rows="3"></textarea>
            </td>
            <td>
                <button class="button remove" data-type="remove">移除</button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>备注：</td>
            <td colspan="7"><textarea class="remark-input" rows="3" style="width: 90%; resize: none;padding:5px"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input id="delivery-time" placeholder="交货日期"></td>
            <td colspan="6">
                总计：￥<span class="total-price"></span>
                <button class="button show-product-list">添加商品</button>
                <button class="button submit-button" data-type="submit" style="display: none">生成订货单</button>
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
                <td>按类别：</td>
                <td class="category-filter"><select class="category-template category-select">
                        <option class="option-template"></option>
                    </select></td>
                <td>按供应商：</td>
                <td><span class="provider-container"></span></td>
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
                <td>图片</td>
                <td>名称</td>
                <td>型号</td>
                <td>库存</td>
                <td>供应商</td>
                <td>采购价</td>
                <td>操作</td>
            </tr>
            <tr class="prepare-tr-template">
                <td><img class="img"></td>
                <td class="content" data-field="name"></td>
                <td class="content" data-field="sn"></td>
                <td class="content" data-field="stock"></td>
                <td class="content" data-field="provider_name"></td>
                <td class="content" data-field="purchase_price"></td>
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
var jinhuoObj, prepareList;
var prepareElementsTemplate, categoryDisplayElementsTemplate, preCaigouElementTemplate;
$(document).ready(function () {
    jinhuoObj = {total_price: null,delivery:null,remark:null,detail: {}};
    prepareElementsTemplate = TableController.prepareElement('.prepare-tr-template');
    preCaigouElementTemplate = TableController.prepareElement('.pre-caigou-tr');
    TableController.init('product_provide_list', handlePrepareTableContent);
    TableController.setPageEvent();
    laydate({
        elem:'#delivery-time',
        format: 'YYYY-MM-DD hh:mm:ss',
        show:true,
        start:laydate.now()
    });
    registEvent();
    initCategory();
    initProvider();
//    scannerReady();

});
function registEvent() {
    $(document).on('click', '.button', function () {
        var type = $(this).data('type') || 'default';
        var id = this.id.slice(3);
        switch (type) {
            case 'add':
                if (jinhuoObj.detail[id]) {
                    jinhuoObj.detail[id].amount++;
                } else {
                    jinhuoObj.detail[id] = {
                        product: id,
                        price: prepareList[id].purchase_price,
                        provider:prepareList[id].provider,
                        amount: 1
                    }
                }
                calcPreCaigouTotalPrice();
                setPreCaigouTr(id);
                $('.submit-button').show();
                break;
            case 'remove':
                console.log('remove');
                delete jinhuoObj.detail[id];
                $(this).parents('tr').remove();
                calcPreCaigouTotalPrice();
                var count = 0;
                for (var i in jinhuoObj.detail) {
                    count++;
                }

                if (0 == count) {
                    console.log(jinhuoObj.detail);
                    $('.submit-button').hide();
                }
                break;
            case 'search-name':
                var text = $('.name-search-text').val();
                TableController.addFilter({0: 'name like "%' + text + '%"'})
                getPrepareList()
                break;
            case 'search-sn':
                var text = $('.sn-search-text').val();
                if (text) {
                    TableController.addFilter({1: 'sn like "%' + text + '%"'});
                    getPrepareList()
                }
                break;
            case 'submit':
                $('caigou-number').each(function (k, v) {
                    var id = $(v).attr('id').slice(3);
                    var number = parseInt($(v).val());
                    jinhuoObj.detail[id].amount = number;

                });
                calcPreCaigouTotalPrice();
                console.log(jinhuoObj);
                submitCaigou();
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
    $(document).on('change', '.caigou-number', function () {
        var id = $(this).attr('id').slice(3);
        var number = $(this).val();
        jinhuoObj.detail[id].amount = number;
        calcPreCaigouTotalPrice();
    });
    $(document).on('change','.type-input',function(){
        var id=$(this).attr('id').slice(3);
        var text=$(this).val();
        jinhuoObj.detail[id].type=text;
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
    $(document).on('change', '.provider-select', function () {
        var providerId = $(this).val();
        TableController.addFilter({provider: providerId});
        TableController.getList();
//        jinhuoObj.provider = providerId;
//        getProviderDetail({provider_id: providerId}, null);
    });
//    $(document).on('change', '.provider-auto', function () {
//        var field = $(this).data('field');
//        var element = $(this).next('.tips');
//        var value = $(this).val();
//        var data = {0: field + ' like "%' + value + '%"'};
//        $('.tips').empty();
//        getProviderDetail(data, element);
//    });
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
function setPreCaigouTr(productId) {
    $('#ppc' + productId).remove();
    var trElement = preCaigouElementTemplate();
    var source = prepareList[productId];
    var detail = jinhuoObj.detail[productId];
    trElement.attr('id', 'ppc' + productId);
    trElement.find('.img').attr('src', source.img);
    trElement.find('.name').text(source.name);
    trElement.find('.sn').text(source.sn);
    trElement.find('.provider').text(source.provider_name);
    trElement.find('.caigou-number').val(detail.amount).attr('id', 'num' + productId);
    trElement.find('.minus').attr('id', 'min' + productId);
    trElement.find('.plus').attr('id', 'pls' + productId);
    trElement.find('.remove').attr('id', 'rmv' + productId);
    trElement.find('.type-input').attr('id','typ'+productId);
    trElement.find('.default-price').text(detail.price);
    trElement.find('.sub-total-price').text((detail.amount * detail.price).toFixed(2));

    $('.pre-caigou').append(trElement);

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
function getPrepareList() {
    TableController.setNumber(50);
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
        element.find('img').attr('src', v.img);
        element.find('.add').attr('id', 'add' + v.product_id);
        $('.prepare-table').append(element);
        prepareList[v.product_id] = v;
    });
    $('.prepare-table').show();
}
function submitCaigou() {
//    $('.provider_auto').trigger('change');
    if($('.remark-input').val())jinhuoObj.remark=$('.remark-input').val();
    if($('#delivery-time').val())jinhuoObj.delivery=$('#delivery-time').val();
    ajaxPost('caigou_add', jinhuoObj, function (back) {
        var backValue = backHandle(back);
        if (backValue) {
            location.reload(true);
        } else {
            showToast(backValue);
        }
    });
}

function getProviderDetail(data, displayJqueryElement) {
    ajaxPost('provider_detail', data, function (back) {
        var detail = backHandle(back);
        if (detail) {
            $('provider-select').val(detail.provider_id);
            $('.provider-input').each(function (k, v) {
                var field = $(v).data('field');
                $(v).val(detail[field]);
            });
            jinhuoObj.provider = detail.provider_id;
        } else {
            jinhuoObj.provider = null;
            $('.provider-input').each(function (k, v) {
                if (!$(v).hasClass('provider-auto'))$(v).val(null);
            });
            displayJqueryElement.text('无符合条件客户')

        }
    });
}
function initProvider() {
    var selectElement = categoryDisplayElementsTemplate('.category-template');
    selectElement.removeClass('category-select');
    selectElement.addClass('provider-select');
    selectElement.append('<option value="0" disabled="true" selected>供应商</option>');
    ajaxPost('provider_list', {page: 0, number: 30, caigou: 'desc', caigouby: 'provider_id'}, function (back) {
        console.log(back);
        var backValue = backHandle(back);
        $.each(backValue.list, function (k, v) {
            var optionElement = categoryDisplayElementsTemplate('.option-template');
            optionElement.attr('value', v.provider_id);
            optionElement.text(v.unit);
            selectElement.append(optionElement);
        });
        $('.provider-container').append(selectElement);
    })
}
function calcPreCaigouTotalPrice() {
    jinhuoObj.total_price = 0;
    $.each(jinhuoObj.detail, function (k, v) {
        jinhuoObj.total_price += v.amount * v.price;
    });
    $('.total-price').text(jinhuoObj.total_price.toFixed(2));
}
function scannerReady() {
    $('.sn-search-text').attr('onkeypress', 'confirmFunc(event)')
}
function confirmFunc(event) {
    if (13 == event.keyCode) {

    }
//    alert(event.keyCode);
}


</script>