<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    // ユーザー 一覧
    public function index()
    {
    	//return view('users_index');
    	//$users = User::all();
    	//return view('users_index', ['users' => $users]);
    	
    	$users = User::orderBy('created_at', 'asc')->get();
    	return view('users_index', ['users' => $users]);
    }
	
	// ユーザー 登録
	public function create()
	{
		$user = new User();
		return view('users_create', ['user'=>$user]);
	}

	// ユーザー 編集
	public function edit($id)
	{
		$user = User::find($id);
		
		return view('users_create', ['user'=>$user]);
	}

	
	// ユーザー 登録 - 保存
	public function store(Request $request)
	{

		//デバック用
		//dd($request);

		if ($request->user_is_delete == "1"){//削除
			$user = User::find($request->id);
			$user->delete();//論理削除

		} else {//登録・編集
		
			//バリデーション
			$validator = Validator::make($request->all(), [
        		'user_name' => 'required|max:64',
        		'user_email1' => 'required|email:filter,dns',
        		'user_password' => 'required|max:64',
        		'user_security_level' => 'required',
    		]);

			//バリデーション：エラー
			if ($validator->fails()) {
				return redirect('/users/')
				->withInput()
				->withErrors($validator);
			}

			//登録処理
			if (isset($request->id)){//編集
				$users = User::find($request->id);
			} else {//登録
				$users = new User();
			}
			$users->user_name = $request->user_name;
			$users->user_email1 = $request->user_email1;
			$users->user_password = $request->user_password;
			$users->user_security_level = $request->user_security_level;

			$users->save();
		}
		return redirect('/users/');
	}

}
