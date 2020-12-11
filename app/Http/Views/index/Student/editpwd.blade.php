<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>修改密码</title>
</head>
<body>
<div class="contain bs pa-10">
<form class="layui-form" action="">
{{csrf_field()}}
  <div class="layui-form-item">
      <input type="password" name="pwd1" required  lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
  </div>
  <div class="layui-form-item">
      <input type="password" name="pwd2" required  lay-verify="required" placeholder="确认密码" autocomplete="off" class="layui-input">
  </div>
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="pwd_edit_save()">修改</button>
  </div>
</from>
</div>
<script>
    function pwd_edit_save(){
        var index=parent.layer.getFrameIndex(window.name);
        var pwd1 = $.trim($('input[name="pwd1"]').val());
        var pwd2 = $.trim($('input[name="pwd2"]').val());
        var token = $.trim($('input[name="_token"]').val());
        if(pwd1 !== pwd2){
            layer.alert('密码不一致,请重新输入',{'icon':2});
            $('input[name="pwd1"]').val('');
            $('input[name="pwd2"]').val('');
            return;
        }
        $.post('/index/editpwdsave',{_token:token,'pwd':pwd1},function(res){
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