<!DOCTYPE html>
<html lang="en">
<head>
    <title>已删除教师</title>
    @include('comment.init')
</head>
<body>
<div class="contain bs pa-10">
<table class="layui-table">
    <thead>
        <tr>
        <th>姓名</th>
        <th>职称</th>
        <th>电话</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($deled as $item)
        <tr>
            <td>{{$item['name']}}</td>
            <td>{{$item['zhicheng']}}</td>
            <td>{{$item['phone']}}</td>
            <td>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-sm" onclick="teacherRe({{$item['id']}},type=1)">永久删除</button>
                <button type="button" class="layui-btn layui-btn-sm" onclick="teacherRe({{$item['id']}},type=2)">还原</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{csrf_field()}}
</div>
<script>
    // 操作回收站
    function teacherRe(id,type){
        var token = $.trim($('input[name="_token"]').val());
        $.post('/teacher/teacherRe',{_token:token,'id':id,'type':type},function(res){
                if(res.code===0){
                    layer.msg(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg,{icon:1});
                    setTimeout(function(){
                        window.location.reload();
                        if(res.type===2){
                            window.parent.location.reload();
                        }
                    },400)
                }
        },'json')
    }
</script>
</body>
</html>