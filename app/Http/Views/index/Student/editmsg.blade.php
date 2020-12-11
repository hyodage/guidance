<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>修改信息</title>
</head>
<body>
<div class="contain bs pa-10">
<form class="layui-form" action="">
{{csrf_field()}}
  <div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-block">
      <input type="text" disabled name="name" required  lay-verify="required" value="{{$index_msg['name']}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">学号</label>
    <div class="layui-input-block">
        <input type="text" disabled name="card" required  lay-verify="required" value="{{$index_msg['username']}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">班级</label>
    <div class="layui-input-block">
        <input type="text" disabled name="class" required  lay-verify="required" value="{{$index_msg['class']}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">微信</label>
    <div class="layui-input-block">
      <input type="text" name="wchat" placeholder="请输入微信账号" required  lay-verify="required" value="{{$index_msg['wchat']}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">邮箱</label>
    <div class="layui-input-block">
      <input type="text" name="email" placeholder="请输入邮箱" required  lay-verify="required" value="{{$index_msg['email']}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">说明</label>
    <div class="layui-input-block">
        <textarea id="explain" name="explain" placeholder="请输入说明" class="layui-textarea">{{$index_msg['explain']}}</textarea>
    </div>
  </div>
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="msg_edit_save()">修改</button>
  </div>
  {{csrf_field()}}
</from>
</div>
<script>
    function msg_edit_save(){
        var index=parent.layer.getFrameIndex(window.name);
        var token = $.trim($('input[name="_token"]').val());
        var wchat = $.trim($('input[name="wchat"]').val());
        var email = $.trim($('input[name="email"]').val());
        var explain = $.trim($('#explain').val());
        $.post('/index/editmsgsave',{_token:token,'wchat':wchat,'explain':explain,'email':email},function(res){
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