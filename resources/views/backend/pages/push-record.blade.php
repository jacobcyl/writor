@extends('backend.layout')
@section('page_title')
<h1>推送记录</h1>
@endsection
@section('content')
	<div class="row">
	    <table class="table table-striped">
            <thead>
	            <tr>
	                <th>
	                    <input type="checkbox" class="select-all">
	                </th>
	                <th>操作员</th>
	                <th>通知标题</th>
	                <th>推送时间</th>
	                <th>目标用户</th>
	                <th>状态</th>
	                <th>操作</th>
	            </tr>
	        </thead>
	        <tbody>
        	@if(!count($pushs))
                <tr>
                    <td colspan="6">目前没有推送记录</td>
                </tr>
            @else
	            @foreach($pushs as $push)
	            	<tr>
	            		<td><input type="checkbox" value="{{$push->id}}"></td>
	            		<td>{{ $push->user_id }}</td>
	            		<td>{{ $push->title }}</td>
	            		<td>{{ $push->created_at }}</td>
	            		<td>{{ $push->target }}</td>
	            		<td>{{ $push->status }}</td>
	            	</tr>

	            @endforeach
            @endif
	        </tbody>
        </table>
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
<script src="{{ asset('/backend/js/editor.js') }}"></script>
<script src="{{ asset('/backend/js/post.js') }}"></script> 
@endsection