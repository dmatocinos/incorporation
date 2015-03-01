@foreach ($graphs_data as $caption => $path)
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<a href="#" class="thumbnail">
		<img src="{{ asset($path) }}" class="img-thumbnail"/>
	</a>
	</div>
</div>
@endforeach
