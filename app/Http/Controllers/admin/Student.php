<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Student extends Controller
{
    // 学生管理首页
    public function index(){
        $_admin = Auth::user()->toArray();
        $data['admin'] = $_admin;
        $student = DB::table('student')->where('status',1)->orderBy('id', 'desc')->lists();
        $major = DB::table('major')->cates('id');
        foreach($student as $key=>$value){
            $student[$key]['zy'] = $major[$student[$key]['zy']]['zym'];
        }
        $data['student'] = $student;
        return view('admin.Student.index',$data);
    }
    // 新增学生页面
    public function add(){
        $data['major'] = DB::table('major')->lists();
        return view('admin.Student.add',$data);
    }
    // 学生添加保存
    public function addsave(Request $req){
        $name = trim($req->name);
        $username = trim($req->username);
        $class = trim($req->class);
        $zy = (int)$req->zy;
        $pwd = password_hash('123456', PASSWORD_DEFAULT);
        $res = DB::table('student')->insert(
            ['name' => $name,'username'=>$username,'class'=>$class,'zy'=>$zy,'status'=>1,'password'=>$pwd]
        );
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'新增成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'新增失败']));
    }
    // 删除学生保存
    public function delsave(Request $req){
        $id = (int)$req->id;
        $res = DB::table('student')
            ->where('id', $id)
            ->update(['status'=>0]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'删除成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'删除失败']));
    }
    // 编辑学生页面
    public function edit(Request $req){
        $id = (int)$req->id;
        $data['student'] = DB::table('student')->where('id',$id)->item();
        $data['major'] = DB::table('major')->lists();
        return view('admin.Student.edit',$data);
    }
    // 学生编辑保存
    public function editsave(Request $req){
        $id = (int)$req->id;
        $name = trim($req->name);
        $username = trim($req->username);
        $class = trim($req->class);
        $zy = (int)$req->zy;
        $pwd = password_hash('123456', PASSWORD_DEFAULT);
        $res = DB::table('student')->where('id',$id)->update(
            ['name' => $name,'username'=>$username,'class'=>$class,'zy'=>$zy,'password'=>$pwd]
        );
        DB::table('student')->update(
            ['wchat'=>'','explain'=>'','email'=>'']
        );
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改失败']));
    }
    // 已删除专业页面
    public function deled(){
        $data['deled'] = DB::table('student')->where('status',0)->lists();
        return view('admin.Student.deled',$data);
    }
    //回收站编辑
    public function studentRe(Request $req){
        $type = (int)$req->type;
        $id = (int)$req->id;
        if($type===1){
            // 永久删除
            $res = DB::table('student')
            ->where('id',$id)
            ->delete();
        }else{
            // 还原
            $res = DB::table('student')
            ->where('id',$id)
            ->update(['status'=>1]);
        }
        if($res){
            exit(json_encode(['code'=>1,'type'=>$type,'msg'=>'操作成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'操作失败']));
    }
}
