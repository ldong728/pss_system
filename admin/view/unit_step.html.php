<?php global $superUnit?>
<div id="core" style="height: 658px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>单位流程权限控制</span></div>
        <div class="main">
            <table class="table sheet unit-table">
                <tr class="h">
                    <td rowspan="2">单位名称</td>
                    <td colspan="6">流程权限</td>
                    <td rowspan="2">类别</td>
                </tr>
                <tr>
                    <td>提交</td>
                    <td>登记</td>
                    <td>审核</td>
                    <td>交办</td>
                    <td>办理</td>
                    <td>反馈</td>
                </tr>
<!--                <tr class="list-row">-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                    <td>abc</td>-->
<!--                </tr>-->
                <tr class="unit-table-foot">
                    <td colspan="8">
                        <div class="page_link">
                            <div class="in">
                                <a href="#" class="page-change" id="prev">上一页</a>
                                <span>共<span class="page-total"></span>页</span>
                                <span>当前第<span class="page-now" id="next"></span>页</span>
                                <a href="#" class="page-change" id="next">下一页</a>
<!--                                <input class="text" type="text" style="width:30px" name="page" value="1">-->
<!--                                <input class="button" type="button" value="跳转">-->
                            </div>
                        </div>
                        <!-- GOODUO -->
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <div class="main">
        <table class="table sheet">
            <tr>
                <td>筛选：</td>
                <td><input type="text" class="search-input"><button class="search-button">搜索</button> </td>
                <td>按单位筛选：<select class="super-unit"><option value="0">选择单位</option>
                        <?php foreach($superUnit as $row):?>
                            <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                        <?php endforeach ?>
                    </select></td>
                <td>
                <td>
                    按流程筛选：
                    <select class="step-filter">
                        <option value="0">选择流程</option>
                        <option value="1">提交</option>
                        <option value="2">登记</option>
                        <option value="3">审核</option>
                        <option value="4">交办</option>
                        <option value="5">办理</option>
                        <option value="6">反馈</option>
                    </select>
                </td>
                <td>
                    按类别筛选：
                    <select class="category-filter">
                        <option value="0">选择类别</option>
                        <option value="1">人大</option>
                        <option value="2">政协</option>
                        <option value="3">综合</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <script>
        var page=0;
        var orderby='unit_id';
        var order=true;
        var where=null;
        var totalPage=0;
        $(document).ready(function(){
            getUnitList();
            $('.page-change').click(function(){
                if('prev'==$(this).attr('id')&&page>0){
                    page--;
                    getUnitList();
                }
                if('next'==$(this).attr('id')&&page<totalPage-1){
                    page++;
                    getUnitList();
                }
            });
            $('.search-button').click(function(){
                var name=$('.search-input').val();
                if(name){
                    page=0;
                    where={unit_name:name};
                    getUnitList();
                }
            });
            $('.step-filter').change(function(){
               var _=$(this);
               var step= _.get(0).value;
                if(step>0){
                    page=0;
                    where={steps:step};
                    getUnitList();
                }else{
                    page=0;
                    where=null;
                    getUnitList();
                }
            });
            $('.category-filter').change(function(){
                var _=$(this);
                var category= _.get(0).value;
                if(category>0){
                    page=0;
                    if(!where)where={category:category};
                    else where.category=category;
                    getUnitList();
                }else{
                    page=0;
                    if(where)delete where.category;
                    getUnitList();
                }
            });
            $('.super-unit').change(function(){
                var _=$(this);
                var id= _.val();
                page=0;
                if(0!=id){
                    if(null!=where)where['parent_unit']=id;
                    else where={parent_unit:id};
                }else{
                    if(null!=where)delete(where.parent_unit);
                }
                getUnitList();

            });
        });
        $(document).on('change','.step-checkbox',function(){
            var _=$(this);
            var parentTr= _.parents('.list-row');
            var unitId=parentTr.attr('id').slice('3');
            var mySteps='';
            parentTr.find('.step-checkbox').each(function(k,v){
                if($(v).prop('checked'))mySteps+= v.value;
            });
            mylog(mySteps);
            altTable('unit','steps',mySteps,'unit_id',unitId,function(data){
                showToast('修改完成')
            });
        });
        $(document).on('change','.category-select',function(){
            var _=$(this);
            var value= _.get(0).value;
            var unitId= _.parent().attr('id').slice(3);
            console.log(value);
            if(value>0){
                altTable('unit','category',value,'unit_id',unitId,function(data){
                   showToast('修改完成');
                });
            }

        });

        function getUnitList(){
            var cateName=['属性选择','人大','政协','综合'];
            var orderStr=order?'asc':'desc';
            var whereValue=where||null;
            ajaxPost('reflashUnitList',{orderby:orderby,order:orderStr,page:page,where:whereValue},function(data){
               var backInf=backHandle(data);
//                console.log(backInf.page);
                $('.list-row').remove();
                $.each(backInf.list,function(k,v){
                    var stepStr=''+v.steps;
//                    console.log(stepStr);
                    var content='<tr class="list-row" id="row'+ v.unit_id+'">'+
                        '<td>'+ v.unit_name+'</td>';
                    for(var i=1;i<7;i++){
                        var check=stepStr.match(''+i)?'checked':'';
                        content+='<td><input class="step-checkbox" type="checkbox" value="'+i+'" '+check+'></td>'
                    }
                    content+='<td id="cat'+ v.unit_id+'"><select class="category-select">';
                    for (var j=0;j<4;j++){

                        var selected=j== v.category?'selected="selected"':'';
                        content+='<option value="'+j+'" '+selected+'>'+cateName[j]+'</option>'
                    }
                    content+='</select></td></tr>';
                    $('.unit-table-foot').before(content);
                });
                totalPage=backInf.page;
                $('.page-total').text(totalPage);
                $('.page-now').text(page+1);
            });
        }
        function reflashInf(){

        }
//        function pageChange()
    </script>
</div>