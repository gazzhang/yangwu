<?php
/**
 *  公司
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table="company";

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


    /**
     *  公司列表
     *  $where['company_type'] : 1：培训公司  2：合作公司
     *  $where['company_name' => ['LIKE' => '%XXX%']]  模糊搜索公司名
     *
     */
    public static function getListByWhere($where,$page=1,$page_size=10){
        $where=["status"=>1];
        return static::where($where)
                ->orderBy("created_at","desc")
                ->offset($page-1)->limit($page_size)
                ->get();
    }
}