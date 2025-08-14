@extends('admin.layout')

@section('title', 'Editar Categoria')

@section('content')
<h2>Editar Categoria</h2>

<form method="POST" action="{{ route('admin.categories.update', $category) }}">
	@csrf
	@method('PUT')
	<label>Nome
		<input type="text" name="name" value="{{ old('name', $category->name) }}">
	</label>
	@error('name')<small style="color:red">{{ $message }}</small>@enderror
	<button type="submit">Atualizar</button>
	<a role="button" href="{{ route('admin.categories.index') }}" class="secondary">Cancelar</a>
</form>
@endsection


