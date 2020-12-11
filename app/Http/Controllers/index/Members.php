<?php
namespace App\Http\Controllers\index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class Members extends Controller
{
    // 登录页
    public function login(){
        return view('index.Student.login');
    }
    // 登录校验
    public function dologin(Request $req){
        $username = trim($req->username);
        $password = trim($req->password);
        $res = Auth::guard('member')->attempt(['username' =>$username, 'password' => $password,'status'=>1]);
        if(!$res){
            exit(json_encode(array('code'=>0,'msg'=>'学号或密码错误')));
        }
        echo json_encode(array('code'=>1,'msg'=>'登录成功'));
    }
    // 修改密码页
    public function editpwd(){
        return view('index.Student.editpwd');
    }
    // 保存修改密码
    public function editpwdsave(Request $req){
        $id = Auth::guard('member')->id();
        $password = trim($req->pwd);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $res = DB::table('student')
            ->where('id', $id)
            ->update(['password'=>$password]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改失败']));
    }
    // 修改信息页面
    public function editmsg(){
        $member = Auth::guard('member')->user();    //登录的用户的信xi
        $data['index_msg'] = isset($member)?$member->toArray():false;
        return view('index.Student.editmsg',$data);
    }
    // 保存修改信息
    public function editmsgsave(Request $req){
        $wchat = trim($req->wchat);
        $explain = trim($req->explain);
        $email = trim($req->email);
        $id = Auth::guard('member')->id();
        $res = DB::table('student')
            ->where('id', $id)
            ->update(['wchat'=>$wchat,'explain'=>$explain,'email'=>$email]);
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改失败']));
    }
    // 退出登录
    public function logout(){
        Auth::guard('member')->logout();  //退出登录
        echo json_encode(array('code'=>1,'msg'=>'退出成功'));
    }

}