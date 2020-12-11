<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::namespace('index')->group(function () {
    // 前台首页
    Route::get('/','Index@index');
    
    Route::get('/index/login','Members@login');
    Route::post('/members/dologin','Members@dologin');

    // 3张表
    Route::get('/index/tongji','Table@index');
    Route::get('/index/review','Table@review');
    Route::get('/index/success','Table@success');
    // 提示
    Route::get('/index/tips','index@tips');
});
// 登录验证
Route::namespace('index')->middleware('authmember')->group(function () {
    // 前台首页
    Route::get('index/editpwd','Members@editpwd');//修改密码页面
    Route::post('/index/editpwdsave','Members@editpwdsave');//保存修改的密码
    Route::post('/index/logout','Members@logout');//退出登录
    Route::get('/index/editmsg','Members@editmsg');//修改信息
    Route::post('index/editmsgsave','Members@editmsgsave');//保存修改信息
    Route::get('/index/chteacher','Index@chteacher');//选择老师页面
    Route::post('/index/chteachersave','Index@chteachersave');//保存选择的老师
});

// 后台登录页
Route::get('/account/login','admin\Account@login')->name('adminlogin');
Route::post('/account/dologin','admin\Account@dologin');
// 后台管理
Route::namespace('admin')->middleware(['auth'])->group(function () {
    Route::get('/account/index','Index@index');//首页
    Route::post('/account/logout','Account@logout');//退出登录
    Route::get('/account/match','Match@index');//选择该教师的学生列表
    Route::post('/account/pass','Match@pass');//通过
    Route::post('/account/cancelpass','Match@cancelpass');//取消通过
    // Route::get('/email','Match@email');
    //专业
    Route::get('/major','Major@index');//专业列表
    Route::get('/major/add','Major@add');//新增专业
    Route::post('/major/addsave','Major@addsave');//保存新增的专业
    Route::post('/major/delsave','Major@delsave');//保存软删除
    Route::get('/major/edit/{id}','Major@edit');//编辑专业
    Route::post('/major/editsave','Major@editsave');//保存编辑的专业
    Route::get('/major/deled','Major@deled');//已删除专业
    Route::post('/major/majorRe','Major@majorRe');//保存已删除专业的永久删除和还原

    // 学生
    Route::get('/student','Student@index');//学生列表
    Route::get('/student/add','Student@add');//新增学生
    Route::post('/student/addsave','Student@addsave');//保存新增的学生
    Route::post('/student/delsave','Student@delsave');//保存软删除
    Route::get('/student/edit/{id}','Student@edit');//编辑学生
    Route::post('/student/editsave','Student@editsave');//保存编辑的学生
    Route::get('/student/deled','Student@deled');//已删除学生
    Route::post('/student/studentRe','Student@studentRe');//保存已删除学生的永久删除和还原

    // 老师
    Route::get('/teacher','Teacher@index');//老师列表
    Route::get('/teacher/add','Teacher@add');//新增老师
    Route::post('/teacher/addsave','Teacher@addsave');//保存新增的老师
    Route::post('/teacher/delsave','Teacher@delsave');//保存软删除
    Route::get('/teacher/edit/{id}','Teacher@edit');//编辑老师
    Route::post('/teacher/editsave','Teacher@editsave');//保存编辑的老师
    Route::get('/teacher/deled','Teacher@deled');//已删除老师
    Route::post('/teacher/teacherRe','Teacher@teacherRe');//保存已删除老师的永久删除和还原
});