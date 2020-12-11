<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Major extends Controller
{
    // 专业管理首页
    public function index(){
        $_admin = Auth::user()->toArray();
        $data['admin'] = $_admin;
        $data['major'] = DB::table('major')->where('status',1)->orderBy('id', 'desc')->lists();
        return view('admin.Major.index',$data);
    }
    // 专业添加页面
    public function add(){
        return view('admin.Major.add');
    }
    // 专业添加保存
    public function addsave(Request $req){
        $zym = trim($req->name);
        $res = DB::table('major')->insert(
            ['zym' => $zym,'status'=>1]
        );
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'新增成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'新增失败']));
    }
    // 删除专业保存
    public function delsave(Request $req){
        $id = (int)$req->id;
        $res = DB::table('major')
            ->where('id', $id)
            ->update(['status'=>0]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'删除成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'删除失败']));
    }
    // 编辑专业页面
    public function edit(Request $req){
        $id = (int)$req->id;
        $data['major'] = DB::table('major')->where('id',$id)->item();
        return view('admin.Major.edit',$data);
    }
    // 专业编辑保存
    public function editsave(Request $req){
        $zym = trim($req->name);
        $id = trim($req->id);
        $res = DB::table('major')
            ->where('id',$id)
            ->update(['zym'=>$zym]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改失败']));
    }
    // 已删除专业页面
    public function deled(){
        $data['deled'] = DB::table('major')->where('status',0)->lists();
        return view('admin.Major.deled',$data);
    }
    //回收站编辑
    public function majorRe(Request $req){
        $type = (int)$req->type;
        $id = (int)$req->id;
        if($type===1){
            // 永久删除
            $res = DB::table('major')
            ->where('id',$id)
            ->delete();
        }else{
            // 还原
            $res = DB::table('major')
            ->where('id',$id)
            ->update(['status'=>1]);
        }
        if($res){
            exit(json_encode(['code'=>1,'type'=>$type,'msg'=>'操作成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'操作失败']));
    }
}
