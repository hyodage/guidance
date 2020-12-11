<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>预选表</title>
</head>
<body>
<div class="contain bs pa-10-x">
<div class="pa-10" style="color:#666">
    <h3>毕业论文指导老师预选表</h3>
    <div class="right">
    <a href="/" class="layui-btn layui-btn-sm layui-btn-normal">首页</a>
    </div>
</div>
<table class="layui-table">
  <thead>
      <tr>
      <th>姓名</th>
      <th>当前剩余</th>
      <th>正在预选的学生</th>
      <th>匹配成功的学生</th>
      </tr> 
  </thead>
  <tbody>
      @foreach($list as $item)
      <tr>
          <td>{{$item['tid']}}</td>
          <th>{{$item['total']-$item['has']}}</th>
          <th>
          @foreach($item['review'] as $j)
          <span class="layui-badge-rim">{{$j}}</span>
          @endforeach
          </th>
          <th>
          @foreach($item['success'] as $j)
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