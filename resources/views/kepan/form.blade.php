@extends('layouts.main')

@section('title')
添加科判条目
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
			<form class="form-horizontal"
				@if(isset($edit) && $edit == 1)
					action="/kepans/{{$kepan->id}}"
				@else
					action="/kepans"
				@endif
				 method="post">
				{{ csrf_field() }}
				<input type="hidden" name="sutraid" value="{{$sutra->id}}">
				<input type="hidden" name="parentid" value="{{$parent_id}}">
				@if(isset($edit) && $edit == 1)
					<input type="hidden" name="kepanid" value="{{$kepan->id}}">
					{{ method_field('PUT') }}
				@endif
				<div class="form-group">
					<label class="col-md-2 text-right" for="levelname">* 级别：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="levelname" id="levelname"
						@if(isset($edit) && $edit == 1)
							value="{{$kepan->levelname}}"
						@else
							value="{{$next_levelname}}"
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="sequence">* 编号：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="sequence" id="sequence"
						@if(isset($edit) && $edit == 1)
							value="{{$kepan->sequence}}"
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="title">* 标题：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="title" id="title"
						@if(isset($edit) && $edit == 1)
							value="{{$kepan->title}}"
						@endif
						>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 text-right" for="juan">卷：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="juan" id="juan"
						@if(isset($edit) && $edit == 1)
							value="{{$kepan->juan}}"
						@else
							@if($parent_id>0) value="{{$parent->juan}}" @endif
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="page">页码：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="page" id="page"
						@if(isset($edit) && $edit == 1)
							value="{{$kepan->page}}"
						@else
							value="0"
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="content">经文：</label>
					<div class="col-md-10">
						<textarea name="content" class="form-control" rows="3">@if(isset($edit) && $edit == 1)
{{$kepan->content}}@endif</textarea>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">保存</button>
					<a href="/sutras/{{$sutra->id}}/kepans" class="btn btn-default">取消返回</a>
				</div>

			</form>
		</div>
	</div>
@endsection
