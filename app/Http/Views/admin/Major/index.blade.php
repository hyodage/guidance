<!DOCTYPE html>
<html lang="en">
<head>
    <title>专业管理</title>
    @include('comment.init')
</head>
<body>
@include('comment.header')
<div class="contain bs pa-10-x">
    <div class="pa-10 right">
        {{csrf_field()}}
        <button type="button" class="layui-btn layui-btn-normal" onclick="major_add()">新增</button>
        <button type="button" class="layui-btn layui-btn-warm" onclick="major_deled()">已删除</button>
    </div>
    <table class="layui-table">
    <colgroup>
        <col width="15%">
        <col width="35%">
        <col>
    </colgroup>
    <thead>
        <tr>
        <th>ID</th>
        <th>专业</th>
        <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($major as $item)
        <tr>
            <td>{{$item['id']}}</td>
            <td>{{$item['zym']}}</td>
            <td>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-sm" onclick="del_major({{$item['id']}})">删除</button>
                <button type="button" class="layui-btn layui-btn-sm" onclick="edit_major({{$item['id']}})">修改</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
<script>
    // 新增专业
    function major_add(id){
      layer.open({
        type:2,
        title:'添加专业',
        shade:0.3,
        area:['370px','200px'],
        offset: '50px',
        content:'/major/add'
      });
    }
    // 删除专业
    function del_major(id){
        var token = $.trim($('input[name="_token"]').val());
        $.post('/major/delsave',{_token:token,'id':id},function(res){
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
    // 修改专业
    function edit_major(id){
        layer.open({
        type:2,
        title:'修改专业',
        shade:0.3,
        area:['370px','200px'],
        offset: '50px',
        content:'/major/edit/'+id
      });
    }
    // 已删除专业
    function major_deled(){
        layer.open({
        type:2,
        title:'已删除专业',
        shade:0.3,
        area:['370px','400px'],
        offset: '50px',
        content:'/major/deled'
      });
    }
</script>
</body>
</html>