<!DOCTYPE html>
<html lang="en">
<head>
@include('comment.init')
    <title>Document</title>
    <style>
        ul li{margin:7px 0px;}
    </style>
</head>
<body>
<div class="pa-10">
<ul type="circle" style="color:#666">
<li>
1.登录的必要性:防止有人输入他人学号就可以修改该学生选择的老师，这也是修改密码的必要性
</li>
<li>
2.密码安全性:password_hash()使用足够强度的单向散列算法创建密码的散列(hash)，不会被像md5算法一样通过字典方式破解。(即使数据库被破也不会有撞库的风险)
</li>
<li>
3.微信号信息所有老师可见其他学生不可见，自定义说明仅选择的老师可见。
</li>
</ul>
</div>
<hr class="layui-bg-green">
<div class="contain">
<i class="layui-icon layui-icon-login-qq" style="font-size: 15px; color: #1E9FFF;"></i><span class="pa-10-x">1223818894</span>
</div>
</body>
</html>