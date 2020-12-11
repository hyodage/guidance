<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder as QueryBuilder;   //必须引用的
class DbServiceProvider extends ServiceProvider
{
    //在这个方法中写扩展的方法
    public function boot()
    {
        //扩展一条记录方法
        QueryBuilder::macro('item',function(){
            $res = $this->first();
            return $res?(array)$res:false;
        });
        //扩展列表方法
        QueryBuilder::macro('lists',function(){
            $res = $this->get()->all();
            //调用本类中的get和all方法，在DB::table查询时可以使用->lists()代替那两个;
            $lists = [];
            foreach ($res as $item){
                $lists[] = (array)$item;
            }
            return $lists;
            //结果是一个数组，每个元素又是类
        });
        //扩展自定义索引方法
        QueryBuilder::macro('cates',function($index){
            //构造一个新数组，满足：新数组下标是原数据中的某个栏位的值，传入栏位的名称，就会返回那个栏位的值为键的数组
            $res = $this->lists();
            $result = [];
            foreach ($res as $key => $value){
                $result[$value[$index]] = $value;
            }
            return $result;
        });
    }
}