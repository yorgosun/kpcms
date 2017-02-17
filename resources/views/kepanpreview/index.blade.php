@extends('layouts.main')

@section('css')
	<style type="text/css">
		li {line-height: 2em;}
		.indent-B {margin-left:3em;}
		.indent-C {margin-left:6em;}
		.indent-D {margin-left:9em;}
		.indent-E {margin-left:12em;}
		.indent-F {margin-left:15em;}
		.indent-G {margin-left:18em;}
		.indent-H {margin-left:21em;}
		.indent-I {margin-left:24em;}
		.indent-J {margin-left:27em;}
		.indent-K {margin-left:30em;}
		.indent-L {margin-left:33em;}
		.indent-M {margin-left:36em;}
		.indent-N {margin-left:39em;}
		.indent-O {margin-left:42em;}
		.indent-P {margin-left:45em;}
		.indent-Q {margin-left:48em;}
		.indent-R {margin-left:51em;}
		.indent-S {margin-left:54em;}
		.indent-T {margin-left:57em;}
		.indent-U {margin-left:60em;}
		.indent-V {margin-left:63em;}
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
