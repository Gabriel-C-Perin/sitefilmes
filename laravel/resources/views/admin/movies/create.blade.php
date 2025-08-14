@extends('admin.layout')

@section('title', 'Novo Filme')

@section('content')
<h2>Novo Filme</h2>

<form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">
	@csrf
	<label>Título
		<input type="text" name="name" value="{{ old('name') }}">
	</label>
	@error('name')<small style="color:red">{{ $message }}</small>@enderror

	<label>Sinopse
		<textarea name="synopsis" rows="5">{{ old('synopsis') }}</textarea>
	</label>
	@error('synopsis')<small style="color:red">{{ $message }}</small>@enderror

	<label>Ano
		<input type="number" name="year" value="{{ old('year') }}" min="1888" max="{{ date('Y') }}">
	</label>
	@error('year')<small style="color:red">{{ $message }}</small>@enderror

	<label>Categoria
		<select name="category_id">
			<option value="">Selecione</option>
			@foreach($categories as $id => $name)
				<option value="{{ $id }}" @selected(old('category_id')==$id)>{{ $name }}</option>
			@endforeach
		</select>
	</label>
	@error('category_id')<small style="color:red">{{ $message }}</small>@enderror

	<label>Capa
		<input type="file" name="cover_image" accept="image/*">
	</label>
	@error('cover_image')<small style="color:red">{{ $message }}</small>@enderror

	<label>Link do Trailer (YouTube)
		<input type="url" name="trailer_url" value="{{ old('trailer_url') }}">
	</label>
	@error('trailer_url')<small style="color:red">{{ $message }}</small>@enderror

	<button type="submit">Salvar</button>
	<a role="button" href="{{ route('admin.movies.index') }}" class="secondary">Cancelar</a>
</form>
@endsection


