<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>统计表</title>
</head>
<body>
<div class="contain bs pa-10-x">
<div class="pa-10" style="color:#666">
    <h3>毕业论文指导老师统计表</h3>
    <div class="right">
    <a href="/" class="layui-btn layui-btn-sm">首页</a>
    </div>
</div>
<table class="layui-table">
  <thead>
      <tr>
      <th>姓名</th>
      <th>职称</th>
      <th>学历</th>
      <th>电话</th>
      <th>可指导人数</th>
      <th>可指导专业</th>
      </tr> 
  </thead>
  <tbody>
      @foreach($teacher as $item)
      <tr>
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
      </tr>
      @endforeach
  </tbody>
</table>
</div>
</body>
</html>