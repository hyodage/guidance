<ul class="layui-nav">
  <li class="layui-nav-item">
    <a class="poi" href="/account/index">{{$admin['username']}}</a>
    <dl class="layui-nav-child">
        <dd><a onclick="alogout()" class="poi">退出登录</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item">
    <a href="/major">专业管理</a>
  </li>
  <li class="layui-nav-item">
    <a href="/student">学生管理</a>
  </li>
  <li class="layui-nav-item">
    <a href="/teacher">老师管理</a>
  </li>
  <li class="layui-nav-item">
    <a href="/account/match">学生指导<span class="layui-badge-dot"></span></a>
  </li>
</ul>
<script>
    layui.use('element', function(){});
</script>
<script>
//登录触发
function alogout(){
    var token = $('input[name="_token"]').val();
    $.post('/account/logout',{_token:token},function(res){
        if(res.code==1){
            layer.msg(res.msg,{icon:1});
            setTimeout(function(){
                window.location.href = '/account/login';
            },100);
        }
    },'json')
}
</script>