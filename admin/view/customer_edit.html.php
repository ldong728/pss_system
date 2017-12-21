<?php global $customerInf ?>
<script>
    var customerInf = <?php echo $customerInf? json_encode($customerInf):'{}'?>;
</script>

<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>客户信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tr>
                    <td>客户名称：</td>
                    <td><input class="customer-normal-info" data-field="customer_name" type="text" placeholder="客户名称"></td>
                    <td>联系电话：</td>
                    <td><input type="tel" class="customer-normal-info" data-field="customer_tel" placeholder="联系电话"></td>
                </tr>
                <tr>
                    <td>客户地址：</td>
                    <td colspan="3"><input class="customer-normal-info" data-field="customer_address" placeholder="输入地址" style="width: 250px;max-width: 120px;min-width: 600px"></td>
                </tr>
            </table>
        </div>
        <div>
            <button class="button" id="submit">提交</button>
        </div>
    </div>
    <div class="space"></div>



</div>
<script>
    $(document).ready(function () {
        initCustomerInf();

        $(document).on('click','#submit',function(){
            $('.customer-normal-info').each(function(k,v){
                var field=$(v).data('field');
                customerInf[field]= v.value;
            });
//            console.log(customerInf);
                updateCustomerInf();


        });

    });
    function initCustomerInf() {
        if (customerInf.customer_id) {
            $('.customer-normal-info').each(function(k,v){
                var field=$(v).data('field');
                v.value=customerInf[field];
            });
        }
    }

    function updateCustomerInf(){

        addRecord('customer',customerInf,'update',function(data){
            console.log(data);
            if(0==data.errcode){
                if(customerInf.customer_id){
                    var href=getHref('customer_list');
                    location.href=href;
                }else{
                    location.reload(true);
//                        showToast('更改成功');
                }
            }
        });
    }

</script>