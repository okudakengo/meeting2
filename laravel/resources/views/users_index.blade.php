
@extends('layouts.app')
@section('title', 'ユーザー 管理')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    	
    	<!-- left menu -->
    	@include('menu')
    	
        <!--<div class="col-md-8">-->
        <div class="col-md-10">
				
					<h2>ユーザー 管理</h2>

					<!-- バリデーションエラーの表示に使用 -->
					@include('common.errors')
					<!-- バリデーションエラーの表示に使用 -->

					<div align='right'>
						<a class='btnGrad background-blue' href='/users/create'>＋新規 登録</a>
					</div>
					<div class='margin-top-12px'>
						<table class="table table-striped">
						    <tr>
						        <th class='text-center'>ID</th>
						        <th>ユーザー名</th>
						        <th>メールアドレス</th>
						        <th>権限</th>
						        <th>作成日時</th>
						        <th>更新日時</th>
						        <th>&nbsp;</th>
						    </tr>
						    @foreach($users as $user)
						    <tr>
						        <td align='center'>{{ $user->id }}</td>
						        <td>{{ $user->name }}</td>
						        <td>{{ $user->email }}</td>
						        <td>{{ $user->getUserSecurityLevelText() }}</td>
						        <td>{{ $user->created_at }}</td>
						        <td>{{ $user->updated_at }}</td>
						        <td align='center'><a href='/users/edit/{{ $user->id }}'>編集</a></td>
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
