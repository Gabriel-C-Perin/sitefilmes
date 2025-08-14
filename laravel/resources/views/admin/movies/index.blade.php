@extends('admin.layout')

@section('title', 'Filmes')

@section('content')
<h2>Filmes</h2>
<a role="button" href="{{ route('admin.movies.create') }}">Novo Filme</a>

<table>
	<thead>
		<tr>
			<th>Capa</th>
			<th>Título</th>
			<th>Categoria</th>
			<th>Ano</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
	@foreach($movies as $movie)
		<tr>
			<td>
				@if($movie->cover_image_path)
					<img src="{{ asset('storage/' . $movie->cover_image_path) }}" alt="capa" style="height:60px">
				@else - @endif
			</td>
			<td>{{ $movie->name }}</td>
			<td>{{ $movie->category?->name }}</td>
			<td>{{ $movie->year }}</td>
			<td>
				<a href="{{ route('admin.movies.edit', $movie) }}">Editar</a>
				<form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" style="display:inline">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Excluir filme?')">Excluir</button>
				</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

{{ $movies->links() }}
@endsection


