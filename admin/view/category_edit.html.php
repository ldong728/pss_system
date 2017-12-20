<style>
    td {min-width: 150px}
    table {
        margin-bottom: 30px;
    }
    .table-title td {
        background-color: #aaaaaa;
    }
</style>
<div class="block">
    <div class="head">
        分类编辑
    </div>
    <div class="category-container">
        <table class="table sheet category-table">
            <tr class="table-title">
                <td class="category-name"></td><td><button class="button add-current">添加分类项</button></td>
            </tr>
            <tr class="sub-category">
                <td class="sub-category-name"></td><td><button class="button show-sub">查看子分类</button><button class="button delete-category">删除分类</button></td>
            </tr>
        </table>
    </div>
</div>






<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var categoryList=null;
    var elements;
    $(document).ready(function(){
        elements=TableController.prepareElement('.sub-category','.category-table');
        getCategoryList();
        registEvent();
    });

    function getCategoryList(){
        $('category-container').empty();


        ajaxPost('category_list',{},function(back){
            var backValue=backHandle(back);
            if(backValue){
                categoryList=backValue;
            }
            var main=initCategoryList(0,'主分类',1);
            $('.category-container').append(main);
        });
    }
    function initCategoryList(parentId,parentName,level){
//        var pId=parentId||0;
        var mainCategory=elements('.category-table');
        mainCategory.find('.category-name').text(parentName+'('+level+'级分类'+')');
        mainCategory.attr('id',parentId);
        mainCategory.addClass('level'+level);
        mainCategory.attr('data-level',level);
        $.each(categoryList,function(k,v){
            if(parseInt(parentId)===parseInt(v.p_category)){
                var trElement=elements('.sub-category');
                var element=trElement.find('.sub-category-name');
                var button=trElement.find('.show-sub');
                var delButton=trElement.find('.delete-category');
                element.addClass('ipt-toggle');
                element.attr('id',v.category_id);
                element.attr('data-tbl','category');
                element.attr('data-col','category_name');
                element.attr('data-index','category_id');
                element.text(v.category_name);
                button.attr('data-parent', v.category_id);
                button.attr('data-level', level+1);
                delButton.attr('id','del'+ v.category_id);
                mainCategory.append(trElement);
            }
        });
        return mainCategory;

    }
    function registEvent(){
        $(document).on('click','.add-current',function(){
            var parent=$(this).parents('.category-table');
            var parentId=parent.attr('id');
            var parentLevel=parseInt(parent.data('level'));
            ajaxPost('add_category',{parent_id:parentId},function(back){
                var backValue=backHandle(back);
                if(backValue){
                    var trElement=elements('.sub-category');
                    var element=trElement.find('.sub-category-name');
                    var button=trElement.find('.show-sub');
                    var delButton=trElement.find('.delete-category');
                    element.addClass('ipt-toggle');
                    element.attr('id',backValue.id);
                    element.attr('data-tbl','category');
                    element.attr('data-col','category_name');
                    element.attr('data-index','category_id');
                    element.text(backValue.name);
                    button.attr('data-parent', backValue.id);
                    button.attr('data-level', parentLevel+1);
                    delButton.attr('id','del'+backValue.id);
                    parent.append(trElement);
                }else{
                    alert('数据库错误');
                }
                console.log(back);
            });
        });
        $(document).on('click','.show-sub',function(){
            var button=$(this);
                    var parent=button.parents('.category-table');
                    var parentId=parseInt(button.data('parent'));
                    var name=button.parent('td').prev().text();
                    var level=parseInt(button.data('level'));
                    var sub=initCategoryList(parentId,name,level);
                    parent.nextAll().remove();
                    parent.after(sub);

        });
        $(document).on('click','.delete-category',function(){
            var button=$(this);
           var id=$(this).attr('id').slice(3);
            console.log(id);
            ajaxPost('delete_category',{id:id},function(data){
               var back=backHandle(data);
                if(back){
                    button.parents('tr').remove();
                }else{
                    alert('不能删除')
                }
            });
        });
    }
</script>