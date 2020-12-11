<!DOCTYPE html>
<html lang="en">
<head>
    <title>教师管理</title>
    @include('comment.init')
</head>
<body>
@include('comment.header')
<div class="contain bs pa-10-x">
    <div class="pa-10 right">
        {{csrf_field()}}
        <button type="button" class="layui-btn layui-btn-normal" onclick="teacher_add()">新增</button>
        <button type="button" class="layui-btn layui-btn-warm" onclick="teacher_deled()">已删除</button>
    </div>
    <table class="layui-table">
    <colgroup>
        <col>
    </colgroup>
    <thead>
        <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>职称</th>
        <th>学历</th>
        <th>电话</th>
        <th>可指导人数</th>
        <th>可指导专业</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($teacher as $item)
        <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['name']}}</td>
            <th>{{$item['zhicheng']}}</th>
            <th>{{$item['xueli']}}</th>
            <th>{{$item['phone']}}</th>
            <th>{{$item['num']}}</th>
            <th>
            @foreach($item['c_zy'] as $j)
            {{$j}}
            @endforeach
            </th>
            <td>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-sm" onclick="del_teacher({{$item['id']}})">删除</button>
                <button type="button" class="layui-btn layui-btn-sm" onclick="edit_teacher({{$item['id']}})">修改</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script>
    // 新增教师
    function teacher_add(id){
      layer.open({
        type:2,
        title:'添加教师',
        shade:0.3,
        area:['500px','500px'],
        offset: '50px',
        content:'/teacher/add'
      });
    }
    // 删除教师
    function del_teacher(id){
        var token = $.trim($('input[name="_token"]').val());
        $.post('/teacher/delsave',{_token:token,'id':id},function(res){
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
    // 修改教师
    function edit_teacher(id){
        layer.open({
        type:2,
        title:'修改教师',
        shade:0.3,
        area:['500px','500px'],
        offset: '50px',
        content:'/teacher/edit/'+id
      });
    }
    // 已删除教师
    function teacher_deled(){
        layer.open({
        type:2,
        title:'已删除教师',
        shade:0.3,
        area:['600px','500px'],
        offset: '50px',
        content:'/teacher/deled'
      });
    }
</script>
</body>
</html>