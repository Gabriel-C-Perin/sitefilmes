@extends('admin.layout')

@section('title', 'Editar Filme')

@section('content')
<h2>Editar Filme</h2>

<form method="POST" action="{{ route('admin.movies.update', $movie) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<label>Título
		<input type="text" name="name" value="{{ old('name', $movie->name) }}">
	</label>
	@error('name')<small style="color:red">{{ $message }}</small>@enderror

	<label>Sinopse
		<textarea name="synopsis" rows="5">{{ old('synopsis', $movie->synopsis) }}</textarea>
	</label>
	@error('synopsis')<small style="color:red">{{ $message }}</small>@enderror

	<label>Ano
		<input type="number" name="year" value="{{ old('year', $movie->year) }}" min="1888" max="{{ date('Y') }}">
	</label>
	@error('year')<small style="color:red">{{ $message }}</small>@enderror

	<label>Categoria
		<select name="category_id">
			@foreach($categories as $id => $name)
				<option value="{{ $id }}" @selected(old('category_id', $movie->category_id)==$id)>{{ $name }}</option>
			@endforeach
		</select>
	</label>
	@error('category_id')<small style="color:red">{{ $message }}</small>@enderror

	@if($movie->cover_image_path)
		<p>Atual: <img src="{{ asset('storage/' . $movie->cover_image_path) }}" style="height:80px"></p>
	@endif
	<label>Capa
		<input type="file" name="cover_image" accept="image/*">
	</label>
	@error('cover_image')<small style="color:red">{{ $message }}</small>@enderror

	<label>Link do Trailer (YouTube)
		<input type="url" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}">
	</label>
	@error('trailer_url')<small style="color:red">{{ $message }}</small>@enderror

	<button type="submit">Atualizar</button>
	<a role="button" href="{{ route('admin.movies.index') }}" class="secondary">Cancelar</a>
</form>
@endsection


