<?php
/**
 *  服务类型
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class ServerType extends Model
{
    protected $table="server_type";

    //列表
    public static function getListByWhere($where,$page_size=4){
        if(emptyArray($where))$where=["industry"=>"家政行业"];
        $where["status"]=1;
        return static::where($where)
                ->orderBy('orderby')
                ->limit($page_size)
                ->get();
    }
}