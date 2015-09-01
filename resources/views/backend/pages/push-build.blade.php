@extends('backend.layout')
@section('page_title')
<h1>创建推送</h1>
@endsection
@section('content')
	<div class="row">
		<form action="{{url('/admin/push/create')}}" method="post" accept-charset="utf-8" class="form-horizontal">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          	<div class="form-group">
			    <label for="push-title" class="col-sm-2 control-label">通知标题</label>
			    <div class="col-xs-8">
			      	<input type="text" class="form-control" id="push-title" name="title" placeholder="通知标题">
			    </div>
		  	</div>
		  	<div class="form-group">
			    <label for="push-content" class="col-sm-2 control-label">通知内容</label>
			    <div class="col-xs-8">
			      	<textarea class="form-control" rows="3" id="push-content" name="content" placeholder="请输入通知内容"></textarea>
			    </div>
		  	</div>
		  	<div class="form-group">
		  		<label class="col-sm-2 control-label">目标用户</label>
		  		<div class="col-xs-8">
		  			<label class="checkbox-inline">
		  				<input type="radio" name="targetUser" value="0" data-linkage="a-1">
		  				全部用户
		  			</label>
		  			<label class="checkbox-inline">
		  				<input type="radio" name="targetUser" value="0" data-linkage="a-1">
		  				标签用户
		  			</label>
		  			<label class="checkbox-inline">
		  				<input type="radio" name="targetUser" value="0" data-linkage="a-1">
		  				指定用户
		  			</label>
		  			<label class="checkbox-inline">
		  				<input type="radio" name="targetUser" value="0" data-linkage="a-1">
		  				用户分组
		  			</label>
		  		</div>
		  	</div>
		  	<div class="form-group">
			    <label for="push-extracontent" class="col-sm-2 control-label">透传消息</label>
			    <div class="col-xs-8">
			      	<textarea class="form-control" rows="3" id="push-extracontent" name="extraContent" placeholder="请输入通知内容"></textarea>
			    </div>
		  	</div>
			<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-success">发送</button>
		    	</div>
  			</div>
		</form>
	</div>
@endsection

@section('page_css')
<link rel="stylesheet" href="{{ asset('/backend/css/prettify.css') }}">
<link rel="stylesheet" href="{{ asset('/backend/css/editor.css') }}">
<link rel="stylesheet" href="{{ asset('/backend/css/markdown.css') }}">
<link rel="stylesheet" href="{{ asset('/backend/js/selectboxit/jquery.selectBoxIt.css') }}"  id="style-resource-3">
@endsection

@section('page_js')
<script src="{{ asset('/backend/js/prettify.js') }}"></script>
<script src="{{ asset('/backend/js/marked.js') }}"></script>
<script src="{{ asset('/backend/js/post.js') }}"></script> 
@endsection