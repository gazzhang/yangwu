<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Models\Ad;
use App\Http\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\http\Models;

class UserController  extends Controller
{

    public function test(Request $request){
        $id=$request->input("id");
        $where=["content"=>'123456'];
        $info=Employee::getEmployeeByID($id);
        return $info;
    }

    public function idcard(Request $request){
        return 1;
        //$file = $request->file('file');
        //var_dump($file);
    }

   /**
     * 为指定用户显示详情
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
    	//语句传参数
    	$users = DB::select('select * from hk_admin where id = ?', [$id]);

    	//处理事务
    	DB::transaction(function () {
		    DB::table('hk_admin')->update(['password' => 1]);

		    //DB::table('hk_admin')->delete();
		});

    	//所有的数据列
		$users = DB::table('hk_admin')->get(); 

		//获取一列的值
		$users = DB::table('hk_admin')->pluck('real_name');

 
 		
		$users = DB::table('hk_admin')
                    ->whereIn('id', [1, 2, 3])
                    ->get();

        $users = DB::table('hk_admin')
                ->whereColumn([
                    ['real_name', '=', 'last_name'],
                    ['create_time', '>', 'created_at']
                ])->get();

         //添加返回ID
         $id = DB::table('users')->insertGetId(
		    ['email' => 'john@example.com', 'real_name' => "zg"]
		);

    	return $users;
        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    public function store(Request $request)
    {
    	$method=$request->method();

    	$bool=$request->input('name', 'Sally');//当请求的输入数据不存在于此请求时，返回该默认值：

    	if ($request->has('name')) {    //确定是否有输入值
		    return "true";		
		}


		//文件
		$file = $request->file('photo');
		$path = $request->photo->path(); 
		$extension = $request->photo->extension();

    	return $bool;

		 
       
        //
    }
}
