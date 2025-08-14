@extends('admin.layout')

@section('title', 'Categorias')

@section('content')
<h2>Categorias</h2>
<a role="button" href="{{ route('admin.categories.create') }}">Nova Categoria</a>

<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
	@foreach($categories as $category)
		<tr>
			<td>{{ $category->name }}</td>
			<td>
				<a href="{{ route('admin.categories.edit', $category) }}">Editar</a>
				<form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline">
					@csrf
					@method('DELETE')
					<button type="submit" onclick="return confirm('Excluir categoria?')">Excluir</button>
				</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

{{ $categories->links() }}
@endsection


