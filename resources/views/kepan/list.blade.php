@extends('layouts.main')

@section('title')
{{ $sutra->title }} {{ $sutra->hui }} 科判
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-right">
			<a href="/sutras/{{ $sutra->id }}/kepans/0/create" class="btn btn-primary">添加</a>
			<a href="/kepan-preview/{{ $sutra->id }}" class="btn btn-default">预览科判</a>
			<a href="/sutras" class="btn btn-default">返回列表</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table">
				<tr>
					<th>上级</th>
					<th>级别编号</th>
					<th>标题</th>
					<th style="width: 40%;">经文</th>
					<th>操作</th>
				</tr>
				@foreach ($kepan as $item)
					<tr>
						<td>@if($item->parent_id > 0)
                            @if(isset($item->parent))
							    {{$item->parent->levelname}}{{$item->parent->sequence}} {{$item->parent->title}}
                            @else
                                <p style="color:red;">父级节点异常</p>
                            @endif
						@else
							顶级
						@endif
						</td>
						<td>{{$item->levelname}}{{$item->sequence}}</td>
						<td><a href="/kepans/{{$item->id}}">{{$item->title}}</a></td>
						<td>{{$item->content}}</td>
						<td><a href="/kepans/{{$item->id}}/edit" class="btn btn-default btn-sm">编辑</a>
							<a href="/sutras/{{ $sutra->id }}/kepans/{{$item->id}}/create" class="btn btn-primary btn-sm">添加子节点</a>
							<a href="#" class="btn btn-danger btn-sm btn-delete" id="{{$item->id}}">删除</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			{{$kepan->links()}}
		</div>
	</div>
@endsection

@section('js')
	<script src="/js/jquery.min.js" charset="utf-8"></script>
	<script type="text/javascript">
		$(function(){
			$('.btn-delete').click(function(){
					var kepanid = $(this).attr('id');
					var ret = confirm('确认删除？');
					if (ret) {
						$.post('/kepans/'+kepanid,
							{_token: '{{csrf_token()}}', _method:'DELETE'},
							function(ret){
								location.reload();
							});
					}

					return false;
			});
		});
	</script>
@endsection
