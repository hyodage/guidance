<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>最终结果表</title>
</head>
<body>
<div class="contain bs pa-10-x">
<div class="pa-10" style="color:#666">
    <h3>毕业论文指导老师最终结果表</h3>
    <div class="right">
    <a href="/" class="layui-btn layui-btn-sm layui-btn-warm">首页</a>
    </div>
</div>
<table class="layui-table">
  <thead>
      <tr>
      <th>姓名</th>
      <th>匹配成功的学生</th>
      </tr> 
  </thead>
  <tbody>
      @foreach($list as $item)
      <tr>
          <td>{{$item['tid']}}</td>
          <th>
          @foreach($item['student'] as $j)
          <span class="layui-badge-rim">{{$j}}</span>
          @endforeach
          </th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
</body>
</html>