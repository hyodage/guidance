<!DOCTYPE html>
<html lang="en">
<head>
    <title>学生管理</title>
    @include('comment.init')
</head>
<body>
@include('comment.header')
<div class="contain bs pa-10-x">
    <div class="pa-10 right">
        {{csrf_field()}}
        <button type="button" class="layui-btn layui-btn-normal" onclick="student_add()">新增</button>
        <button type="button" class="layui-btn layui-btn-warm" onclick="student_deled()">已删除</button>
    </div>
    <table class="layui-table">
    <thead>
        <tr>
        <th>id</th>
        <th>姓名</th>
        <th>学号</th>
        <th>班级</th>
        <th>专业</th>
        <th>微信</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($student as $item)
        <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['username']}}</td>
            <td>{{$item['class']}}</td>
            <td>{{$item['zy']}}</td>
            <td>{{$item['wchat']}}</td>
            <td>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-sm" onclick="del_student({{$item['id']}})">删除</button>
                <button type="button" class="layui-btn layui-btn-sm" onclick="edit_student({{$item['id']}})">修改</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script>
    // 新增学生
    function student_add(id){
      layer.open({
        type:2,
        title:'添加学生',
        shade:0.3,
        area:['500px','350px'],
        offset: '50px',
        content:'/student/add'
      });
    }
    // 删除学生
    function del_student(id){
        var token = $.trim($('input[name="_token"]').val());
        $.post('/student/delsave',{_token:token,'id':id},function(res){
                if(res.code===0){
                    layer.msg(res.msg,{icon:2});
                }else{
                    layer.msg(res.msg,{icon:1});
                    setTimeout(function(){
                        window.location.reload();
                    },400)
                }
        },'json')
    }
    // 修改学生
    function edit_student(id){
        layer.open({
        type:2,
        title:'修改学生',
        shade:0.3,
        area:['500px','350px'],
        offset: '50px',
        content:'/student/edit/'+id
      });
    }
    // 已删除学生
    function student_deled(){
        layer.open({
        type:2,
        title:'已删除学生',
        shade:0.3,
        area:['500px','400px'],
        offset: '50px',
        content:'/student/deled'
      });
    }
</script>
</body>
</html>