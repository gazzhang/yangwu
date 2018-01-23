<?php
/**
 *  广告
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table="ad";


    //广告列表
    public static function getListByWhere($where,$page_size=4){
        if(emptyArray($where))$where=["status"=>1];
        return static::where($where)
                ->orderBy("created_at","desc")
                ->limit($page_size)
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