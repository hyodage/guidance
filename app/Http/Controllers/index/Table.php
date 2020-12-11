<?php
namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Table extends Controller
{
    public function index(){
        $major = DB::table('major')->where('status',1)->cates('id');
        $teacher = DB::table('teacher')->where('status',1)->lists();
        foreach($teacher as $key => $value){
            $teacher[$key]['c_zy'] = $this->getmajor($teacher[$key]['c_zy'],$major);
        }
        $data['teacher'] = $teacher;
		return view('index.Table.tongji',$data);
    }
    public function getmajor($str,$list){
        $rights = json_decode($str,true);
        $result = [];
        foreach($rights as $key => $value){
            $result[$key] = $list[$value]['zym'];
        }
        return $result;
    }
    public function review(){
        $t_review = DB::table('t_review')->lists();
        $teacher = DB::table('teacher')->cates('id'); 
        $success = DB::table('success')->cates('tid'); 
        $student = DB::table('student')->cates('id');
        foreach($t_review as $key=>$value){
            $t_review[$key]['tid'] = $teacher[$value['tid']]['name'];
            $t_review[$key]['total'] = $teacher[$value['tid']]['num'];
            if(isset($success[$value['tid']])){
                // 如果老师有选择任何一个学生
                $ch = json_decode($success[$value['tid']]['student'],true);
                $t_review[$key]['has'] = count($ch);//当前老师已选择的人数
                foreach($ch as $k=>$v){
                    $t_review[$key]['success'][$k] = $student[$v]['name'];
                }
            }else{
                $t_review[$key]['has']=0;
                $t_review[$key]['success']=[];
            }
            $t_review[$key]['review'] = json_decode($t_review[$key]['review'],true);
            foreach($t_review[$key]['review'] as $k=>$v){
                $t_review[$key]['review'][$k] = $student[$v]['name'];
            }
        }
        $data['list'] = $t_review;
        return view('index.Table.review',$data);
    }
    public function success(){
        $success = DB::table('success')->lists();
        $teacher = DB::table('teacher')->cates('id');
        $student = DB::table('student')->cates('id');
        foreach($success as $key=>$value){
            $success[$key]['tid'] = $teacher[$value['tid']]['name'];
            $success[$key]['student'] = json_decode($success[$key]['student'],true);
            foreach($success[$key]['student'] as $k=>$v){
                $success[$key]['student'][$k] = $student[$v]['name'];
            }
        }
        $data['list'] = $success;
        return view('index.Table.success',$data);
    }
}
