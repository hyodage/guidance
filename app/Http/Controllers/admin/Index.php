<?
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//登录
Class Index extends Controller
{
    //登录首页
    public function Index(){
        $_admin = Auth::user()->toArray();
        $data['admin'] = $_admin;
        $data['msg'] = DB::table('teacher')->where('id',$_admin['tid'])->item();
        return view('admin.Index.index',$data);
    }
}
