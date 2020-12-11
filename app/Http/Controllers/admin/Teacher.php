<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Teacher extends Controller
{
    // 教师管理首页
    public function index(){
        $_admin = Auth::user()->toArray();
        $data['admin'] = $_admin;
        $major = DB::table('major')->where('status',1)->cates('id');
        $teacher = DB::table('teacher')->where('status',1)->orderBy('id', 'desc')->lists();
        foreach($teacher as $key => $value){
            $teacher[$key]['c_zy'] = $this->getmajor($teacher[$key]['c_zy'],$major);
        }
        $data['teacher'] = $teacher;
        return view('admin.Teacher.index',$data);
    }
    // 教师添加页面
    public function add(){
        $data['major'] = DB::table('major')->where('status',1)->lists();
        return view('admin.Teacher.add',$data);
    }
    // 教师添加保存
    public function addsave(Request $req){
        $name = trim($req->name);
        $zhicheng = trim($req->zhicheng);
        $xueli = trim($req->xueli);
        $phone = trim($req->phone);
        $num = (int)$req->num;
        $c_zy_arr = array_keys($req->c_zy);
        $res = DB::table('teacher')->insert(
            ['name'=>$name,'zhicheng' => $zhicheng,
            'xueli'=>$xueli,'phone'=>$phone,'num'=>$num,
            'c_zy'=>json_encode($c_zy_arr)]
        );
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'新增成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'新增失败']));
    }
    // 删除教师保存
    public function delsave(Request $req){
        $id = (int)$req->id;
        $res = DB::table('teacher')
            ->where('id', $id)
            ->update(['status'=>0]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'删除成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'删除失败']));
    }
    // 编辑教师页面
    public function edit(Request $req){
        $id = (int)$req->id;
        $data['teacher'] = DB::table('teacher')->where('id',$id)->item();
        $major = DB::table('major')->where('status',1)->cates('id');
        $data['teacher']['c_zy'] = json_decode($data['teacher']['c_zy'],true);
        $data['major'] = $major;
        // echo '<pre>';
        // print_r($data);
        return view('admin.Teacher.edit',$data);
    }
    // 教师编辑保存
    public function editsave(Request $req){
        $id = (int)($req->id);
        $name = trim($req->name);
        $zhicheng = trim($req->zhicheng);
        $xueli = trim($req->xueli);
        $phone = trim($req->phone);
        $num = (int)$req->num;
        $c_zy_arr = array_keys($req->c_zy);
        $res = DB::table('teacher')->where('id',$id)->update(
            ['name'=>$name,'zhicheng' => $zhicheng,
            'xueli'=>$xueli,'phone'=>$phone,'num'=>$num,
            'c_zy'=>json_encode($c_zy_arr)]
        );
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改失败']));
    }
    // 已删除教师页面
    public function deled(){
        $data['deled'] = DB::table('teacher')->where('status',0)->lists();
        return view('admin.Teacher.deled',$data);
    }
    //回收站编辑
    public function teacherRe(Request $req){
        $type = (int)$req->type;
        $id = (int)$req->id;
        if($type===1){
            // 永久删除
            $res = DB::table('teacher')
            ->where('id',$id)
            ->delete();
        }else{
            // 还原
            $res = DB::table('teacher')
            ->where('id',$id)
            ->update(['status'=>1]);
        }
        if($res){
            exit(json_encode(['code'=>1,'type'=>$type,'msg'=>'操作成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'操作失败']));
    }
    public function getmajor($str,$list){
        $rights = json_decode($str,true);
        $result = [];
        foreach($rights as $key => $value){
            $result[$key] = $list[$value]['zym'];
        }
        return $result;
    }
}
