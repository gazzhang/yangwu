<?php
/**
 *  客户
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    protected $table="custom";


    //列表
    public static function getListByWhere($where,$page=1,$page_size=10){
        return static::where($where)
            ->orderBy("created_at","desc")
            ->offset($page-1)->limit($page_size)
            ->get();
    }



    public function freshTimestamp() {
        return time();
    }
    public function fromDateTime($value) {
        return $value;
    }

    //添加
    public static function add_data($data){
        return static::insertGetId($data);
    }
    //修改
    public static function update_data($data,$id){
        return static::where("id",$id)
            ->update($data);
    }
}