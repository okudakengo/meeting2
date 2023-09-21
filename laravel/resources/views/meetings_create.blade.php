@php
	if (is_null($meeting->id)){
		$str_submit = "新規登録";
	} else {
		$str_submit = "上書き保存";
	}
@endphp
@extends('layouts.app')
@section('title', 'ミーティング 登録')
@section('content')
<h2>ミーティング 登録</h2>
<div class='max-width-960px margin-top-30px'>
	<form method="POST" action="{{ route('meetings_store') }}" id='frmMain' name='frmMain'>
		@if (is_null($meeting->id))
		<input type='hidden' id='deleted_at' name='deleted_at' value="">
		@else
		<input type='hidden' name='id' value="{{ $meeting->id }}">
		@endif
		@csrf
		<table class='form width-100'>
			<tr>
				<th>
					<label for='meeting_date'>日 付</label>　<span class='red smaller'>*</span>
				</th>
				<td>
					<input type='date' class='width-100' id='meeting_date' name='meeting_date' maxlength='64' value="{{ old('meeting_date', $meeting->meeting_date) }}">
					@if ($errors->has('meeting_date'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_date') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_name'>氏 名</label>　<span class='red smaller'>*</span>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_name" name="meeting_name" maxlength='64' value="{{ old('meeting_name', $meeting->meeting_name) }}">
					@if ($errors->has('meeting_name'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_name') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_company_name'>会社名</label>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_company_name" name="meeting_company_name" maxlength='64' value="{{ old('meeting_company_name', $meeting->meeting_company_name) }}">
					@if ($errors->has('meeting_company_name'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_company_name') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_company_url'>会社 URL</label>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_company_url" name="meeting_company_url" maxlength='128' value="{{ old('meeting_company_url', $meeting->meeting_company_url) }}">
					@if ($errors->has('meeting_company_url'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_company_url') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_app_name'>知り合った経緯</label>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_app_name" name="meeting_app_name" maxlength='64' value="{{ old('meeting_app_name', $meeting->meeting_app_name) }}">
					@if ($errors->has('meeting_app_name'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_app_name') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_priority'>優先度</label>
				</th>
				<td>
					<select id="meeting_priority" name="meeting_priority">
						<option value='0' {{ $meeting->meeting_priority == 0 ? 'selected' : '' }}>Ａ</option>
						<option value='1' {{ $meeting->meeting_priority == 1 ? 'selected' : '' }}>Ｂ</option>
						<option value='2' {{ $meeting->meeting_priority == 2 ? 'selected' : '' }}>Ｃ</option>
					</select>
					{{-- old('meeting_priority') --}}
					@if ($errors->has('meeting_priority'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_priority') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_description'>内 容</label>　<span class='red smaller'>*</span>
				</th>
				<td>
					<textarea class="form-control" id="meeting_description" name="meeting_description" rows='8'>{{ old('meeting_description', $meeting->meeting_description) }}</textarea>
					@if ($errors->has('meeting_description'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_description') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_referral'>紹介希望</label>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_referral" name="meeting_referral" maxlength='64' value="{{ old('meeting_referral', $meeting->meeting_referral) }}">
					@if ($errors->has('meeting_referral'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_referral') }}
					</div>
					@endif
				</td>
			</tr>
			<tr>
				<th>
					<label for='meeting_address'>連絡先</label>
				</th>
				<td>
					<input type='text' class='width-100' id="meeting_address" name="meeting_address" maxlength='64' value="{{ old('meeting_address', $meeting->meeting_address) }}">
					@if ($errors->has('meeting_address'))
					<div class="text-danger margin-top-8px">
						{{ $errors->first('meeting_address') }}
					</div>
					@endif
				</td>
			</tr>
			@if (is_null($meeting->id))
			<input type='hidden' id='meeting_is_delete' name='meeting_is_delete' value="0">
			@else
			<tr>
				<th>削除</th>
				<td><input type='checkbox' id='meeting_is_delete' name='meeting_is_delete' value="1"> 削除する</td>
			</tr>
			@endif
		</table>
		<div class='margin-top-30px'>
			<button type="submit" class='btnSubmit background-blue'>
				{{ $str_submit }}
			</button>
			<a class='btnSubmit reset' href="{{ route('meetings_index') }}">
				キャンセル
			</a>
		</div>
	</form>
</div>
<script>
	$(function(){
		$('#meeting_date').select().focus();
		
		$('#frmMain').on('submit', function(){
			
			if ($('#meeting_is_delete').prop('checked')){
				return confirm("削除します。よろしいですか？");
			} else {
				//トリミング
				$('#meeting_date').val(jQuery.trim($('#meeting_date').val()));
				$('#meeting_name').val(jQuery.trim($('#meeting_name').val()));
				$('#meeting_description').val(jQuery.trim($('#meeting_description').val()));
				
				if ($('#meeting_date').val() == ""){
					alert("''日付'' が不正です！");
					$('#meeting_date').select().focus();
					return false;
				} else if ($('#meeting_name').val() == ""){
					alert("''氏名'' を入力してください！");
					$('#meeting_name').focus();
					return false;
				} else if ($('#meeting_description').val() == ""){
					alert("''内容'' を入力してください！");
					$('#meeting_description').focus();
					return false;
				} else {
					return confirm('{{ $str_submit }}します。よろしいですか？');
				}
			}
		});
	});
</script>
@endsection
