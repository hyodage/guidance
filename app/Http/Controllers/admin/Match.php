<?
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
Class Match extends Controller
{
    public function Index(){
        $_admin = Auth::user()->toArray();
        $data['admin'] = $_admin;
        $data['match'] = [];
        $match = DB::table('t_review')->where('tid',$_admin['tid'])->item();
        $student = DB::table('student')->cates('id');
        $success = DB::table('success')->where('tid',$_admin['tid'])->item();
        $teacher = DB::table('teacher')->where('id',$_admin['tid'])->item();
        $major = DB::table('major')->cates('id');
        $data['total'] = $teacher['num'];
        $data['has']=0;
        $review = json_decode($match['review'],true);
        if(isset($review)){
            foreach($review as $k=>$v){
                $data['match'][$student[$v]['id']] = $student[$v];
            }
        }
        if($success){
            $ch = json_decode($success['student'],true);
            $data['has'] = count($ch);
            foreach($ch as $k=>$v){
                $data['match'][$student[$v]['id']] = $student[$v];
                $data['match'][$v]['status']=100;
            }
        }
        if($data['match']){
            foreach($data['match'] as $k=>$v){
                $data['match'][$k]['zy'] = $major[$v['zy']]['zym'];
                
            }
        }
        return view('admin.match.index',$data);
    }
    // 通过
    public function pass(Request $req){
        $sid = (int)$req->id;
        $_admin = Auth::user()->toArray();
        $tid = (int)$_admin['id'];
        $review = DB::table('t_review')->where('tid',$tid)->item();
        $old = json_decode($review['review'],true);
        if(!in_array($sid,$old)){
            exit(json_encode(['code'=>0,'msg'=>'该学生已取消']));
        }
        $success = DB::table('success')->where('tid',$tid)->item();
        if($success){
            $new = str_replace(']',','.$sid."]",$success['student']);
            DB::table('success')->where('tid',$tid)->update(['student'=>$new]);
        }else{
            $review = '['.$sid.']';
            DB::table('success')->insert(['tid'=>$tid,'student'=>$review]);
        }
        // 删除老师预选表中学生的信息
        foreach($old as $key=>$value){
            if($value == $sid){
                unset($old[$key]);
                break;
            }
        }
        $old = array_values($old);
        $res = DB::table('t_review')->where('tid',$tid)->update(['review'=>json_encode($old)]);

        // 查找该学生信息
        $s = DB::table('student')->where('id',$sid)->item();
        if($s['email']){
            $this->email('所选老师成功通过','毕业论文指导老师匹配系统',$s['email']);
        }
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'通过成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'通过失败']));
    }
    // 取消通过
    public function cancelpass(Request $req){
        $sid = (int)$req->id;
        $_admin = Auth::user()->toArray();
        $tid = (int)$_admin['id'];
        DB::table('s_review')->where('sid',$sid)->delete();
        $success = DB::table('success')->where('tid',$tid)->item();
        $student = json_decode($success['student'],true);
        // 删除老师成功表中学生的信息
        foreach($student as $key=>$value){
            if($value == $sid){
                unset($student[$key]);
                break;
            }
        }
        $student = array_values($student);
        if(count($student)>0){
            $res = DB::table('success')->where('tid',$tid)->update(['student'=>json_encode($student)]);
        }else{
            $res = DB::table('success')->where('tid',$tid)->delete();
        }
        // 查找该学生信息
        $s = DB::table('student')->where('id',$sid)->item();
        if($s['email']){
            $this->email('所选老师取消通过,请重新选择老师','毕业论文指导老师匹配系统',$s['email']);
        }
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'取消成功']));
        }
        exit(json_encode(['code'=>0,'msg'=>'取消失败']));
    }
    // 发送邮件
    public function email($text,$title,$to){
        // Mail::send()的返回值为空，所以可以其他方法进行判断 
        Mail::send('admin.email.index',['text'=>$text],function($message) use ($title,$to){ 
            $message ->to($to)->subject($title);
        }); // 返回的一个错误数组，利用此可以判断是否发送成功 
        $res = Mail::failures();
        return $res;
    }
}