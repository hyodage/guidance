<?php
namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class Index extends Controller
{
    public function index(){
        $data['index_msg'] = $this->getstudent();
		return view('index.Index.index',$data);
    }
    public function tips(){
        return view('index.Index.tips');
    }
    public function chteacher(){
        $data = $this->getstudent();
        $zy = (int)$data['zy'];
        $id = (int)$data['id'];
        $zdls = DB::table('s_review')->where('sid',$id)->item();
        $data['tid'] = $zdls['tid']?$zdls['tid']:false;
        $teacher = DB::table('teacher')->where('status',1)->lists();
        // 获取所有老师信息，将不包含该学生该该专业的老师剔除
        foreach($teacher as $key => $value){
            $teacher[$key]['c_zy'] =json_decode($teacher[$key]['c_zy'],true);
            if(!in_array($zy,$teacher[$key]['c_zy'])){
                unset($teacher[$key]);
            }
        }
        $data['teacher'] = array_values($teacher);
        return view('index.Index.cteacher',$data);
    }
    public function chteachersave(Request $req){
        $sid = (int)Auth::guard('member')->id();//学生148
        $tid = (int)$req->teacher;//老师4
        $s_result = DB::table('s_review')->where('sid',$sid)->item();
        $t_result = DB::table('t_review')->where('tid',$tid)->item();
        $success = DB::table('success')->cates('tid');
        $teacher = DB::table('teacher')->cates('id');
        // 重复提交
        if($s_result && $s_result['tid'] == $tid){
            exit(json_encode(['code'=>0,'msg'=>'无须重复提交']));
        }
        // 已匹配拒绝学生自主修改
        if($s_result && isset($success[$s_result['tid']])){
            $sure = json_decode($success[$s_result['tid']]['student'],true);
            if(in_array($sid,$sure)){
                exit(json_encode(['code'=>0,'msg'=>'已与'.$teacher[$s_result['tid']].'老师匹配成功']));
            }
        }
        // 更新新选择的老师
        if($t_result){
            // 更新到新老师
            $newr = json_decode($t_result['review'],true);
            array_push($newr,$sid);
            // echo json_encode($newr);
            DB::table('t_review')->where('tid',$tid)->update(['review'=>json_encode($newr)]);
        }else{
            // 插入到新老师
            $review = '['.$sid.']';
            DB::table('t_review')->insert(['tid'=>$tid,'review'=>$review]);
        }
        // 删除旧老师的的数据(如果存在)
        $oldteacher = DB::table('t_review')->where('tid',$s_result['tid'])->item();
        if($oldteacher){
            $old = json_decode($oldteacher['review'],true);
            if($old){
                foreach($old as $key=>$value){
                    if($value == $sid){
                        unset($old[$key]);
                        break;
                    }
                }
                $old = array_values($old);
                DB::table('t_review')->where('tid',$s_result['tid'])->update(['review'=>json_encode($old)]);
            }
        }
        // 更新自己
        if($s_result){
            $res = DB::table('s_review')->where('sid',$sid)->update(['tid'=>$tid]);
        }else{
            $res = DB::table('s_review')->insert(['sid'=>$sid,'tid'=>$tid]);
        }
        if($res){
            exit(json_encode(['code'=>1,'msg'=>'修改成功']));
        }else{
            exit(json_encode(['code'=>0,'msg'=>'修改失败']));
        }
    }
    public function getstudent(){
        $member = Auth::guard('member')->user();    //登录的用户的信xi
        $data = isset($member)?$member->toArray():false;
        return $data;
    }
}