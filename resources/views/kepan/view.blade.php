@extends('layouts.main')

@section('title')
查看科判条目
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<p class="text-center">经文章节: {{ $sutra->title }} {{ $sutra->hui }} {{$sutra->pin}} 科判</p>
			<p class="text-center">父级条目关系: {{ $parent_str }}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="row">
				<label class="col-md-2 text-right">级别：</label>
				<div class="col-md-10">{{$kepan->levelname}}</div>
			</div>
			<div class="row">
				<label class="col-md-2 text-right">编号：</label>
				<div class="col-md-10">{{$kepan->sequence}}</div>
			</div>
			<div class="row">
				<label class="col-md-2 text-right">标题：</label>
				<div class="col-md-10">{{$kepan->title}}</div>
			</div>
			<div class="row">
				<label class="col-md-2 text-right">卷：</label>
				<div class="col-md-10">{{$kepan->juan}}</div>
			</div>
			<div class="row">
				<label class="col-md-2 text-right">页码：</label>
				<div class="col-md-10">{{$kepan->page}}</div>
			</div>
			<div class="row">
				<label class="col-md-2 text-right">经文：</label>
				<div class="col-md-10">{{$kepan->content}}</div>
			</div>
			<hr>
			@foreach ($shu as $item)
				<div class="row">
					<label class="col-md-2 text-right">疏：</label>
					<div class="col-md-10">{{$item->shu}}</div>
				</div>
				<div class="row">
					<label class="col-md-2 text-right">钞：</label>
					<div class="col-md-10">{{$item->chao}}</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-2">
						<a href="/shuwens/{{$item->id}}/edit" class="btn btn-default btn-xs">编辑</a>
						<a href="#" class="btn btn-danger btn-xs btn-delete" id="{{$item->id}}">删除</a>
					</div>
				</div>
				<hr>
			@endforeach
			<form class="form-horizontal" action="/shuwens" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="kepanid" value="{{$kepan->id}}">
				<div class="form-group">
					<label class="col-md-2 text-right" for="shuwencontent">疏：</label>
					<div class="col-md-10">
						<textarea name="shuwencontent" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="chaowencontent">钞：</label>
					<div class="col-md-10">
						<textarea name="chaowencontent" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">添加疏文</button>
					<a href="/sutras/{{$sutra->id}}/kepans" class="btn btn-default">取消返回</a>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
	<script src="/js/jquery.min.js" charset="utf-8"></script>
	<script type="text/javascript">
		$(function(){
			$('.btn-delete').click(function(){
					var shuwenid = $(this).attr('id');
					var ret = confirm('确认删除？');
					if (ret) {
						$.post('/shuwens/'+shuwenid,
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
