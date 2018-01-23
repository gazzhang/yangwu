<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use TencentYoutuyun\Youtu;
use TencentYoutuyun\Conf;

class AiController extends Controller
{

    //身份证识别
    public function tencent_id_card(Request $request){

        $file = $request->file('file');
        $idCardSide=$request->input('type');
        require __DIR__.'/../../../../vendor/aitencent/include.php';
        //
        Conf::setAppInfo(env('AI_TENCENT_APP_ID'), env('AI_TENCENT_API_KEY'), env('AI_TENCENT_SECRET_KEY'), env('AI_TENCENT_USERID'),conf::API_YOUTU_END_POINT );
        $idCardSide = empty($idCardSide)?0:1;
        //$image = "d:/15-5.jpg";
        $idCardSide = empty($idCardSide)?0:$idCardSide;
        $result= YouTu::idcardocr($file,$idCardSide);

        $extension = $file->extension();
        $image_name=$result['id'].'.'.$extension;
        unset($result['frontimage']);
        $path = $file->storeAs('images/id_card',$image_name);
        return $result;
    }
    //身份证识别
    public function baidu_id_card(Request $request){
        $file = $request->file('file');
        $idCardSide=$request->input('type');
        require __DIR__.'/../../../../vendor/aibaidu/AipOcr.php';

        $client = new \AipOcr(env('AI_APP_ID'), env('AI_API_KEY'), env('AI_SECRET_KEY'));

        $image = file_get_contents($file);
        $idCardSide = empty($idCardSide)?"front":$idCardSide;
        // 调用身份证识别
        $result=$client->idcard($image, $idCardSide);
        return $result;
    }


    //营业执照
    public function tencent_biz_licenseocr(Request $request){

        $file = $request->file('file');
        require __DIR__.'/../../../../vendor/aitencent/include.php';
        Conf::setAppInfo(env('AI_TENCENT_APP_ID'), env('AI_TENCENT_API_KEY'), env('AI_TENCENT_SECRET_KEY'), env('AI_TENCENT_USERID'),conf::API_YOUTU_END_POINT );
        $result= YouTu::bizlicenseocr($file);

        $extension = $file->extension();
        $image_name=$result['items'][0]["itemstring"].'.'.$extension;
        $path = $file->storeAs('images/biz_licenseocr',$image_name);
        return $result;
    }


    //名片识别
    public function tencent_name_card(Request $request){

        $file = $request->file('file');
        require __DIR__.'/../../../../vendor/aitencent/include.php';
        Conf::setAppInfo(env('AI_TENCENT_APP_ID'), env('AI_TENCENT_API_KEY'), env('AI_TENCENT_SECRET_KEY'), env('AI_TENCENT_USERID'),conf::API_YOUTU_END_POINT );
        $result= YouTu::bcocr($file);

        //$extension = $file->extension();
        //$image_name=$result['items'][0]["itemstring"].'.'.$extension;
        //$path = $file->storeAs('images/name_card',$image_name);
        return $result;
    }


    //银行卡识别
    public function tencent_credit_card(Request $request){

        $file = $request->file('file');
        require __DIR__.'/../../../../vendor/aitencent/include.php';
        Conf::setAppInfo(env('AI_TENCENT_APP_ID'), env('AI_TENCENT_API_KEY'), env('AI_TENCENT_SECRET_KEY'), env('AI_TENCENT_USERID'),conf::API_YOUTU_END_POINT );
        $result= YouTu::creditcardocr($file);

        $extension = $file->extension();
        $image_name=$result['items'][0]["itemstring"].'.'.$extension;
        $path = $file->storeAs('images/credit_card',$image_name);
        return $result;
    }
}
