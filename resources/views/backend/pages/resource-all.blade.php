@extends('backend.layout')
@section('page_title')
    <h1>现货资源</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 form-group">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" class="select-all">
                    </th>
                    <th>用户</th>
                    <th>分类</th>
                    <th>名称</th>
                    <th>含量</th>
                    <th>所在地</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>上/下架</th>
                    <th>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                审核状态
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">不限</a></li>
                                <li><a href="#">已通过审核</a></li>
                                <li><a href="#">未通过审核</a></li>
                            </ul>
                        </div>
                    </th>
                    <th>更新时间</th>
                    <th>过期时间</th>
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
                            <th class="td-post-title">{{$resource->User->phone}}</th>
                            <td>{{ $resource->Category->name }}</td>
                            <td>{{ $resource->resource_name }}</td>
                            <td>{{ $resource->content }}</td>
                            <td>{{ $resource->City->Name }}</td>
                            <td>{{ $resource->price }}</td>
                            <td>{{ $resource->quantity }}</td>

                                @if($resource->status === 1)
                                    <td class="is-visible">上架</td>
                                @else
                                    <td class="is-hidden">下架</td>
                            @endif
                            <td>{!! $resource->valid > 0 ? '已通过审核':'<span class="text-danger">未审核</span>' !!}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>{{ $resource->expire }}</td>
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