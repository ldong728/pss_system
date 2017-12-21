<?php global $productInf ?>
<script>
    var productInf = <?php echo $productInf? json_encode($productInf):'{}'?>;
</script>

<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>产品信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tr>
                    <td>类别</td>
                    <td colspan="3" class="category-filter"><select class="category-template category-select product-normal-info" data-field="category"><option class="option-template"></option></select></td>
                </tr>
                <tr>
                    <td>商品名称：</td>
                    <td><input class="product-normal-info" data-field="name" type="text" placeholder="商品名称"></td>
                    <td>序列号：</td>
                    <td><input class="product-normal-info" data-field="sn" placeholder="序列号"></td>
                </tr>
                <tr>
                    <td>商品描述</td>
                    <td colspan="3"><input width="600" class="product-normal-info" data-field="description" placeholder="商品描述"></td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td><input type="tel" class="product-normal-info" data-field="default_price" placeholder="价格"> </td>
                    <td>计量单位</td>
                    <td><input class="product-normal-info" data-field="unit" placeholder="个" value="个"></td>
                </tr>
            </table>
        </div>
        <div>
            <button class="button" id="submit">提交</button>
        </div>
    </div>
    <div class="space"></div>
    <script type="application/javascript" src="js/tableController.js"></script>
    <script>
        var categoryList,categoryDisplayElementsTemplate;
        $(document).ready(function () {

            registEvent();
            initCategory();


        });

        function registEvent(){
            $(document).on('click','#submit',function(){
                $('.product-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    productInf[field]= $(v).val();
                });
//                console.log(productInf);
                updateProductInf();
            });
            $(document).on('change','.category-select',function(){
                var id=this.value;
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
                var category=productInf.category;
                console.log(category);
                $('select.product-normal-info').removeClass('product-normal-info');
                var selectElement=categoryDisplayElementsTemplate('.category-template');
                var option=null;
                for(var i in categoryList){
                    if(categoryList[i].category_id==category)
                    option=categoryList[i];
                }
                var optionElement=categoryDisplayElementsTemplate('.option-template');
                optionElement.text(option.category_name);
                optionElement.attr('selected','true');
                optionElement.val(option.category_id);
                selectElement.append(optionElement);
                $('.category-select').after(selectElement);
            }
        }

        function updateProductInf(){
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

    </script>

</div>