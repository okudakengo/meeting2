<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Meeting;

class MeetingsController extends Controller
{
	
	/*
	 * ミーティング 登録
	 */
	public function create()
	{
		$meeting = new Meeting();
		return view('meetings_create', ['meeting'=>$meeting]);
	}
	
	/*
	 * ミーティング 削除
	 */
	public function delete($id)
	{
		$meeting = Meeting::find($id);
		
		if (is_null($meeting)){
			\Session::flash('err_msg', 'データが見つかりません！');
		} else {
			$meeting->delete();
			\Session::flash('err_msg', '削除処理を正常に完了しました！');
		}
		return redirect(route('meetings_index'));
	}
	
	/*
	 * ミーティング 編集
	 */
	public function edit($id)
	{
		$meeting = Meeting::find($id);
		
		return view('meetings_create', ['meeting'=>$meeting]);
	}
	
    /*
     * ミーティング 一覧
     */
    public function index()
    {
    	$meetings = Meeting::orderBy('created_at', 'asc')->get();
    	return view('meetings_index', ['meetings' => $meetings]);
    }
	
	/*
	 * ミーティング 登録 - 保存
	 *
	 * @return view
	 */
	public function store(Request $request)
	{
		
		if ($request->meeting_is_delete){//削除
			$meeting = Meeting::find($request->id);
			$meeting->delete();//論理削除
		} else {//登録・編集
			//バリデーション
			$validator = Validator::make($request->all(), [
	            'meeting_date'=>'required|max:10', 
	            'meeting_name'=>'required|max:64', 
	            'meeting_company_name'=>'max:64', 
	            'meeting_company_url'=>'max:128', 
	            'meeting_app_name'=>'max:64', 
	            'meeting_description'=>'required', 
	            'meeting_referral'=>'max:64', 
	            'meeting_address'=>'max:64'
	    	]);
			
			//バリデーション：エラー
			if ($validator->fails()) {
				return redirect('/meetings/')
				->withInput()
				->withErrors($validator);
			}
			
			//登録処理
			if (isset($request->id)){//編集
				$meetings = Meeting::find($request->id);
			} else {//登録
				$meetings = new Meeting();
			}
			$meetings->meeting_date = $request->meeting_date;
			$meetings->meeting_name = $request->meeting_name;
			$meetings->meeting_company_name = $request->meeting_company_name ?? '';
			$meetings->meeting_company_url = $request->meeting_company_url ?? '';
			$meetings->meeting_app_name = $request->meeting_app_name ?? '';
			$meetings->meeting_priority = $request->meeting_priority;
			$meetings->meeting_description = $request->meeting_description;
			$meetings->meeting_referral = $request->meeting_referral ?? '';
			$meetings->meeting_address = $request->meeting_address ?? '';
			
			$meetings->save();
		}
		return redirect('/meetings/');
	}
}
