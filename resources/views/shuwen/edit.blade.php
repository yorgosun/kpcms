@extends('layouts.main')

@section('title')
编辑疏文
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<p class="text-center">经文章节: {{ $sutra->title }} {{ $sutra->hui }} {{$sutra->pin}} 科判</p>
			<p class="text-center">条目关系: {{ $parent_str }} {{$kepan->levelname}}{{$kepan->sequence}} {{$kepan->title}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form class="form-horizontal" action="/shuwens/{{ $shuwen->id }}" method="post">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<input type="hidden" name="swid" value="{{ $shuwen->id }}">
				<div class="form-group">
					<label class="col-md-2 text-right" for="shuwencontent">疏文：</label>
					<div class="col-md-10">
						<textarea name="shuwencontent" class="form-control" rows="3">{{$shuwen->shu}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="chaowencontent">钞文：</label>
					<div class="col-md-10">
						<textarea name="chaowencontent" class="form-control" rows="3">{{$shuwen->chao}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="sequence">排序：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="sequence" id="sequence" value="{{$shuwen->sequence}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="kepan_id">所属科判ID：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="kepan_id" id="kepan_id" value="{{$shuwen->kepan_id}}">
					</div>
				</div>
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">保存</button>
					<a href="/kepans/{{$shuwen->kepan_id}}" class="btn btn-default">取消返回</a>
				</div>
			</form>
		</div>
	</div>
@endsection
