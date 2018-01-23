<?php
/**
 *  阿姨
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table="employee";


    //通过ID获取信息
    public static function getEmployeeByID($id){

        $job_list=DB::table("employee_job")->where(['emp_id'=>$id])->get();
        $job=array();
        foreach ($job_list as $_job){
            $type=$_job->type;
            $job[$type][]=$_job;
        }
        $server_list=DB::table("server_person")->where(['person_id'=>$id,'person_type'=>1])->get();

        $info=static::where(['id'=>$id])->first();
        $info["job"]=$job;
        $info["server"]=$server_list;
        return $info;
    }


    /**
     *  获取列表信息
     *  $where['name' => ['LIKE' => '%XXX%']]  模糊搜索
     */
    public static function getListByWhere($where,$order_by='id',$order_type='desc',$page=1,$page_size=10){

        return static::where($where)
                ->orderBy($order_by,$order_type)
                ->offset($page-1)->limit($page_size)
                ->get();
    }

    //首页明星阿姨
    public static function getStarListByWhere(){
        $page_size=9;
        $where["is_star"]=1;
        return  static::where($where)
                ->orderBy(\DB::raw('RAND()'))
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

    //添加工作/培新 记录
    public static function add_job_data($data){
        return DB::table('employee_job')->insertGetId($data);
    }
    //修改
    public static function update_job_data($data,$id){
        return DB::table('employee_job')->where("id",$id)
            ->update($data);
    }

    //添加照片
    public static function add_image_data($data){
        return DB::table('images')->insertGetId($data);
    }
    //修改
    public static function update_image_data($data,$id){
        return DB::table('images')->where("id",$id)
            ->update($data);
    }
}