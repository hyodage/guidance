<!DOCTYPE html>
<html lang="en">
<head>
    <title>添加学生</title>
    @include('comment.init')
</head>
<body>
<div class="bs pa-10">
<form class="layui-form" action="">
<div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-block">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入学生姓名" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">学号</label>
    <div class="layui-input-block">
      <input type="text" name="username" required  lay-verify="required" placeholder="请输入学号" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
<label class="layui-form-label">专业</label>
    <div class="layui-input-block">
        <select name="zy" lay-verify="">
            <option value="">请选择专业</option>
            @foreach($major as $item)
            <option value="{{$item['id']}}">{{$item['zym']}}</option>
            @endforeach
        </select> 
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">班级</label>
    <div class="layui-input-block">
      <input type="text" name="class" required  lay-verify="required" placeholder="请输入班级(如：17计算机一)" autocomplete="off" class="layui-input">
    </div>
</div>
{{csrf_field()}}
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="student_add_save()">提交</button>
  </div>
</from>
</div>
<script>
    layui.use('form',function (){});
</script>
<script>
    // 保存添加的学生
    function student_add_save(){
        var index=parent.layer.getFrameIndex(window.name);
        $.post('/student/addsave',$('form').serialize(),function(res){
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