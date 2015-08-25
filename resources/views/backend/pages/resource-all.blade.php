@extends('backend.layout')
@section('page_title')
    <h1>文章 <a href="{{url('/admin/post/new')}}" class="btn btn-info">写文章</a></h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 form-group">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" class="select-all">
                    </th>
                    <th>用户</th>
                    <th>分类</th>
                    <th>单价</th>
                    <th>数量</th>
                </tr>
                </thead>
                <tbody>
                @if(!count($resources))
                    <tr>
                        <td colspan="6">目前没有资源</td>
                    </tr>
                @else
                    @foreach($resources as $resource)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{$resource->id}}">
                            </td>
                            <td class="td-post-title">
                                {{$resource->user_id}}
                                <div class="td-tool-bar-wrapper">
                                    <div class="td-tool-bar">
                                        <div class="tips-text">
                                            <a href="{{url('/admin/post/edit', array('id' => $resource->id))}}" class="btn btn-default btn-sm btn-icon icon-left">
                                                <i class="entypo-pencil"></i>
                                                编辑
                                            </a>
                                            <a href="{{url('/admin/post/delete', array('id' => $resource->id))}}" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('确认删除吗？')">
                                                <i class="entypo-cancel"></i>
                                                删除
                                            </a>
                                        </div>
                                        <div class="tips-angle diamond"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $resource->Category->name }}
                            </td>
                            <td>{{ $resource->price }}</td>
                            <td>{{ $resource->quantity }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {!! $resources->appends(["category"=>2])->render() !!}
        </div>
    </div>
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('/backend/js/selectboxit/jquery.selectBoxIt.css') }}"  id="style-resource-3">
@endsection

@section('page_js')
    <script src="{{ asset('/backend/js/selectboxit/jquery.selectBoxIt.min.js') }}" id="script-resource-11"></script>
@endsection