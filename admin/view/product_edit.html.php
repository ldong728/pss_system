<?php global $productInf ?>
<script>
    var productInf = <?php echo $productInf? json_encode($productInf):'{}'?>;
</script>
<style>
    img {
        width: 50px;
        height: auto;
    }
</style>
<script type="application/javascript" src="js/ajaxfileupload.js"></script>
<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>产品信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tr>
                    <td>类别：</td>
                    <td class="category-filter"><select class="category-template category-select product-normal-info" data-field="category"><option class="option-template"></option></select></td>
                    <td>供应商</td>
                    <td class="provider-filter"></td>
                </tr>
                <tr>
                    <td>商品主图：</td>
                    <td><button class="button upload-img">上传主图</button><img class="img-demo img" alt="商品图"><input type="hidden" id="img-field" class="product-normal-info" data-field="img"></td>
                    <td>采购价：</td>
                    <td><input class="product-normal-info" data-field="purchase_price" type="text" placeholder="采购价"></td>
                </tr>

                <tr>
                    <td>商品名称：</td>
                    <td><input class="product-normal-info" data-field="name" type="text" placeholder="商品名称"></td>
                    <td>型号：</td>
                    <td><input class="product-normal-info" data-field="sn" placeholder="型号"></td>
                </tr>
                <tr>
                    <td>商品描述：</td>
                    <td colspan="3"><input class="product-normal-info" data-field="description" placeholder="商品描述" style="max-width: 100%;min-width: 150px;width: 80%"></td>
                </tr>
                <tr>
                    <td>价格：</td>
                    <td><input type="tel" class="product-normal-info" data-field="default_price" placeholder="价格"> </td>
                    <td>计量单位：</td>
                    <td><input class="product-normal-info" data-field="unit" placeholder="个" value="个"></td>
                </tr>
            </table>
        </div>
        <div>
            <button class="button" id="submit">提交</button>
        </div>
    </div>
    <div class="space"></div>
    <input type="file" id="product-img" name="product-img" style="display: none">
    <script type="application/javascript" src="js/tableController.js"></script>
    <script>
        var categoryList,categoryDisplayElementsTemplate;
        $(document).ready(function () {

            registEvent();
            initCategory();
            initProvider();


        });

        function registEvent(){
            $(document).on('click','#submit',function(){
                $('.product-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    if($(v).val()&&'0'!=$(v).val()){
                        productInf[field]= $(v).val();
                    }
                    console.log(field);
                    console.log($(v).val());
                    console.log(productInf);
                });
//                console.log(productInf);
                updateProductInf();
            });
            $(document).on('change','.category-select',function(){
                var id=this.value;
                productInf.category=id;
                $(this).nextAll('select').remove();
                if(id>0){
                    var element=getSubCategoryElment(id);
                    if(element){
                        $(this).after(element);
                        $(this).removeClass('product-normal-info');
                    }else{
                    }
                }
            });
            $(document).on('change','.provider-select',function(){
                var id=$(this).val();
                productInf.provider=id;
            });
            $(document).on('click','.upload-img',function(){
                $('#product-img').click();
            });
            $(document).on('change','#product-img',function(){
                $.ajaxFileUpload({
                    url: 'upload.php',
                    secureuri: false,
                    fileElementId: $(this).attr('id'), //文件上传域的ID
                    dataType: 'json', //返回值类型 一般设置为json
                    success: function (v, status) {
                        if ('SUCCESS' == v.state) {
//                            $('#title-img-display').attr('src', v.url);
//                            goodsInf.goods_image = v.name;
                            $('.img-demo').attr('src', v.url);
                            $('#img-field').val(v.url);

                            console.log(v);
                        } else {
                            showToast(v.state);
                        }
                    },//服务器成功响应处理函数
                    error: function (d) {
                        alert('error');
                    }
                });
            });
        }
        function initCategory(){
            categoryDisplayElementsTemplate=TableController.prepareElement('.category-template','.option-template');
            ajaxPost('category_list',{},function(back){
                var backValue=backHandle(back);
                if(backValue){
                    categoryList=backValue;
                    $('.category-filter').append(getSubCategoryElment(0));
                }
                initProductInf();
            });
        }
        function getSubCategoryElment(currentId){
            var hasSub=false;
            var current=parseInt(currentId);
            var title=current?'子分类':'主分类';
            var disable=current?'disabled':'';
            var selectElement=categoryDisplayElementsTemplate('.category-template');
            selectElement.append('<option '+disable+' selected="true" value="0">请选择'+title+'</option>');
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
        function initProductInf() {
            if (productInf.product_id) {
                $('.product-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    v.value=productInf[field];
                });

//                var category=productInf.category;
//                console.log(category);
//                $('select.product-normal-info').removeClass('product-normal-info');
//                var selectElement=categoryDisplayElementsTemplate('.category-template');
//                var option=null;
//                for(var i in categoryList){
//                    if(categoryList[i].category_id==category)
//                    option=categoryList[i];
//                }
//                var optionElement=categoryDisplayElementsTemplate('.option-template');
//                optionElement.text(option.category_name);
//                optionElement.attr('selected','true');
//                optionElement.val(option.category_id);
//                selectElement.append(optionElement);
//                $('.category-select').after(selectElement);
            }
        }

        function updateProductInf(){
//            console.log(productInf);
            addRecord('product',productInf,'update',function(data){
                console.log(data);
                if(0==data.errcode){
                    if(productInf.product_id){
                        var href=getHref('product_list');
                        location.href=href;
                    }else{
                        location.reload(true);
//                        showToast('更改成功');
                    }
                }
            });
        }
        function initProvider() {
            var selectElement = categoryDisplayElementsTemplate('.category-template');
            selectElement.removeClass('category-select');
            selectElement.addClass('provider-select');
            selectElement.append('<option value="0" disabled="true" selected>供应商</option>');
            selectElement.attr('data-field','provider');
            ajaxPost('provider_list', {page: 0, number: 30,order:'desc',orderby:'provider_id'}, function (back) {
                var backValue = backHandle(back);
                $.each(backValue.list, function (k, v) {
                    var optionElement = categoryDisplayElementsTemplate('.option-template');
                    optionElement.attr('value', v.provider_id);
                    optionElement.text(v.unit);
                    selectElement.append(optionElement);
                });
                $('.provider-filter').append(selectElement);
            })
        }

    </script>

</div>