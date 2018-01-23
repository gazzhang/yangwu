<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SmsController extends Controller
{
    //获取验证码
    public function get_sms(Request $request){
        $phone=$request->input("phone");
        $code=$request->input("code");

        $new_time=time();
        $sms = DB::table('sms')
                ->where('phone', '=', $phone)
                ->orderBy('id', 'desc')
                ->first();
        $deadline=$sms->deadline;
        $sms_code=$sms->content;

        $res["status"]=0;
        if($sms_code!=$code){
            $res["status"]=-1;
            $res["error"]="验证错误";
            return   response()->json($res);
        }
        if($deadline<$new_time){
            $res["status"]=-1;
            $res["error"]="验证已经过期";
            return   response()->json($res);
        }

        return response()->json($res);
    }
    //发送验证码
    public function post_sms(Request $request){
        $phone=$request->input("phone");

        $len=env('SMS_COMTENT_CODE_LEN');

        $sms = DB::table('sms')
            ->where('phone', '=', $phone)
            ->orderBy('id', 'desc')
            ->first();
        $deadline=$sms->deadline;
        $expire_time=env('SMS_EXPIRE_TIME');
        $new_time=time();
        if($deadline>=$new_time){
            $res["status"]=-1;
            $res["error"]="验证在".($expire_time/60)."分钟内可以使用！";
            return  response()->json($res);
        }

        $code=substr(str_shuffle('1234567890'), 0, $len);
        $sms_id=$this->send_sms($phone,$code);

        $res["status"]=0;
        $res["sms_id"]=$sms_id;
        return $res;
    }

    //发送短息
    public function send_sms($phone,$code,$type=1){
        $new_time=time();
        $deadline=$new_time+env('SMS_EXPIRE_TIME');
        $id = DB::table('sms')->insertGetId(
            ['phone' => $phone, 'content' => $code,"type"=>$type,"created_at"=>$new_time,"deadline"=>$deadline]
        );
        $content = '【央务云】验证码：%s，请尽快完成验证。如非本人操作，请忽略。';
        $content = sprintf($content, $code);     //短信内容
        return $id;
    }
}