@extends('admin.layout')

@section('title', 'Nova Categoria')

@section('content')
<h2>Nova Categoria</h2>

<form method="POST" action="{{ route('admin.categories.store') }}">
	@csrf
	<label>Nome
		<input type="text" name="name" value="{{ old('name') }}">
	</label>
	@error('name')<small style="color:red">{{ $message }}</small>@enderror
	<button type="submit">Salvar</button>
	<a role="button" href="{{ route('admin.categories.index') }}" class="secondary">Cancelar</a>
</form>
@endsection


