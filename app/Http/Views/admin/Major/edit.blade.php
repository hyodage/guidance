<!DOCTYPE html>
<html lang="en">
<head>
    <title>修改专业</title>
    @include('comment.init')
</head>
<body>
<div class="contain bs pa-10">
<form class="layui-form" action="">
  <div class="layui-form-item">
      <input id="h_id" type="hidden" value="{{$major['id']}}">
      <input id="h_zym" type="hidden" value="{{$major['zym']}}">
      {{csrf_field()}}
      <input type="text" name="major_name" required value="{{$major['zym']}}" lay-verify="required" placeholder="请输入新增专业名" autocomplete="off" class="layui-input">
  </div>
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="major_eidt_save()">提交</button>
  </div>
</from>
</div>
<script>
    // 保存修改的major
    function major_eidt_save(){
        var index=parent.layer.getFrameIndex(window.name);
        var h_zym = $.trim($('#h_zym').val());
        var name = $.trim($('input[name="major_name"]').val());
        var token = $.trim($('input[name="_token"]').val());
        var id = $.trim($('#h_id').val());
        if(name=='' || name==h_zym){
            layer.alert('专业名称未修改或为空',{'icon':2});
            return;
        }
        $.post('/major/editsave',{_token:token,'name':name,'id':id},function(res){
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