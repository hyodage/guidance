<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @include('comment.init')
</head>
<body>
<div class="contain">
  <div class="pa-10">
      @if($index_msg)
      <div class="right">
        <span class="poi opa layui-badge" onclick="loginout()">退出登录<span class="layui-badge-dot layui-bg-gray" style="margin-left:10px"></span></span>
        <span class="poi opa layui-badge layui-bg-blue" onclick="c_teacher()">选择指导老师<span class="layui-badge-dot layui-bg-gray" style="margin-left:10px"></span></span>
        <span class="poi opa layui-badge layui-bg-orange" onclick="edit_pwd()">修改密码<span class="layui-badge-dot layui-bg-gray" style="margin-left:10px"></span></span>
        <span class="poi opa layui-badge layui-bg-green" onclick="edit_msg()">修改信息<span class="layui-badge-dot layui-bg-gray" style="margin-left:10px"></span></span>
        <span class="poi opa layui-badge layui-bg-black">欢迎你!{{$index_msg['name']}}<span class="layui-badge-dot layui-bg-gray" style="margin-left:10px"></span></span>
      </div>
      @endif
      @if(!$index_msg)
      <div class="right">
      <button type="button" class="layui-btn layui-btn-sm layui-btn-warm" onclick="slogin()">登录</button>
      </div>
      @endif
      <hr>
  </div>
  <div class="pa-10"><a href="/index/tongji" class="layui-btn">毕业论文指导老师统计表</a></div>
  <div class="pa-10"><a href="/index/review" class="layui-btn layui-btn-normal">毕业论文指导老师预选表</a></div>
  <div class="pa-10"><a href="/index/success" class="layui-btn layui-btn-warm">毕业论文指导老师最终表</a></div>
  <div class="pa-10 f-12 cl-red">
    <i class="layui-icon layui-icon-speaker" style=""></i>  
    <span>登录后:
    <span class="layui-badge layui-bg-gray">1</span>
    修改密码;
    <span class="layui-badge layui-bg-gray">2</span>
    填写微信号,邮箱(通过状态由邮箱通知,微信用于老师联系你,都只有老师和自己可见)和说明,方便老师通过并联系你</span><span class="pa-10-x poi opa" onclick="tips()" style="color:#00acec">[tips]</span>
  </div>
    {{csrf_field()}}
</div>
<script>
function slogin(){
  layer.open({
    type: 2,
    title: '登录',
    shadeClose: true,
    shade: 0.3,
    offset: '50px',
    area: ['370px', '250px'],
    content: '/index/login'
  })
}
function edit_pwd(){
  layer.open({
    type: 2,
    title: '修改密码',
    shadeClose: true,
    shade: 0.3,
    offset: '50px',
    area: ['370px', '250px'],
    content: '/index/editpwd'
  })
}
function loginout(){
  layer.confirm('确定要退出吗？', {
    icon:3,
    offset: '50px',
    btn: ['确定','取消']
  }, function(){
      $.post('/index/logout',{_token:$('input[name="_token"]').val()},function(res){
        if(res.code===1){
            layer.msg(res.msg,{icon:1});
            setTimeout(function(){
                window.location.reload();
            },400)
        }
      },'json');
  });
}
function edit_msg(){
  layer.open({
    type: 2,
    title: '修改信息',
    shadeClose: true,
    shade: 0.3,
    offset: '50px',
    area: ['400px', '540px'],
    content: '/index/editmsg'
  })
}
function c_teacher(){
  layer.open({
    type: 2,
    title: '选择指导老师',
    shadeClose: true,
    shade: 0.3,
    offset: '50px',
    area: ['370px', '250px'],
    content: '/index/chteacher'
  })
}
function tips(){
  layer.open({
    type: 2,
    title: 'tips',
    shadeClose: true,
    shade: 0.3,
    offset: '50px',
    area: ['380px', '300px'],
    content: '/index/tips'
  })
}
</script>
</body>
</html>