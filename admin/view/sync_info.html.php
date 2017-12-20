<div id="core" style="height: 658px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>操作员流程权限控制</span></div>
        <div class="main">
            <table class="table sheet unit-table">
                <tr>
                    <td>
                        <button class="button sync-button" id="unit">同步单位</button>
                    </td><td>
                        <button class="button sync-button" id="staff">同步用户</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="main">
            <table class="table sheet">
                <tr>
                    <td>
                        <button class="button upload-excel">解析excel</button>
                        <input type="file" class="upload" id="excel-file" name="excel-file" style="display: none">
                    </td>
                    <td>
                        <button class="button get-unit-user-inf">获取</button>
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <script type="text/javascript" src="../js/ajaxfileupload.js"></script>
    <script>
        $('.sync-button').click(function(){
            var type=$(this).attr('id');
            loading();
            ajaxPost('syncInf',{type:type},function(data){
                stopLoading();
                showToast('ok');
            })
        });
        $('.upload-excel').click(function(){
            $('#excel-file').click();
        });
        $('#excel-file').change(function(){
            var url='upload.php?excel_file=1';
            var uploadData = {
                url: url,
                secureuri: false,
                fileElementId: 'excel-file', //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (v, status) {
                    console.log(v.status);
                },//服务器成功响应处理函数
                error: function (d) {

                }
            };
            //console.log(uploadData);
            $.ajaxFileUpload(uploadData);
        });
        $('.get-unit-user-inf').click(function(){

        });
    </script>


</div>