<!DOCTYPE html>
<html lang="en">
<head>
    <title>添加专业</title>
    @include('comment.init')
</head>
<body>
<div class="contain bs pa-10">
<form class="layui-form" action="">
{{csrf_field()}}
  <div class="layui-form-item">
      <input type="text" name="major_name" required  lay-verify="required" placeholder="请输入新增专业名" autocomplete="off" class="layui-input">
  </div>
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="major_add_save()">提交</button>
  </div>
</from>
</div>
<script>
    // 保存添加的major
    function major_add_save(){
        var index=parent.layer.getFrameIndex(window.name);
        var name = $.trim($('input[name="major_name"]').val());
        var token = $.trim($('input[name="_token"]').val());
        if(name==''){
            layer.alert('请输入专业名称',{'icon':2});
            return;
        }
        $.post('/major/addsave',{_token:token,'name':name},function(res){
                if(res.code===0){
                    layer.msg(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg,{icon:1});
                    
                    setTimeout(function(){
                        window.parent.location.reload();
                        parent.layer.close(index);
                    },400)
                }
        },'json')
    }
</script>
</body>
</html>