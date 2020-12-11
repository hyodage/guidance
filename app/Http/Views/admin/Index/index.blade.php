<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
<title>后台首页</title>
</head>
<body>
@include('comment.header')
<div class="contain">
{{csrf_field()}}
<p style="margin-top:200px">欢迎您！{{$msg['name']}}老师</p>
<p style="color:#666">(请在学生指导中通过{{$msg['num']}}位毕业论文指导的学生)</p>
</div>
</body>
</html>