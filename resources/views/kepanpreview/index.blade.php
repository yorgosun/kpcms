@extends('layouts.main')

@section('css')
	<style type="text/css">
		li {line-height: 2em;}
		.indent-B {margin-left:5em;}
		.indent-C {margin-left:10em;}
		.indent-D {margin-left:15em;}
		.indent-E {margin-left:20em;}
		.indent-F {margin-left:25em;}
		.indent-G {margin-left:30em;}
		.indent-H {margin-left:35em;}
		.indent-I {margin-left:40em;}
		.indent-J {margin-left:45em;}
		.content {color: lightgray;}
	</style>
@endsection

@section('title')
{{ $sutra->title }} {{ $sutra->hui }} {{ $sutra->pin }} 科判预览
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<ul>
				@foreach ($kepanlist as $kepan)
					<li class="indent-{{$kepan->levelnumber}}">{{$kepan->levelname}}{{$kepan->sequence}} {{$kepan->title}} <span class="content">{{$kepan->content}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/kepans/{{$kepan->id}}/edit" class="btn btn-default btn-xs">编辑</a><a href="/sutras/{{ $sutra->id }}/kepans/{{$kepan->id}}/create" class="btn btn-default btn-xs">添加子节点</a></li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
