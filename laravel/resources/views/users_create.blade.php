@php
	if (is_null($user->id)){
		$str_submit = "新規登録";
	} else {
		$str_submit = "上書き保存";
	}
@endphp
@extends('layouts.app')
@section('title', 'ユーザー 登録')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    	
    	<!-- left menu -->
    	@include('menu')
    	
        <!--<div class="col-md-8">-->
        <div class="col-md-10">
        	
					<h2>ユーザー 登録</h2>
					<div class='max-width-960px margin-top-30px'>
						<form method="POST" action="{{ route('users_store') }}" id='frmMain' name='frmMain'>
							@if (is_null($user->id))
							<input type='hidden' id='deleted_at' name='deleted_at' value="">
							@else
							<input type='hidden' name='id' value="{{ $user->id }}">
							@endif
							@csrf
							<table class='form width-100'>
								<tr>
									<th>
										<label for='name'>ユーザー名</label>　<span class='red smaller'>*</span>
									</th>
									<td>
										<input type='text' class='width-100' id="name" name="name" maxlength='64' value="{{ old('name', $user->name) }}">
										@if ($errors->has('name'))
										<div class="text-danger margin-top-8px">
											{{ $errors->first('name') }}
										</div>
										@endif
									</td>
								</tr>
								<tr>
									<th>
										<label for='email'>メールアドレス</label>　<span class='red smaller'>*</span>
									</th>
									<td>
										<input type='text' class='width-100' id="email" name="email" maxlength='64' value="{{ old('email', $user->email) }}">
										@if ($errors->has('email'))
										<div class="text-danger margin-top-8px">
											{{ $errors->first('email') }}
										</div>
										@endif
									</td>
								</tr>
								<tr>
									<th>
										<label for='user_security_level'>権　限</label>
									</th>
									<td>
										<select id="user_security_level" name="user_security_level">
											<option value='0' {{ $user->user_security_level == 0 ? 'selected' : '' }}>開発権限</option>
											<option value='100' {{ $user->user_security_level == 100 ? 'selected' : '' }}>管理者権限</option>
											<option value='1000' {{ $user->user_security_level == 1000 ? 'selected' : '' }}>一般権限</option>
											<option value='10000' {{ $user->user_security_level == 10000 ? 'selected' : '' }}>外部権限</option>
										</select>
										{{-- old('user_security_level') --}}
										@if ($errors->has('user_security_level'))
										<div class="text-danger margin-top-8px">
											{{ $errors->first('user_security_level') }}
										</div>
										@endif
									</td>
								</tr>
								@if (is_null($user->id))
								<input type='hidden' id='user_is_delete' name='user_is_delete' value="0">
								@else
								<tr>
									<th>削除</th>
									<td><input type='checkbox' id='user_is_delete' name='user_is_delete' value="1"> 削除する</td>
								</tr>
								@endif
							</table>
							<div class='margin-top-30px'>
								<button type="submit" class='btnSubmit background-blue'>
									{{ $str_submit }}
								</button>
								<a class='btnSubmit reset' href="{{ route('users_index') }}">
									キャンセル
								</a>
							</div>
						</form>
					</div>
        </div>
    </div>
</div>
<script>
	$(function(){
		$('#name').select().focus();
		
		$('#frmMain').on('submit', function(){
			
			if ($('#user_is_delete').prop('checked')){
				return confirm("削除します。よろしいですか？");
			} else {
				//トリミング
				$('#name').val(jQuery.trim($('#name').val()));
				$('#email').val(jQuery.trim($('#email').val()));
				
				if ($('#name').val() == ""){
					alert("''ユーザー名'' を入力してください！");
					$('#name').focus();
					return false;
				} else if ($('#email').val() == ""){
					alert("''メールアドレス'' を入力してください！");
					$('#email').focus();
					return false;
				} else {
					return confirm('{{ $str_submit }}します。よろしいですか？');
				}
			}
		});
	});
</script>
@endsection
