<?
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//登录
Class Account extends Controller
{
    //登录首页
    public function login(){
        return view('admin.Account.login');
    }
    public function dologin(Request $req){
        $username =trim($req->username);
        $password = trim($req->password);
        // 返回bool,如果验证通过会自动存储到session
        $res = Auth::attempt(['username' =>$username, 'password' => $password,'status'=>1]);
        if(!$res){
            exit(json_encode(array('code'=>0,'msg'=>'账号或密码错误')));
        }
        echo json_encode(array('code'=>1,'msg'=>'登录成功'));
    }
    public function logout(){
        if(Auth::check()){
            Auth::logout();  //退出登录
        }
        echo json_encode(['code'=>1,'msg'=>'退出成功']);
    }
}
