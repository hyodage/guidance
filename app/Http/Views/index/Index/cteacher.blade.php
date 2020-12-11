<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>修改信息</title>
</head>
<body>
<div class="bs pa-10">
<form class="layui-form" action="">
{{csrf_field()}}
  <div class="layui-form-item">
    <label class="layui-form-label">指导老师</label>
    <div class="layui-input-block">
      <select name="teacher" lay-verify="required">
        <option value="">请选择指导老师</option>
        @foreach($teacher as $item)
        <option value="{{$item['id']}}" {{$item['id']===$tid?'selected':''}}>{{$item['name']}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="pa-10 right">
    <button type="button" class="layui-btn" onclick="layer_cancel()">取消</button>
    <button type="button" class="layui-btn" onclick="cteacher_save()">修改</button>
  </div>
  {{csrf_field()}}
</from>
</div>
<script>
    layui.use('form',function (){});
</script>
<script>
    function cteacher_save(){
        var index=parent.layer.getFrameIndex(window.name);
        // var token = $.trim($('input[name="_token"]').val());
        // var wchat = $.trim($('input[name="wchat"]').val());
        // var explain = $.trim($('#explain').val());
        $.post('/index/chteachersave',$('form').serialize(),function(res){
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