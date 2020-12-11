<!DOCTYPE html>
<html lang="en">
<head>
    <title>教师编辑</title>
    @include('comment.init')
</head>
<body>
<div class="contain bs pa-10">
<form class="layui-form" action="">
<div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-block">
      <input type="text" name="name" value="{{$teacher['name']}}" required  lay-verify="required" placeholder="请输入教师姓名" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">职称</label>
    <div class="layui-input-block">
      <input type="text" name="zhicheng" value="{{$teacher['zhicheng']}}" required  lay-verify="required" placeholder="请输入教师职称" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">学历</label>
    <div class="layui-input-block">
      <input type="text" name="xueli" value="{{$teacher['xueli']}}" required  lay-verify="required" placeholder="请输入教师学历" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">电话</label>
    <div class="layui-input-block">
      <input type="text" name="phone" value="{{$teacher['phone']}}" required  lay-verify="required" placeholder="请输入教师电话" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">可指导人数</label>
    <div class="layui-input-block">
      <input type="text" name="num" value="{{$teacher['num']}}" required  lay-verify="required" placeholder="请输入该教师可指导人数" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">可指导专业</label>
    <div class="layui-input-block">
       @foreach($major as $item)
       <input type="checkbox" name="c_zy[{{$item['id']}}]" title="{{$item['zym']}}" lay-skin="primary" value="1"  {{in_array($item['id'],$teacher['c_zy'])?'checked':''}}>
       @endforeach
    </div>
</div>
<input type="hidden" name="id" value="{{$teacher['id']}}">
{{csrf_field()}}
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="teacher_eidt_save()">提交</button>
  </div>
</from>
</div>
<script>
    layui.use('form',function (){});
</script>
<script>
    // 保存修改的教师
    function teacher_eidt_save(){
        var index=parent.layer.getFrameIndex(window.name);
        // console.log($('form').serialize());
        $.post('/teacher/editsave',$('form').serialize(),function(res){
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