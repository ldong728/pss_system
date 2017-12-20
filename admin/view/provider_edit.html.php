<?php global $providerInf ?>
<script>
    var providerInf = <?php echo $providerInf? json_encode($providerInf):'{}'?>;
</script>

<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>供应商信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tr>
                    <td>供应商名称：</td>
                    <td><input class="provider-normal-info" data-field="unit" type="text" placeholder="供应商名称"></td>
                    <td>联系人：</td>
                    <td><input class="provider-normal-info" data-field="contact" placeholder="联系人"></td>
                </tr>
                <tr>
                    <td>供应商地址：</td>
                    <td colspan="3"><input width="600" class="provider-normal-info" data-field="address" placeholder="输入地址"></td>
                </tr>
                <tr>
                    <td>联系电话</td>
                    <td><input type="tel" class="provider-normal-info" data-field="tel" placeholder="联系电话"> </td>
                    <td>传真：</td>
                    <td><input class="provider-normal-info" data-field="fax" placeholder="传真"></td>
                </tr>
                <tr>
                    <td>E-mail：</td>
                    <td><input type="tel" class="provider-normal-info" data-field="mail" placeholder="mail"> </td>
                    <td>QQ：</td>
                    <td><input type="tel" class="provider-normal-info" data-field="QQ" placeholder="QQ"> </td>
                </tr>
                <tr>
                    <td>开户银行：</td>
                    <td><input class="provider-normal-info" data-field="account_bank" placeholder="开户银行"></td>
                    <td>银行账号：</td>
                    <td><input type="tel" class="provider-normal-info" data-field="account" placeholder="银行账号"> </td>
                </tr>
            </table>
        </div>
        <div>
            <button class="button" id="submit">提交</button>
        </div>
    </div>
    <div class="space"></div>

    <script>
        $(document).ready(function () {
            initProviderInf();

            $(document).on('click','#submit',function(){
                $('.provider-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    providerInf[field]= v.value;
                });
//                console.log(providerInf);
                updateProviderInf();


            });

        });
        function initProviderInf() {
            if (providerInf.provider_id) {
                $('.provider-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    v.value=providerInf[field];
                });
            }
        }

        function updateProviderInf(){
            addRecord('provider',providerInf,'update',function(data){
                console.log(data);
                if(0==data.errcode){
                    if(providerInf.provider_id){
                        var href=getHref('provider_list');
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