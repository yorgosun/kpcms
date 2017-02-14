@extends('layouts.main')

@section('title')
录入经文章节
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form class="form-horizontal"
				@if(isset($edit) && $edit==1)
					action="/sutras/{{$sutra->id}}"
				@else
					action="/sutras"
				@endif
				method="post">
				{{ csrf_field() }}
				@if(isset($edit) && $edit==1)
					<input type="hidden" name="sutraid" value="{{$sutra->id}}">
					{{method_field('PUT')}}
				@endif

				<div class="form-group">
					<label class="col-md-2 text-right" for="title">佛经：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="title" id="title"
						@if(isset($edit) && $edit == 1)
							value="{{$sutra->title}}"
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="hui">会：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="hui" id="hui"
						@if(isset($edit) && $edit == 1)
							value="{{$sutra->hui}}"
						@endif
						>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 text-right" for="pin">品：</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="pin" id="pin"
						@if(isset($edit) && $edit == 1)
							value="{{$sutra->pin}}"
						@endif
						>
					</div>
				</div>

				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">保存</button>
				</div>

			</form>
		</div>
	</div>
@endsection
