
@extends('layouts.app')
@section('title', 'ミーティング 管理')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    	
    	<!-- left menu -->
    	@include('menu')
    	
        <!--<div class="col-md-8">-->
        <div class="col-md-10">
        	
					<h2>ミーティング 管理</h2>

					<!-- バリデーションエラーの表示に使用 -->
					@include('common.errors')
					<!-- バリデーションエラーの表示に使用 -->

					<div align='right'>
						<a class='btnGrad background-blue' href='/meetings/create'>＋新規 登録</a>
					</div>
					<div class='margin-top-12px'>
						<table class="table table-striped">
						    <tr>
						        <th class='text-center'>ID</th>
						        <th class='text-center'>日付</th>
						        <th>氏名</th>
						        <th>会社名</th>
						        <th>会社 URL</th>
						        <th>知り合った経緯</th>
						        <th>重要度</th>
						        <th>ミーティング内容</th>
						        <th>紹介希望</th>
						        <th>連絡先</th>
						        <th>作成日時</th>
						        <th>更新日時</th>
						        <th>&nbsp;</th>
						    </tr>
						    @foreach($meetings as $meeting)
						    <tr>
						        <td class='text-center'>{{ $meeting->id }}</td>
						        <td class='text-center'>{{ date('Y/m/d', strtotime($meeting->meeting_date)) }}</td>
						        <td>{{ $meeting->meeting_name }}</td>
						        <td>{{ $meeting->meeting_company_name }}</td>
						        <td>{{ $meeting->meeting_company_url }}</td>
						        <td>{{ $meeting->meeting_app_name }}</td>
						        <td>{{ $meeting->getMeetingPriorityText() }}</td>
						        <td>{{ $meeting->meeting_description }}</td>
						        <td>{{ $meeting->meeting_referral }}</td>
						        <td>{{ $meeting->meeting_address }}</td>
						        <td>{{ $meeting->created_at }}</td>
						        <td>{{ $meeting->updated_at }}</td>
						        <td align='center'><a href='/meetings/edit/{{ $meeting->id }}'><nobr>編集</nobr></a></td>
						    </tr>
						    @endforeach
						</table>
					</div>
        </div>
    </div>
</div>
<script>
	$(function(){
	});
</script>
@endsection
