@extends('layouts.main')

@section('title')
佛经清单
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-right">
			<a href="/sutras/create" class="btn btn-primary">添加</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table">
				<tr>
					<th>佛经</th>
					<th>会名</th>
					<th>品名</th>
					<th>操作</th>
				</tr>
				@foreach ($sutras as $sutra)
					<tr>
						<td>{{ $sutra->title }}</td>
						<td>{{ $sutra->hui }}</td>
						<td>{{ $sutra->pin }}</td>
						<td>
							<a href="/sutras/{{ $sutra->id }}/edit" class="btn btn-default btn-sm">编辑</a>
							<a href="/sutras/{{ $sutra->id }}/kepans" class="btn btn-default btn-sm">编辑科判</a>
							<a href="/kepan-preview/{{ $sutra->id }}" class="btn btn-default btn-sm">预览科判</a>
							<a href="/kepan-view/{{ $sutra->id }}" class="btn btn-default btn-sm">实际展示科判</a></td>
					</tr>
				@endforeach

			</table>
		</div>
	</div>
@endsection
