<!DOCTYPE html>
<html lang="en">
<head>
    @include('comment.init')
    <title>后台登录</title>
</head>
<body>
<div class="contain pa-10 bs">
<form class="layui-form" action="">
    {{csrf_field()}}
    <div class="layui-form-item">
        <input type="text" name="username" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-item">
        <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="pa-10">
        <button type="button" class="layui-btn" onclick="adologin()">登录</button>
    </div>
</from>
</div>
<script>
//登录触发
function adologin(){
    var username = $.trim($('input[name="username"]').val());
    var password = $.trim($('input[name="password"]').val());
    var token = $('input[name="_token"]').val();
    if(username == ''){
        layer.alert('请填写用户名',{icon:2});
        return;
    }
    if(password == ''){
        layer.alert('请填写密码',{icon:2});
        return;
    }
    $.post('/account/dologin',{_token:token,'username':username,'password':password},function(res){
        if(res.code==0){
            layer.msg(res.msg,{icon:2});
        }
        if(res.code==1){
            layer.msg(res.msg,{icon:1});
            setTimeout(function(){
                window.location.href = '/account/index';
            },100);
        }
    },'json')
}
</script>
</body>
</html>