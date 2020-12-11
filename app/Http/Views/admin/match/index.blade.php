<!DOCTYPE html>
<html lang="en">
<head>
    <title>专业管理</title>
    @include('comment.init')
</head>
<body>
@include('comment.header')
<div class="bs pa-10-x">
<p class="right" style="color:#666;padding:12px">允许指导的学生人数{{$total}}人,当前已选{{$has}}人</p>
<table class="layui-table">
    <thead>
        <tr>
        <th>姓名</th>
        <th>学号</th>
        <th>专业</th>
        <th>班级</th>
        <th>微信</th>
        <th>说明</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($match as $item)
        <tr>
            <th>{{$item['name']}}</th>
            <th>{{$item['username']}}</th>
            <th>{{$item['zy']}}</th>
            <th>{{$item['class']}}</th>
            <th>{{$item['wchat']}}</th>
            <th>{{$item['explain']}}</th>
            <td>
            @if($item['status']==100)
            <button type="button" class="layui-btn layui-btn-warm layui-btn-sm" onclick="askcancel({{$item['id']}})">取消</button>
            @endif
            @if($item['status']==1)
            <button type="button" class="layui-btn layui-btn-sm" onclick="pass({{$item['id']}})">通过</button>
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
{{csrf_field()}}
<script>
//通过 
function pass(id){
    var token = $('input[name="_token"]').val();
    $.post('/account/pass',{_token:token,'id':id},function(res){
        if(res.code==1){
            layer.msg(res.msg,{icon:1});
            setTimeout(function(){
                window.location.reload();
            },400);
        }
        if(res.code==0){
            layer.msg(res.msg,{icon:2});
            setTimeout(function(){
                window.location.reload();
            },400);
        }
    },'json')
}
// 取消
function cancelPass(id){
    var token = $('input[name="_token"]').val();
    $.post('/account/cancelpass',{_token:token,'id':id},function(res){
        if(res.code==1){
            layer.msg(res.msg,{icon:1});
            setTimeout(function(){
                window.location.reload();
            },400);
        }
        if(res.code==0){
            layer.msg(res.msg,{icon:2});
            setTimeout(function(){
                window.location.reload();
            },400);
        }
    },'json')
}
// 询问
function askcancel(id){
    layer.confirm('确定要取消该学生吗', {
    btn: ['确定','取消'] //按钮
}, function(){
    cancelPass(id);
}, function(){
    layer_cancel();
});
}

</script>
</body>
</html>